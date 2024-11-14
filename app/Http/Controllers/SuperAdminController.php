<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Get all users with their roles
        $users = User::all();
        
        // Format the users with UserResource for a clean response
        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users),
            'message' => 'Users retrieved successfully'
        ], 200);
    }
}
