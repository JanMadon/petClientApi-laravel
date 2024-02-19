
# REST API - client - Laravel 

## Description
The application uses an external rest api: https://petstore.swagger.io/
The application allows you to get, add, edit, delete elements in the pet resource.

## Requirements
    To run this application, you need to have the following installed:

    PHP (recommended version: 8.1 or higher)
    Composer

## Installation Process

### Clone the repository:

    git clone https://github.com/JanMadon/petClientApi-laravel.git

### Navigate to the project directory:
    cd petClientApi-laravel

### Copy the .env.example file to .env 
    cp .env.example .env

### Install PHP dependencies using Composer:
    composer install

### Generate the Laravel application key:
    php artisan key:generate

### Start the development server:
    php artisan serve

The application will be accessible at http://localhost:8000.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
