<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

         <!-- Favicon -->
        <link rel="icon" type="512.png" href="{{ asset('512.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
@if (session('success'))
            <div 
                x-data="{ show: true, message: '{{ session('success') }}' }" 
                x-init="setTimeout(() => show = false, 4000)" 
                x-show="show"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="fixed top-20 right-5 z-50 p-4 bg-green-600 text-white rounded-lg shadow-lg flex items-center justify-between"
                role="alert"
            >
                <span x-text="message"></span>
                <button @click="show = false" class="ml-4 text-green-100 hover:text-white font-bold">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div 
                x-data="{ show: true, message: '{{ session('error') }}' }" 
                x-init="setTimeout(() => show = false, 4000)" 
                x-show="show"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="fixed top-20 right-5 z-50 p-4 bg-red-600 text-white rounded-lg shadow-lg flex items-center justify-between"
                role="alert"
            >
                <span x-text="message"></span>
                <button @click="show = false" class="ml-4 text-red-100 hover:text-white font-bold">&times;</button>
            </div>
        @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
