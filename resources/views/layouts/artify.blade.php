<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Artify') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 font-sans text-gray-900 dark:text-gray-100 antialiased selection:bg-[#C2B280] selection:text-white">
        
        <x-artify-navbar />

        <!-- Main Content -->
        <main class="pt-24 pb-12 min-h-screen">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm bg-white border-l-4 border-[#C2B280] text-gray-800 shadow-sm flex justify-between items-center dark:bg-gray-800 dark:text-gray-200" role="alert">
                        <span><strong class="text-[#C2B280]">SUCCESS:</strong> {{ session('success') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" class="font-bold">✕</button>
                    </div>
                @endif
            </div>

            @yield('content')
        </main>

        <!-- Footer (Simple) -->
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center">
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Artify Journal.
                </p>
            </div>
        </footer>
    </body>
</html>
