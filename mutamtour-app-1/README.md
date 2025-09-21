# Mutamtour Umrah Management Application

## Overview
The Mutamtour application is a Laravel-based web application designed to manage Umrah pilgrimage data for the travel agency Mutamtour. This application facilitates the management of pilgrims' data, payment records, Umrah packages, and departure schedules, allowing for efficient and organized operations.

## Features
- **Pilgrim Management**: CRUD operations for managing pilgrim data, including personal information and vaccination status.
- **Package Management**: Manage various Umrah packages offered by Mutamtour, including details such as duration and type.
- **Group Management**: Organize pilgrims into groups for departures, with the ability to track available seats and group details.
- **Branch Management**: Maintain records of Mutamtour branches and their associated pilgrims.
- **Payment Management**: Track payments made by pilgrims, including the ability to mark payments as complete.
- **User Management**: Manage user accounts and authentication for the application.

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd mutamtour-app
   ```
3. Install dependencies:
   ```
   composer install
   npm install
   ```
4. Copy the example environment file:
   ```
   cp .env.example .env
   ```
5. Generate the application key:
   ```
   php artisan key:generate
   ```
6. Run migrations to set up the database:
   ```
   php artisan migrate
   ```
7. Seed the database with initial data:
   ```
   php artisan db:seed
   ```
8. Start the local development server:
   ```
   php artisan serve
   ```

## Usage
- Access the application through your web browser at `http://localhost:8000`.
- Use the admin panel to manage pilgrims, packages, groups, branches, payments, and users.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.