
# TruckRequestApp-Backend
This is the backend API for the Truck Request App, built using Laravel.  
It handles user authentication, truck request submissions, notifications, and admin management features.


## Features
- User registration & login using Laravel Sanctum
- Submit truck requests with pickup/dropoff locations, time, cargo, truck type, and note
- Track orders based on status
- Admin can update status or cancel orders
- Notifications for new requests and status updates
- Email functionality for communication with users


## Technologies Used

- Laravel
- PHP
- Sanctum (for authentication)
- MySQL (for database)
- Laravel Notifications
- Mail (SMTP)


## How to run it
1. Install dependencies:

composer install

 2. Create a .env file and configure your database and mail settings.
 3. Run migrations:

php artisan migrate

 4. Start the server:

php artisan serve

Make sure the frontend app is using the correct IP address and port for API calls.
