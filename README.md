# the api for the _UST Community_

## Installing

install all the composer dependencies for the project

```bash
composer install
```

## setup the environment variables

set all the environment variables for the project to the default

```bash
cp .env.example .env
```

## Generate the application keys

```bash
php artisan key:generate
```

## Run database migrations

```bash
php artisan migrate
```

## run db seeder (testing step)

fill the database with dummy data for testing

```bash
php artisan db:seed
```

## active the storage for storing images

```bash
php artisan storage:link
```

## Start the server

```bash
php artisan serve
```
