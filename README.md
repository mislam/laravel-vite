# Laravel Vite

Combine the power of [Laravel](https://laravel.com/) and [Vite](https://vitejs.dev/) alongside [Vue 3](https://vuejs.org/) and [Tailwind CSS](https://tailwindcss.com/).

## Software Stack

-  PHP 8.1
-  MySQL 8.0
-  Laravel 9.x
-  Vite 2
-  Vue 3
-  Tailwind CSS 3

## Develop

Make a copy of the local `.env` file:

```
cp .env.local .env
```

Install composer dependencies:

```
composer install --no-interaction --prefer-dist --optimize-autoloader
```

Start Docker containers defined in your application's `docker-compose.yml` file:

```
sail up -d
```

Run database migrations:

```
sail php artisan migrate
```

Install NPM dependencies and run Vite's dev server:

```
npm install
npm run dev
```

Now head over to your browser and open http://localhost.
