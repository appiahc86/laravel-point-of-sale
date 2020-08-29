@echo off
cd C:\xampp\htdocs\laravel-point-of-sale
php artisan snapshot:cleanup --keep=5
php artisan snapshot:create
exit