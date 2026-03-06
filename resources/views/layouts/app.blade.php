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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            @include('layouts.sidebar')

            <div class="flex-1 min-w-0 flex flex-col min-h-screen">
                @include('layouts.navigation')
                    <!-- Page Heading -->
                    @hasSection('header')
                        <header class="bg-white dark:bg-gray-800 shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                @yield('header')
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main class="flex-1">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        @if(session('success'))
                            <div class="p-4 mb-4 text-sm bg-white border border-black text-black shadow-sm flex justify-between items-center" role="alert">
                                <span><strong>SUCCESS:</strong> {{ session('success') }}</span>
                                <button type="button" onclick="this.parentElement.remove()" class="font-bold">✕</button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="p-4 mb-4 text-sm bg-black text-[#FBFCF8] border border-gray-700 flex justify-between items-center" role="alert">
                                <span><strong>ERROR:</strong> {{ session('error') }}</span>
                                <button type="button" onclick="this.parentElement.remove()" class="text-white">✕</button>
                            </div>
                        @endif
                    </div>
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#000000', // Black
                    cancelButtonColor: '#d33',     // Red
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#1f2937',         // Dark Gray
                    color: '#ffffff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form dengan ID yang dinamis
                        document.getElementById('delete-form-' + id).submit();
                    }
                })
            }
        </script>
    </body>
</html>
