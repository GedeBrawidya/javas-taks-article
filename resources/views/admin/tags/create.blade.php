@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Tags') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Create New Tag</h3>
                        <p class="text-sm text-gray-500">Add a new Tag to group your articles.</p>
                    </div>
                    
                    <div class="max-w-2xl">
                        <form method="POST" action="{{ route('admin.tags.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Tag Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus 
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="e.g. Technology">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" class="px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition">
                                    Save Tag
                                </button>
                                <a href="{{ route('admin.tags.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
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