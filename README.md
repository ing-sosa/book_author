<p align="center">
<img src="https://img.shields.io/github/downloads/ing-sosa/book_author/total.svg" alt="Total Downloads">
<img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
</p>

## How to prepare and configure the project?

-   Download all PHP dependencies with `composer install`.
-   Download all JS dependencies since this project uses Vue.js with `npm install`.
-   Clone the .env.example file with `cp .env.example .env`. You can change your DB configuration DB_DATABASE=book_author as you wish.
-   Create your MySQL database. The example uses `book_author`, feel free to use yours.
-   Generate your APP_KEY with `php artisan key:generate`.
-   Migrate with dummy data using `php artisan migrate --seed` or migrate without data using `php artisan migrate`.

## How to run the project on your local machine?

-   Start the backend with `php artisan serve`.
-   Start the frontend with `npm run dev`. This will refresh anytime you update the frontend files.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Feel free to use it as a boilerplate for your Laravel v8 + Vue.js v4 + MySQL projects.
