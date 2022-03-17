## Software Stack

- PHP 8.1
- MySQL 8.0
- Laravel 9.2

## Develop

Install Composer and NPM dependencies.

```
composer install --no-interaction --prefer-dist --optimize-autoloader
npm install
```

Start Docker containers defined in your application's `docker-compose.yml` file.

```
sail up -d
```

Run database migrations.

```
sail php artisan migrate
```
