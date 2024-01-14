# Laravel Pay Pocket Demonstration

This project serves as a demonstration to evaluate the capabilities of the [laravel-pay-pocket](https://github.com/HPWebdeveloper/laravel-pay-pocket) package.

## PHP version

This project requires PHP version 8.1 or higher.

## Installation


```bash
composer install
cp .env.example .env
```

#### Configure database name
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```


```bash
php artisan migrate
php artisan key:generate
```

#### Install npm dependencies

```bash
npm install
npm run dev or npm run build
```

#### Serve Laravel app


```bash
php artisan serve
```

Register a user here: http://127.0.0.1:8000/register

Deposit and pay here: http://127.0.0.1:8000/home
