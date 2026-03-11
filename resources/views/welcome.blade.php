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
        
        <x-artify-navbar :articles="$articles" />

        <!-- Main Content (Premium Layout) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-12">
            
            @if($articles->count() > 0)
                @php $featured = $articles->first(); @endphp
                <!-- Featured News section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Big Lead Story -->
                    <div class="lg:col-span-2 group cursor-pointer">
                        <div class="relative overflow-hidden rounded-lg mb-4 h-[400px] md:h-[500px] shadow-xl border border-gray-100 dark:border-gray-800">
                            @if($featured->featured_image)
                                <img src="{{ Str::startsWith($featured->featured_image, 'http') ? $featured->featured_image : asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center text-gray-500 italic">Curating story...</div>
                            @endif
                            <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/90 via-black/40 to-transparent">
                                <span class="bg-[#C2B280] text-white text-[10px] tracking-widest font-black uppercase px-3 py-1 mb-4 inline-block rounded-sm">Featured Story</span>
                                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">
                                    {{ $featured->title }}
                                </h1>
                                <p class="text-gray-200 mt-4 text-lg line-clamp-2 max-w-3xl font-medium">
                                    {{ Str::limit(strip_tags($featured->content), 150) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar: More Top Stories -->
                    <div class="flex flex-col gap-6">
                        <h3 class="font-black text-xl uppercase border-l-4 border-[#C2B280] pl-3 mb-2 tracking-tighter">Editors Choice</h3>
                        @foreach($articles->slice(1, 3) as $top)
                        <div class="flex gap-4 group cursor-pointer border-b border-gray-200 dark:border-gray-700 pb-4">
                            <div class="flex-shrink-0 w-24 h-24 rounded overflow-hidden shadow-sm">
                                @if($top->featured_image)
                                    <img src="{{ Str::startsWith($top->featured_image, 'http') ? $top->featured_image : asset('storage/' . $top->featured_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="w-full h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center text-[10px]">No Preview</div>
                                @endif
                            </div>
                            <div class="flex flex-col justify-center">
                                <h4 class="font-bold text-sm group-hover:text-[#C2B280] transition line-clamp-2 leading-snug">{{ $top->title }}</h4>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-[9px] text-[#C2B280] uppercase font-black tracking-widest">{{ $top->category->name ?? 'Journal' }}</span>
                                    <span class="text-[9px] text-gray-400 font-bold uppercase">/ {{ $top->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section: Latest Grid -->
                <div class="mb-8 flex items-center justify-between border-b-2 border-gray-200 dark:border-gray-700 pb-2">
                    <h2 class="font-black text-2xl uppercase tracking-tighter">Latest Coverage</h2>
                    <a href="/?all=true" class="text-xs font-black text-[#C2B280] hover:underline uppercase tracking-widest">View Archives</a>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    @forelse($articles->slice(4) as $article)
                        <div class="flex flex-col group cursor-pointer">
                            <div class="h-40 overflow-hidden rounded mb-3 relative shadow-md">
                                @if($article->featured_image)
                                    <img src="{{ Str::startsWith($article->featured_image, 'http') ? $article->featured_image : asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gray-200 dark:bg-gray-800 text-gray-400 italic">No image available</div>
                                @endif
                                <span class="absolute top-2 left-2 bg-white/90 dark:bg-black/60 backdrop-blur-md text-gray-900 dark:text-white text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-tighter shadow-sm border border-gray-100 dark:border-gray-800">
                                    {{ $article->category->name ?? 'Culture' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-lg leading-tight group-hover:text-[#C2B280] dark:group-hover:text-[#E1C16E] transition line-clamp-2 mb-2">
                                {{ $article->title }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-2 font-medium">
                                {{ Str::limit(strip_tags($article->content), 80) }}
                            </p>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $article->created_at->format('M d, Y') }} | By {{ strtok($article->user->name ?? 'Staff', ' ') }}</span>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-500 italic">Wait for more coverage to be published...</div>
                    @endforelse
                </div>
            @else
                <div class="py-20 text-center animate-pulse">
                    <h2 class="text-3xl font-black text-gray-300 dark:text-gray-700">Connecting to Artify Stream...</h2>
                    <p class="text-gray-400 mt-2">No articles available at this moment. Stay tuned.</p>
                </div>
            @endif

            <!-- Pagination -->
            <div class="mt-16 border-t border-gray-200 dark:border-gray-700 pt-8">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white pt-16 pb-8 border-t-8 border-[#F5F5DC]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div class="md:col-span-2">
                        <span class="font-black text-4xl tracking-tighter text-[#C2B280]">Artify</span>
                        <p class="mt-4 text-gray-400 max-w-sm font-medium leading-relaxed">
                            A refined platform for high-quality journalism and tech-focused storytelling. Curated for the modern reader who values design and depth.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-black uppercase mb-4 text-[#C2B280] tracking-widest text-xs">Navigation</h4>
                        <ul class="space-y-3 text-sm text-gray-400 font-bold uppercase tracking-tighter">
                            <li><a href="#" class="hover:text-[#C2B280] transition">Privacy</a></li>
                            <li><a href="#" class="hover:text-[#C2B280] transition">Terms</a></li>
                            <li><a href="{{ route('admin.partners.index') }}" class="text-[#F5F5DC] hover:text-white transition decoration-[#C2B280] underline underline-offset-8">Partner Program</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-black uppercase mb-4 text-[#C2B280] tracking-widest text-xs">Connect</h4>
                        <div class="flex gap-4">
                            <div class="w-9 h-9 border border-gray-700 hover:bg-[#C2B280] hover:text-white flex items-center justify-center transition cursor-pointer text-xs font-bold shadow-sm">𝕏</div>
                            <div class="w-9 h-9 border border-gray-700 hover:bg-[#C2B280] hover:text-white flex items-center justify-center transition cursor-pointer text-xs font-bold shadow-sm">FB</div>
                            <div class="w-9 h-9 border border-gray-700 hover:bg-[#C2B280] hover:text-white flex items-center justify-center transition cursor-pointer text-xs font-bold shadow-sm">IG</div>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-500 text-[10px] uppercase font-black tracking-widest">
                        &copy; {{ date('Y') }} Artify Journal. Crafted with clarity.
                    </p>
                    <div class="flex gap-6 text-[10px] text-gray-500 font-black">
                        <a href="/" class="hover:text-[#C2B280] tracking-widest transition">HOME</a>
                        <a href="/" class="hover:text-[#C2B280] tracking-widest transition">CONTACT</a>
                        <a href="{{ route('admin.partners.index') }}" class="hover:text-[#C2B280] tracking-widest transition uppercase">Partnership</a>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>
