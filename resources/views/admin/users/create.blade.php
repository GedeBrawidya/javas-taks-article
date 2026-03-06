@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Header Section: Di pojok kiri --}}
                    <div class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Add New Account</h3>
                        <p class="text-sm text-gray-500">Register a new user to the Task Articles management system.</p>
                    </div>
                    
                    {{-- Form Container: Ramping agar tidak melar (max-w-2xl) --}}
                    <div class="max-w-2xl">
                        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus 
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder-gray-600"
                                    placeholder="e.g. Gede Admin">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm placeholder-gray-600"
                                    placeholder="name@taskarticles.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <label for="role_id" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Account Role</label>
                                <select name="role_id" id="role_id" required 
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="" disabled selected>Choose a role...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ strtoupper($role->name) }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Password</label>
                                    <input type="password" name="password" id="password" required 
                                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required 
                                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" class="px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Save User
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection