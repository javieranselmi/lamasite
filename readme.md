The app might need to upload big files, such as videos and photos to S3, so NGINX or Apache should be configured to accept big files.

--

1. Set .env

2. Run composer:

$ composer update

3. Run migrations and seeds:

$ php artisan migrate
$ php artisan db:seed

4. Start Queue Worker:

$ php artisan queue:work --sleep=3 --tries=3 --daemon
 