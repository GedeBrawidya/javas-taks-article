@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Partners') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Partner List</h3>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mb-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
                            <tbody>
                                @forelse($partners as $partner)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    {{-- 1. Kolom Gambar/Logo --}}
                                    <td class="px-6 py-4">
                                        @if($partner->logo)
                                            @if(Str::startsWith($partner->logo, 'http'))
                                                <img src="{{ $partner->logo }}" class="w-16 h-16 object-cover rounded shadow-sm">
                                            @else
                                                <img src="{{ asset('uploads/' . $partner->logo) }}" class="w-16 h-16 object-cover rounded shadow-sm">
                                            @endif
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-[10px] italic">No Logo</div>
                                        @endif
                                    </td>

                                    {{-- 2. Kolom Company --}}
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <div class="text-base font-bold">{{ $partner->company_name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $partner->email }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $partner->phone }}</div>
                                    </td>

                                    {{-- 3. Kolom Address/Status --}}
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $partner->status == 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                            {{ $partner->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                            {{ $partner->status == 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                        ">
                                            {{ ucfirst($partner->status) }}
                                        </span>
                                    </td>

                                    {{-- 4. Kolom Actions --}}
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-3 text-sm items-center">
                                            <a href="{{ route('admin.partners.show', $partner->id) }}" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">View Details</a>
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Hapus partner ini?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">No partners found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $partners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
