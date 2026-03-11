@props(['articles' => null])
<nav class="bg-white dark:bg-gray-800 border-b-4 border-[#F5F5DC] fixed w-full z-50 top-0 shadow-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2">
                        <span class="font-black text-3xl tracking-tighter text-[#C2B280] dark:text-[#E1C16E]">Artify</span>
                        <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white border-l-2 border-gray-300 dark:border-gray-700 pl-3 uppercase">Journal</span>
                    </a>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="/" class="text-sm font-bold uppercase hover:text-[#C2B280] dark:hover:text-[#E1C16E] transition">World</a>
                    <a href="/" class="text-sm font-bold uppercase hover:text-[#C2B280] dark:hover:text-[#E1C16E] transition">Tech</a>
                    <a href="/" class="text-sm font-bold uppercase hover:text-[#C2B280] dark:hover:text-[#E1C16E] transition">Business</a>
                    @if(auth()->check() && !auth()->user()->roles->contains('name', 'super admin'))
                    <a href="{{ route('admin.partners.index') }}" class="text-sm font-bold uppercase text-[#C2B280] dark:text-[#E1C16E] hover:underline">Join Partner</a>
                    @endif
                </div>
            </div>
            
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                @auth
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                            <button class="flex items-center gap-3 px-3 py-1.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-[#C2B280] transition-all shadow-sm">
                                <div class="w-7 h-7 rounded-full bg-[#C2B280] flex items-center justify-center text-white text-xs font-black shadow-inner">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ strtok(Auth::user()->name, ' ') }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-3 w-64 rounded-xl shadow-2xl py-1 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 z-50 overflow-hidden"
                             style="display: none;">
                            
                            <!-- Header -->
                            <div class="px-4 py-4 bg-[#F5F5DC]/30 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-[10px] font-black uppercase tracking-widest text-[#C2B280] mb-1">Signed in as</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Links -->
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-[#F5F5DC] dark:hover:bg-gray-700 group transition">
                                    <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-[#C2B280]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="font-bold">Your Profile</span>
                                </a>

                                @if(Auth::user()->roles->contains('name', 'super admin'))
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-[#F5F5DC] dark:hover:bg-gray-700 group transition">
                                    <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-[#C2B280]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    <span class="font-bold">Admin Panel</span>
                                </a>
                                @endif
                            </div>

                            <div class="border-t border-gray-100 dark:border-gray-700"></div>

                            <!-- Sign Out -->
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 group font-black uppercase tracking-tighter">
                                        <svg class="mr-3 h-4 w-4 text-red-400 group-hover:animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold uppercase text-gray-600 dark:text-gray-300 hover:text-[#C2B280] transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-bold uppercase px-4 py-2 bg-[#C2B280] text-white rounded hover:bg-[#B1A170] transition shadow-md shadow-[#C2B280]/30">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
