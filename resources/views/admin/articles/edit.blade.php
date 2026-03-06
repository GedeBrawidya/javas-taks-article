@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Article') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Pastikan enctype ada untuk upload gambar --}}
            <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col lg:flex-row gap-8">
                    {{-- SISI KIRI: Judul & Konten --}}
                    <div class="flex-1 space-y-6">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Article Title</label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                            
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mt-6 mb-2">Body Content</label>
                            <textarea name="content" rows="15" required
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">{{ old('content', $article->content) }}</textarea>
                        </div>
                    </div>

                    {{-- SISI KANAN: Sidebar --}}
                    <div class="w-full lg:w-80 space-y-6">
                        {{-- Dropdown Category --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Category</label>
                            <select name="category_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Checkbox Tags --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Tags</label>
                            <div class="max-height-48 overflow-y-auto space-y-2 p-2 border border-gray-100 dark:border-gray-700 rounded">
                                @foreach($tags as $tag)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                            {{ in_array($tag->id, $articleTags) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $tag->name }}</span>
                                    </label><br>
                                @endforeach
                            </div>
                        </div>

                        {{-- Upload Image --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Change Thumbnail</label>
                            {{-- Tampilkan gambar lama --}}
                            @if($article->featured_image)
                                <img src="{{ Str::startsWith($article->featured_image, 'http') ? $article->featured_image : asset('storage/'.$article->featured_image) }}" 
                                    class="w-full h-32 object-cover rounded mb-4 shadow-sm border border-gray-200">
                            @endif
                            <input type="file" name="image" class="block w-full text-xs text-gray-500 file:bg-gray-100 file:border-0 file:rounded-md">
                        </div>

                        <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold uppercase text-xs tracking-widest rounded-md hover:bg-indigo-500 transition shadow-lg">
                            Update Article
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection