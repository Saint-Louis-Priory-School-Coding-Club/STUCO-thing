# STUCO Thing

### Installation
---
* Pull this branch
* [Install Composer](https://getcompser.org)
* Run `php composer.phar install`
* Run `php artisan key:generate`
* For XAMPP/MAMP [Fix the key length](https://stackoverflow.com/questions/23786359/laravel-migration-unique-key-is-too-long-even-if-specified)
* Create a new database in PhpMyAdmin
* Edit .env DB fields to be the correct username, password, and port
* Run `php artisan migrate`
* Run `php artisan db:seed`
