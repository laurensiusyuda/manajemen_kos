<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-mono antialiased">
    @auth
        @if (Auth::user()->hasRole('admin'))
            <div x-data="{ modalTambahProperti: false, modalEditProperti: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
                <aside class="flex-shrink-0 w-64 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 flex flex-col">
                    <div class="h-24 grid items-center justify-center px-4 text-gray-800 dark:text-white font-bold text-lg">
                        Manajemen Kos
                    </div>
                    <nav class="flex-1 px-4 py-4 space-y-2">
                        <a href="{{ route('admin.dashboard') }}"
                            :class="{
                                'bg-blue-600 text-white': @json(request()->routeIs('dashboard')),
                                {{--
                                    FIX 3:
                                    - Mengubah hover state untuk light mode menjadi 'hover:bg-gray-100' (background abu-abu muda)
                                    - dan tetap 'dark:hover:bg-gray-700 dark:hover:text-white' untuk dark mode.
                                --}} 'hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white':
                                    !@json(request()->routeIs('dashboard'))
                            }"
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <ion-icon name="grid-outline" class="mr-3 text-lg"></ion-icon>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.properti') }}"
                            :class="{
                                'bg-blue-600 text-white': @json(request()->routeIs('properti')),
                                'hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white':
                                    !@json(request()->routeIs('properti'))
                            }"
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <ion-icon name="business-outline" class="mr-3 text-lg"></ion-icon>
                            Properti & Unit
                        </a>
                        <a href="#"
                            :class="{
                                'bg-blue-600 text-white': @json(request()->routeIs('penyewa')),
                                'hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white':
                                    !@json(request()->routeIs('penyewa'))
                            }"
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <ion-icon name="people-outline" class="mr-3 text-lg"></ion-icon>
                            Penyewa
                        </a>
                        <a href="#"
                            :class="{
                                'bg-blue-600 text-white': @json(request()->routeIs('tagihan')),
                                'hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white':
                                    !@json(request()->routeIs('tagihan'))
                            }"
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <ion-icon name="receipt-outline" class="mr-3 text-lg"></ion-icon>
                            Tagihan (Invoices)
                        </a>
                        <a href="#"
                            :class="{
                                'bg-blue-600 text-white': @json(request()->routeIs('laporan')),
                                'hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white':
                                    !@json(request()->routeIs('laporan'))
                            }"
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150">
                            <ion-icon name="bar-chart-outline" class="mr-3 text-lg"></ion-icon>
                            Laporan
                        </a>
                    </nav>
                </aside>
                <div class="flex-1 flex flex-col overflow-hidden">
                    @include('layouts.navigation')
                    @isset($header)
                        <header class="bg-white dark:bg-gray-800 shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset
                    <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 text-gray-900 dark:text-gray-100">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @elseif (Auth::user()->hasRole('tenant'))
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <main>
                {{ $slot }}
            </main>
        @endif
    @else
        <main>
            {{ $slot }}
        </main>
    @endauth
    @livewireScripts
</body>

</html>
