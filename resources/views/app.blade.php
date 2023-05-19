<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">

    {{-- 

        TIP: 

        - Main layout file for your application integrating with 
        Vue components seamlessly.

        - Allows you to share common functionality, such as authentication checks 
        or global scripts, across your application e.g Stripe, Google Analytics, 

        - Placeholder or directive where your Vue components will be rendered i.e. `@inertia`
    
     --}}
    @inertia
</body>

</html>
