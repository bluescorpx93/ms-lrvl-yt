#### Laravel Tryout

To Test This

- Setup ENV Vars
```sh
$ cd ms-lrvl-yt
$ touch .env
```
- Update .env
```
DB_CONNECTION=<YOUR_DRIVER>
DB_HOST=<YOUR_HOST>
DB_PORT=<YOUR_PORT>
DB_DATABASE=<YOUR_DBNAME>
DB_USERNAME=<YOUR_DBUSER>
DB_PASSWORD=<YOUR_DBPASS>
```
- Run App

```sh
$ cd ms-lrvl-yt
$ composer install 
$ php artisan serve
```