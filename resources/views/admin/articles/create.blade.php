@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-left">
            {{ __('Write New Article') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-6">
                    
                    {{-- Bagian Kiri: Judul & Konten Utama --}}
                    <div class="flex-1 space-y-6">
                        <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                            <div class="mb-6">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Article Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" required 
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Enter a catchy title...">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Body Content</label>
                                <textarea name="content" rows="20" required
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Start writing your masterpiece..."></textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Kanan: Sidebar (Category, Tags, Image, Publish) --}}
                    <div class="w-full md:w-80 space-y-6">
                        <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                            
                            {{-- Category --}}
                            <div class="mb-6">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Category</label>
                                <select name="category_id" required
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tags (Multiple Selection) --}}
                            <div class="mb-6">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Tags</label>
                                <div class="max-height-48 overflow-y-auto space-y-2 p-2 border border-gray-100 dark:border-gray-700 rounded-md">
                                    @foreach($tags as $tag)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $tag->name }}</span>
                                        </label><br>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Thumbnail Image --}}
                            <div class="mb-8">
                                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Thumbnail</label>
                                <input type="file" name="featured_image" accept= ".jpg,.jpeg,.png" 
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 dark:file:bg-gray-700 dark:file:text-gray-300">
                                <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                            </div>

                            <button type="submit" class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md font-bold text-xs uppercase tracking-widest transition shadow-lg">
                                Publish Now
                            </button>
                        </div>

                        <a href="{{ route('admin.articles.index') }}" class="block text-center text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-black dark:hover:text-white transition">
                            Save as Draft
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection