<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Task Articles') }} - Home</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        <!-- Scripts / Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 font-sans text-gray-900 dark:text-gray-100 antialiased selection:bg-indigo-500 selection:text-white">
        
        <!-- Navbar -->
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 fixed w-full z-50 top-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <x-application-logo class="w-8 h-8 fill-current text-indigo-600 dark:text-indigo-400" />
                        <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">Task Articles</span>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs font-medium px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600">Log out</button>
                        </form>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                        @auth
                            @if(Auth::user()->roles->contains('name', 'super admin'))
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Admin Dashboard</a>
                            @else
                                {{-- Jika ada user dashboard/profile --}}
                                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Profile</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-medium px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition">Log out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500 transition shadow-md shadow-indigo-500/30">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-white dark:bg-gray-800 overflow-hidden pt-16">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white dark:bg-gray-800 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-10 sm:pt-16 lg:pt-20 px-4 sm:px-6 lg:px-8">
                    <main class="mx-auto max-w-7xl">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">Discover top</span>
                                <span class="block text-indigo-600 dark:text-indigo-400 xl:inline">technology articles</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-500 dark:text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Expand your knowledge with insightful programming, design, and tech articles written by top contributors. Read, learn, and share your ideas.
                            </p>
                            @guest
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                        Join our Community
                                    </a>
                                </div>
                            </div>
                            @endguest
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 mt-16 lg:mt-0 opacity-20 lg:opacity-100 hidden sm:block">
                <!-- A simple placeholder for hero graphic (gradient pattern) -->
                <div class="w-full h-56 sm:h-72 md:h-96 lg:h-full lg:w-full object-cover bg-gradient-to-br from-indigo-500 to-purple-600"></div>
            </div>
        </div>

        <!-- Articles Grid Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Latest News & Articles</h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Catch up on the newest trends and tutorials.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
                @forelse($articles as $article)
                    <div class="flex flex-col rounded-xl shadow-lg shadow-gray-200/50 dark:shadow-black/20 overflow-hidden bg-white dark:bg-gray-800 hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-black/40 transition duration-300 border border-gray-100 dark:border-gray-700">
                        <!-- Thumbnail -->
                        <div class="flex-shrink-0 h-48 w-full relative">
                            @if($article->featured_image)
                                <img src="{{ Str::startsWith($article->featured_image, 'http') ? $article->featured_image : asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">No Image</div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-300 backdrop-blur-sm shadow-sm">
                                    {{ $article->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <a href="#" class="block mt-2">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                        {{ $article->title }}
                                    </h3>
                                    <p class="mt-3 text-base text-gray-600 dark:text-gray-400 line-clamp-3">
                                        {{ Str::limit(strip_tags($article->content), 120) }}
                                    </p>
                                </a>
                            </div>
                            <!-- Meta Footer -->
                            <div class="mt-6 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                        {{ substr($article->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $article->user->name ?? 'Anonymous' }}
                                        </p>
                                        <div class="flex space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                            <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                                                {{ $article->created_at->format('M d, Y') }}
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No articles</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Please wait for our contributors to write new contents.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-8 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center">
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Articles.
                </p>
            </div>
        </footer>

    </body>
</html>
