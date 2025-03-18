<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'REVIEW FILM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-purple-600 to-pink-500">
        <div class="min-h-screen flex flex-col justify-center items-center py-12">          

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-2xl border border-purple-300 rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
