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
                    
                    <div class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Account: {{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 text-left">Update user details. Leave password blank if you don't want to change it.</p>
                    </div>
                    
                    <div class="max-w-2xl">
                        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Account Role</label>
                                <select name="role_id" required
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id', $userRole) == $role->id ? 'selected' : '' }}>
                                            {{ strtoupper($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">New Password (Optional)</label>
                                    <input type="password" name="password"
                                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Confirm New Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md font-semibold text-xs uppercase tracking-widest transition">
                                    Update Account
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-gray-700">
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