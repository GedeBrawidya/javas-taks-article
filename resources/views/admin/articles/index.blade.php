@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Articles') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-medium">Articles List</h3>
                        <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create Article
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mb-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- Tambahkan Kolom Image di Header --}}
                                    <th scope="col" class="px-6 py-3 w-32">Thumbnail</th>
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Author</th>
                                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articles as $article)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    {{-- 1. Kolom Gambar --}}
                                    <td class="px-6 py-4">
                                        @if($article->featured_image)
                                            {{-- Cek apakah dari Factory (http) atau Upload Manual --}}
                                            @if(Str::startsWith($article->featured_image, 'http'))
                                                <img src="{{ $article->featured_image }}" class="w-20 h-14 object-cover rounded shadow-sm">
                                            @else
                                                <img src="{{ asset('uploads/' . $article->featured_image) }}" class="w-20 h-14 object-cover rounded shadow-sm">
                                            @endif
                                        @else
                                            <div class="w-20 h-14 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-[10px] italic">No Image</div>
                                        @endif
                                    </td>

                                    {{-- 2. Kolom Title --}}
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ Str::limit($article->title, 50) }}
                                    </td>

                                    {{-- 3. Kolom Category --}}
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $article->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    {{-- 4. Kolom Author --}}
                                    <td class="px-6 py-4 text-xs">
                                        {{ $article->user->name ?? 'Anonymous' }}
                                    </td>

                                    {{-- 5. Kolom Actions --}}
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-3 text-xs">
                                            <a href="{{ route('admin.articles.edit', $article) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Hapus artikel ini?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">No articles found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
