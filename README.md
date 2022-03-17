# Laravel Vite

Combine the power of [Laravel](https://laravel.com/) and [Vite](https://vitejs.dev/) alongside [Vue 3](https://vuejs.org/) and [Tailwind CSS](https://tailwindcss.com/).

## Application Stack

-  PHP 8.1
-  MySQL 8.0
-  Laravel 9.x
-  Vite 2
-  Vue 3
-  Tailwind CSS 3

## Setup Dev Environment

We will be running Laravel in a Docker development environment using [Laravel Sail](https://laravel.com/docs/sail). Although running PHP directly on your computer (host) is not a requirement, we still need it to install Sail for the first time.

If you're on macOS, you can install PHP using [Homebrew](https://brew.sh/):

```
brew install php
```

Clone this repo:

```
git clone git@github.com:mislam/laravel-vite.git my-awesome-project
cd my-awesome-project
```

Install Sail:

```
composer require laravel/sail --dev
```

Add a new line in your `~/.bashrc` or `~/.bash_profile` to create an alias (shortcut) to the sail command :

```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Make a copy of the local `.env` file and generate encryption key:

```
cp .env.local.example .env
php artisan key:generate
```

Start all of the Docker containers defined in `docker-compose.yml`:

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

## Deployment

### VPS Server

You can use [Laravel Forge](https://forge.laravel.com) to deploy the application on a VPS server, such as: [DigitalOcean Droplets](https://www.digitalocean.com/products/droplets) or [Amazon EC2](https://aws.amazon.com/ec2).

### Cloud

If you have scalibility in mind, go with [Laravel Vapor](https://vapor.laravel.com/). It uses [AWS Lambda](https://aws.amazon.com/lambda/) to deploy and auto-scale in a serverless platform.

### Front-End Assets

Run build script for production:

```
npm run build
```

This will store production-ready assets inside `public/dist` directory. For the sake of simplicity, you can commit and store them in your Git repository and deploy with rest of the code. But if you want to fine-tune this process, you can create a script to publish the assets to [Amazon S3](https://aws.amazon.com/s3/) or [DigitalOcean Spaces](https://www.digitalocean.com/products/spaces), and serve them via CDN, such as: [CloudFlare](https://www.cloudflare.com/) or [Amazon CloudFront](https://aws.amazon.com/cloudfront/).
