<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="h-full flex flex-col">

<div class="min-h-full">
    <div class="flex">
        <div class="w-64">
            <x-sidenav></x-sidenav>
        </div>
        <div class="flex-1">
            <x-navbar></x-navbar>
            <x-header>{{$title}}</x-header>
            <main class="pt-8">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 md:px-6 lg:px-7">
                {{$slot}}
                </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

</body>
</html>