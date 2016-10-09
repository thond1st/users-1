# users
"Simple users crud package for Laravel 5.3

#### Composer install

```
composer require vitorbar/users
```

#### Add service provider in ``config.app``

```
/*
* Package Service Providers...
*/

Vitorbar\Users\UsersServiceProvider::class,
```

#### Publishing package files

```
php artisan vendor:publish --provider="Vitorbar\Users\UsersServiceProvider"
```

#### Set DB connection and run migrations

```
php artisan migrate
```

#### Routes

* /user
* /role