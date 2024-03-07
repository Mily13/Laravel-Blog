# Laravel-Blog

A weboldal adatbázisként egy SQLite adatbázis lett létrehozva migrációkkkal, és fel lett töltve minta adatokkal Seeder-ek és Factory-k segítségével. Migrációk és Seederek futtatására a ``php artisan migrate:fresh --seed`` parancs is használható.

Fejlesztés során a 'php artisan serve' által indított localt használtam.

Szükséges egy '.env' fájlt létrehozni ez történhet a '.env.example' segítségével másolás és átnevezéssel.
Az adatbázis beállításához a következő sornak kell szerepelnie: 'DB_CONNECTION=sqlite' a '.env' fájlban.
A következő sorok törlésre kerülhetnek:
```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_app
DB_USERNAME=root
DB_PASSWORD=
```
Futtatási követelmények:
1) megfelelő PHP verzió 
2) Composer

Repo klónozása és beüzemelés fejlesztői környezet termináljából:
```
git clone https://github.com/Mily13/Laravel-Blog.git
cd blog-app
composer install //vagy composer update
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```


