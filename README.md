# Amazon E-commerce Application

#### Built with Laravel, Vue, TailwindCSS and Vite

<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="100">
  <img src="https://vitejs.dev/logo.svg" alt="Vite" width="100">
  <img src="https://vuejs.org/logo.svg" alt="Vue" width="100">
  <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="TailwindCSS" width="100">
</p>

<hr />

#### Create a Model, Migration and Controller

-   `$ php artisan make:model Category -mc --resource`

#### Now seed the database

-   `$ php artisan migrate:fresh --seed`


#### Route Caching
If config/cache.php 'stores' property is present and has content, then the route cache will be used. If not, then the route cache will not be used.

If it's enabled and you make changes to your routes, you'll need to run `php artisan route:cache` to update the cache.
