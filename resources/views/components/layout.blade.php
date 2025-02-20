<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="icon" type="png" href="/img/profile.png">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>

        <main class="p-4 md:ml-64 min-h-screen pt-20 dark:bg-gray-900">
            {{ $slot }}
        </main>
    </div>
</body>

</html>