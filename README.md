# users
"Simple users crud package for Laravel 5.3

#### Composer install

```
composer require vitorbar/users:dev-master
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
php artisan vendor:publish --force
```

#### Set DB connection e run migrations

```
php artisan migrate
```

#### Access URL

http://localhost/user