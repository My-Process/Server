# Formoney Management System

Installed packages:

- [Laravel Breeze](https://github.com/laravel/breeze)
- [Horizon](https://github.com/laravel/horizon)
- [Telescope](https://github.com/laravel/telescope)
- [Sail](https://github.com/laravel/sail)
- [Laravel Enum](https://github.com/BenSampo/laravel-enum)
- [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

For the pages we create to authenticate for access to Horizon and Telescope, we use:

- Tailwind UI
- Alpine JS

## About this project

- Initial Date: 21/06/2022
- Developer: João Pedro Lopes
- Status: `In progress`

### Requirements
- PHP = 8.1
- Laravel = 9.18
- Composer v2.3.7
- Mysql v8.0.29

### How to install
- Clone the project
    ```bash
        git clone https://github.com/My-Process/Server.git
    ```

- Copy the .env.example file
    - If using linux: cp .env.example .env
    - If you are on windows, open the file in a code editor and save it again as .env

- Run the system using Docker and Sail
    ```bash
        sail up -d
    ```

- Create a new key for the application
    ```bash
        sail artisan key:generate
    ```

- Update the database settings
    - .env
    ```php
        DB_CONNECTION=mysql
        DB_HOST=host.docker.internal
        DB_PORT=3306
        DB_DATABASE=myprocess
        DB_USERNAME=sail
        DB_PASSWORD=password
    ```

- Run Migrations with Seeders
    ```bash
        sail artisan migrate:fresh --seed
    ```

### Development Tools
- Run php-cs-fixer command to fix the code style of PHP files
    ```bash
        sail exec laravel.test vendor/bin/php-cs-fixer fix
    ```

## Okay, good job!
