<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Taskit') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f6f1fb] font-sans antialiased text-[#2f2853]">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(122,90,248,0.12),_transparent_0,_transparent_42%),linear-gradient(180deg,_#f7f2ff_0%,_#f6f1fb_100%)]">
            @include('layouts.navigation')

            @isset($header)
                <header class="px-4 pb-2 pt-6 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-7xl rounded-[28px] bg-white/85 px-6 py-5 shadow-[0_24px_60px_-40px_rgba(83,67,151,0.55)] ring-1 ring-[#e9dffb] backdrop-blur sm:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="pb-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
