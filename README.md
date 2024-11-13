# Projet de Réservation de Voitures et Trajets

Ce projet permet la gestion des réservations de voitures pour des trajets entre différentes villes. Les utilisateurs peuvent réserver des trajets, choisir une voiture, et payer pour leurs réservations. Ce système est construit avec Laravel et utilise une base de données MySQL pour stocker les informations relatives aux utilisateurs, aux villes, aux trajets, aux voitures et aux réservations.

## Structure de la Base de Données

Voici un aperçu de la structure de la base de données utilisée pour ce projet. La base de données est composée des tables suivantes :

### 1. **`cities`** : Table des Villes

Cette table contient les informations des villes disponibles pour les trajets.

| Colonne     | Type        | Description                              |
|-------------|-------------|------------------------------------------|
| `id`        | BIGINT      | Identifiant unique de la ville (PK)      |
| `name`      | VARCHAR(255)| Nom de la ville, unique                  |
| `created_at`| TIMESTAMP   | Date et heure de création                |
| `updated_at`| TIMESTAMP   | Date et heure de la dernière mise à jour |

### 2. **`cars`** : Table des Voitures

Cette table contient les informations des voitures disponibles pour la réservation.

| Colonne            | Type        | Description                                              |
|--------------------|-------------|----------------------------------------------------------|
| `id`               | BIGINT      | Identifiant unique de la voiture (PK)                    |
| `name`             | VARCHAR(255)| Nom de la voiture                                         |
| `seating_capacity` | TINYINT     | Capacité de sièges de la voiture (par défaut 4)           |
| `color`            | VARCHAR(20) | Couleur de la voiture (facultatif)                        |
| `image_url`        | VARCHAR(255)| URL de l'image de la voiture (facultatif)                 |
| `price_per_km`     | DECIMAL(5,2)| Prix par kilomètre de la voiture (facultatif)             |
| `created_at`       | TIMESTAMP   | Date et heure de création                                |
| `updated_at`       | TIMESTAMP   | Date et heure de la dernière mise à jour                 |

### 3. **`routes`** : Table des Trajets

Cette table contient les informations sur les trajets entre les villes.

| Colonne              | Type        | Description                                                      |
|----------------------|-------------|------------------------------------------------------------------|
| `id`                 | BIGINT      | Identifiant unique du trajet (PK)                                |
| `departure_city_id`  | BIGINT      | Référence à la ville de départ (`cities.id`), peut être NULL     |
| `arrival_city_id`    | BIGINT      | Référence à la ville d'arrivée (`cities.id`), peut être NULL     |
| `distance_km`        | DECIMAL(6,2)| Distance du trajet en kilomètres (facultatif)                    |
| `duration`           | TIME        | Durée du trajet (facultatif)                                     |
| `created_at`         | TIMESTAMP   | Date et heure de création                                        |
| `updated_at`         | TIMESTAMP   | Date et heure de la dernière mise à jour                         |

### 4. **`reservations`** : Table des Réservations

Cette table contient les informations relatives aux réservations effectuées par les utilisateurs.

| Colonne             | Type        | Description                                                       |
|---------------------|-------------|-------------------------------------------------------------------|
| `id`                | BIGINT      | Identifiant unique de la réservation (PK)                         |
| `user_id`           | BIGINT      | Référence à l'utilisateur ayant effectué la réservation (`users.id`) |
| `route_id`          | BIGINT      | Référence au trajet réservé (`routes.id`)                         |
| `car_id`            | BIGINT      | Référence à la voiture réservée (`cars.id`)                       |
| `departure_datetime`| DATETIME    | Date et heure de départ de la réservation                         |
| `arrival_datetime`  | DATETIME    | Date et heure d'arrivée prévue de la réservation (facultatif)     |
| `additional_info`   | TEXT        | Informations supplémentaires concernant la réservation (facultatif)|
| `session_id`        | VARCHAR(100)| Identifiant de la session de réservation                         |
| `payment_status`    | ENUM        | Statut du paiement : `unpaid`, `paid`, `pending` (par défaut `unpaid`)|
| `price`             | DECIMAL(10,2)| Prix total de la réservation (facultatif)                        |
| `created_at`        | TIMESTAMP   | Date et heure de création de la réservation                       |
| `updated_at`        | TIMESTAMP   | Date et heure de la dernière mise à jour                          |

## Relations entre les tables

- **`users`** → **`reservations`** : Un utilisateur peut avoir plusieurs réservations.
- **`routes`** → **`reservations`** : Un trajet peut être réservé plusieurs fois.
- **`cars`** → **`reservations`** : Une voiture peut être réservée plusieurs fois.
- **`cities`** → **`routes`** : Une ville peut être la ville de départ ou d'arrivée pour plusieurs trajets.
