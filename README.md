# Giphy API V2 Application

This is a technical challenge for Prex, implemented using Laravel 10, PHP 8.2, and MySQL.

## Prerequisites

To run this application, you must have Docker and docker-compose installed on your system.

## Steps to Run the Application

1. Clone the repository:
   
   ```bash
   git clone [url del repo]

2. Start the application using docker-compose:

    ```bash
    docker-compose up --build

3. Copy the .env.example file to .env inside the Nginx container:

    ```bash
    docker-compose exec nginx sh -c 'cd /var/www/html && cp .env.example .env'

4. Run migrations and install Passport inside the PHP container:

    ```bash
    docker-compose exec php sh -c 'php artisan migrate --force && php artisan passport:install'


### This application utilizes the Giphy API V2 to retrieve and display GIFs. A .env file is required to configure the application's environment variables. Additionally, Laravel Passport is used for authentication and authorization.