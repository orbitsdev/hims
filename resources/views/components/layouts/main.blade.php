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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->

    <style>
        [x-cloak] {
            display: none !important;
        }
        .ron-ron-buang{
            background: #EFF1F6;
            padding: 8px;
            border-radius: 12px;


        }
        .ron-image{
            width: 90px;
            height: 90px;

        }
        .ron-ml{
            margin-left: 20px;
        }

        .ron-flex{
            display: flex;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')

    <!-- Styles -->
    @livewireStyles

            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js "></script>
    <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.1/dist/echarts.min.js"></script>
</head>
{{-- bg-[#E2E5E0]  --}}
<body class="font-sans antialiased  bg-[#E2E5E0] flex flex-col">

            {{$slot}}

{{--
    @can('admin')

    <x-admin-layout/>
    @endcan --}}




    @livewireScripts
    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
