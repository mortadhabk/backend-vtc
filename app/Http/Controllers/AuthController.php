<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        
        // Create the user
        $user = User::create($input);
    
        // Assign default role "User" to the new user
        $user->assignRole('User');

        // Prepare the response data
        $success['access_token'] = $user->createToken('MyApp')->plainTextToken;
        
        // Use UserResource to format the response
        $success['user'] = new UserResource($user); 
    
        return ApiResponseClass::sendResponse($success, 'User register successfully.', 201);
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Find the user by email
        $user = User::where('email', $request->email)->first();
        
        // Check if the user exists and if the password is correct
        if (! $user || ! Hash::check($request->password, $user->password)) {
            // Return unauthorized status (401) if credentials are incorrect
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }
        
        // Generate an access token for the user
        $success['access_token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['user'] = new UserResource($user); 
        
        // Return success with the access token and user data
        return response()->json([
            'success' => true,
            'data' => $success,
            'message' => 'User login successfully.'
        ], 200);
    }
    

    public function forgotPassword(Request $request)
    {
        // Validate the email input
        $request->validate(['email' => 'required|email']);
    
        // Attempt to send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        // Return a JSON response based on the status
        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)], 200)
            : response()->json(['errors' => ['email' => __($status)]], 400);

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully'], 200)
            : response()->json(['errors' => ['email' => [__($status)]]], 400);

    }


    
}
