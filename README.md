# Amazon E-commerce Application

### Built with Laravel, Vue, TailwindCSS and Vite

<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="100">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://vitejs.dev/logo.svg" alt="Vite" width="100">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://vuejs.org/logo.svg" alt="Vue" width="100">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="TailwindCSS" width="100">
</p>

### Create a Model, Migration and Controller
---

-   `$ php artisan make:model Category -mc --resource`

</br>

### Now seed the database
---

-   `$ php artisan migrate:fresh --seed`

</br>

### Route Caching
---

If config/cache.php 'stores' property is present and has content, then the route cache will be used. If not, then the route cache will not be used.

If it's enabled and you make changes to your routes, you'll need to run `$ php artisan route:cache` to update the cache.

Or `$ php artisan optimize` to update the cache and other things like configs

</br>

### Reset Database
---

NOTE: This can be done after adding new columns into existing tables from the migration files. Don't use this in production.

All the data is lost when you run the following command

-   `$ php artisan migrate:reset`

Immediately re-migrate

-   `$ php artisan migrate`

Lastly re-seed

-   `$ php artisan db:seed`


### Create a Form Request Validation Request
---

Form requests are custom request classes that encapsulate their own validation 
and authorization logic.

Below are the conventions used when creating form requests related to a resource controller:

- The convention is as follows:
  * Use the prefix "Store" for requests that handle the creation or storing of data.
  * Use the prefix "Update" for requests that handle the updating of existing data.
  * Use the prefix "Delete" for requests that handle the deletion of data.
  * Use the prefix "Get" or "Fetch" for requests that retrieve or fetch data without modifying it.

-   `$ php artisan make:request StoreAddressOptionsRequest`



### Integrating Stripe Payment Gateway
---

- Navigate to https://stripe.com/docs/development/quickstart and follow the instructions to get started with Stripe.

Install the Stripe PHP library via Composer:
-   `$ composer require stripe/stripe-php`

Initialize it into CheckoutController.php


### Create an Order migration 
---

-   `$ php artisan make:model Order -m`     


### Check out Laravel Tips and Tricks
---

- [Tips and Tricks](https://github.com/LaravelDaily/laravel-tips)


### Project Screenshots
---

1. Home Page

![Home Page](project-media/home-page.png)


2. Side Menu and Backdrop

![Side Menu and Backdrop](project-media/sidemenu-and-backdrop.png)


3. Category Products Page

![Category Products Page](project-media/category-products-page.png)

4. Product Details Page

![Product Details Page](project-media/product-details.png)

5. Cart Page

![Cart Page](project-media/cart.png)

6. Checkout Page

![Checkout Page](project-media/checkout.png)


7. Checkout Success Page

![Checkout Success Page](project-media/checkout-success.png)

8. Stripe Payment Successful Page

![Stripe Payment Successful Page](project-media/stripe-payment-successful.png)

9. Stripe Payment Details Page

![Stripe Payment Details Page](project-media/stripe-payment-details.png)

10. Mail Send Successfully

![Mail Send Successfully](project-media/email-send-and-about-payment.png)


### Project Video
---

Note Github won't play this video since it's huge. Kindly click on it and download to play it on your laptop. Thank you.

[![Watch the video](project-media/home-page.png)](project-media/amazon-2023-05-19_12.34.03.mp4)
