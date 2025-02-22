<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="icon" type="png" href="/img/profile.png">

    {{-- Input Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    {{ $styles ?? '' }}

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

    {{-- Select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    {{ $scripts ?? '' }}

    {{-- Darkmode --}}
    <script>
        const themeToggle = document.getElementById("theme-toggle");
        const lightIcon = document.getElementById("theme-toggle-light");
        const darkIcon = document.getElementById("theme-toggle-dark");
    
        // Cek apakah user sudah menyimpan preferensi tema
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
            darkIcon.classList.add("hidden");
            lightIcon.classList.remove("hidden");
        } else {
            document.documentElement.classList.remove("dark");
            lightIcon.classList.add("hidden");
            darkIcon.classList.remove("hidden");
        }
            
        // Toggle dark mode saat tombol ditekan
        themeToggle.addEventListener("click", () => {
            document.documentElement.classList.toggle("dark");
            if (document.documentElement.classList.contains("dark")) {
                localStorage.setItem("theme", "dark");
                darkIcon.classList.add("hidden");
                lightIcon.classList.remove("hidden");
            } else {
                localStorage.setItem("theme", "light");
                lightIcon.classList.add("hidden");
                darkIcon.classList.remove("hidden");
            }
        });
    </script>
</body>

</html>