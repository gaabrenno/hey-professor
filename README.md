[![CI  Develop](https://github.com/gaabrenno/hey-professor/actions/workflows/laravel.yml/badge.svg?branch=develop)](https://github.com/gaabrenno/hey-professor/actions/workflows/laravel.yml)
[![CI  Main](https://github.com/gaabrenno/hey-professor/actions/workflows/laravel.yml/badge.svg?branch=develop)](https://github.com/gaabrenno/hey-professor/actions/workflows/laravel.yml)
<div align="center">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
    <img src="https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white" />
</div>

## About Hey Professor

Kickstart your development journey with a robust, ready-to-use Laravel foundation. Streamline your web projects, enhance productivity, and bring your creative ideas to life effortlessly. Designed for developers who value efficiency and innovation in their web development process

## Set up

This project requires [PHP 8.3](https://www.php.net/releases/8.3/en.php) and [Laravel 11](https://laravel.com/docs/10.x/releases#laravel-11) for optimal performance and compatibility.

## Get Started

1. Cloning the project:
```
git clone https://github.com/4selet/4selet-v2.git && cd ./4selet-v2
```
2. Create the environment file `.env` in the root of the project.
```
cp .env.example .env
```
3. Turn on the PHP Extension `Sodium`
4. Run the project dependencies:
```
composer install
```
5. Generate your environment key:
```
php artisan key:generate
```
6. Regenerate the autoload files:
```
composer dump-autoload
```
7. Install all node dependencies:
```
npm install
```
8. Run all migrations:
```
php artisan migrate
```
9. Run all database seed:
```
php artisan db:seed
```
10. Create a link for public files
```
php artisan storage:link
```
11. Done! Run `php artisan serve` to start.

## Background Services

### Queue:
  ```
  php artisan queue:work
  ````
Executes the event list, necessary for sending notifications or performing background tasks.

### To run the queue with recovery mode (if it fails, it will restart): 
```
php artisan queue:work --tries=1
```
Change `QUEUE_CONNECTION` in `.env` to `database`. For example: `QUEUE_CONNECTION=database`
### Services: 
```
php artisan schedule:work
```
Executes Scheduled Tasks

Note: In production, use Supervisor. Read more in SUPERVISOR.md

## Creation of a New Module ([introduction](https://laravelmodules.com/docs/v10/introduction))

Create a new module: 
```
php artisan module:make module-name
```

Create a new controller for the module: 
```
php artisan module:make-controller module-name ControllerName
```

[Migrations](https://laravelmodules.com/docs/v9/artisan-commands#module-migrate):
```
php artisan module:make-migration create_name_table module-name
```
