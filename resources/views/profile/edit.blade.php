@extends('layouts.artify')

@section('header')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-black text-3xl text-gray-900 dark:text-white leading-tight tracking-tighter uppercase">
            {{ __('Account Settings') }}
        </h2>
        <p class="text-gray-500 text-sm mt-1">Manage your public profile and account security.</p>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Sidebar Info (GitHub Style) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                            <div class="w-32 h-32 rounded-full bg-[#C2B280] shadow-xl flex items-center justify-center text-white text-5xl font-black mb-6">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500 mb-4">{{ Auth::user()->email }}</p>
                            
                            <div class="w-full border-t border-gray-200 dark:border-gray-800 pt-6 space-y-4">
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Joined {{ Auth::user()->created_at->format('M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Forms -->
                <div class="lg:col-span-2 space-y-12">
                    <section class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 sm:rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-gray-50 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h4 class="text-sm font-black uppercase text-gray-900 dark:text-white tracking-widest">Public Profile</h4>
                        </div>
                        <div class="p-6 sm:p-8">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </section>

                    <section class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 sm:rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-gray-50 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h4 class="text-sm font-black uppercase text-gray-900 dark:text-white tracking-widest">Security</h4>
                        </div>
                        <div class="p-6 sm:p-8">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </section>

                    <section class="bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 sm:rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-red-100 dark:border-red-900/20 bg-red-100/30 dark:bg-red-900/20">
                            <h4 class="text-sm font-black uppercase text-red-600 dark:text-red-400 tracking-widest uppercase">Danger Zone</h4>
                        </div>
                        <div class="p-6 sm:p-8">
                            <div class="max-w-xl text-red-600">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
