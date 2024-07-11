<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-tory-blue-50 min-h-screen flex flex-col">

    <nav class="bg-white">
        <x-main-header />
    </nav>

    <div class="relative flex flex-1">
        <div class="w-[20rem] bg-white px-6 pb-2 flex-shrink-0">
            <div class="flex h-16 items-center">
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            </div>
            <x-nav/>
        </div>
        <div class="flex-1 p-6">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati tempora accusantium at nam expedita
            alias magnam maiores inventore qui quasi, ut vero, beatae magni repudiandae eos fugiat doloribus recusandae
            quisquam.
        </div>
    </div>

    @livewireScripts
    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
