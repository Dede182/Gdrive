<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 ">
            @include('layouts.navigation')

            <div class="flex  w-full ease-in-out py-2.5 relative">
                <div class="w-[20%]  transition duration-500 origin-left " id = "side" >
                    @include('Layouts.sidebar')
                </div>
                <div class="w-full origin-right ease-in-out" id = "content">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
