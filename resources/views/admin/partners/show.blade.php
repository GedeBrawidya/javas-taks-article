@extends('layouts.app')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Partner Details') }}
        </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.partners.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">&larr; Back to Partners</a>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            @if($partner->logo)
                                @if(Str::startsWith($partner->logo, 'http'))
                                    <img src="{{ $partner->logo }}" class="w-32 h-32 object-cover rounded shadow-md border border-gray-200 dark:border-gray-700">
                                @else
                                    <img src="{{ asset('uploads/' . $partner->logo) }}" class="w-32 h-32 object-cover rounded shadow-md border border-gray-200 dark:border-gray-700">
                                @endif
                            @else
                                <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-sm italic">No Logo</div>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold mb-2">{{ $partner->company_name }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-4">
                                <div><span class="font-semibold text-gray-500 dark:text-gray-400">Email:</span> {{ $partner->email }}</div>
                                <div><span class="font-semibold text-gray-500 dark:text-gray-400">Phone:</span> {{ $partner->phone }}</div>
                                <div class="col-span-1 md:col-span-2"><span class="font-semibold text-gray-500 dark:text-gray-400">Address:</span> {{ $partner->address }}</div>
                                <div class="col-span-1 md:col-span-2"><span class="font-semibold text-gray-500 dark:text-gray-400">Description:</span> {{ $partner->deskription ?? '-' }}</div>
                                <div><span class="font-semibold text-gray-500 dark:text-gray-400">Registered By:</span> {{ $partner->user->name ?? 'System' }}</div>
                                <div>
                                    <span class="font-semibold text-gray-500 dark:text-gray-400">Status:</span> 
                                    <span class="px-2.5 py-0.5 ml-2 rounded-full text-xs font-medium 
                                        {{ $partner->status == 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                        {{ $partner->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                        {{ $partner->status == 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                    ">
                                        {{ ucfirst($partner->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ads List Section -->
            <div class="mb-4 flex justify-between items-center mt-8">
                <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">Ads by {{ $partner->company_name }}</h3>
                <a href="{{ route('admin.ads.create', ['partner_id' => $partner->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Add New Ad</a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Image</th>
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Position</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partner->ads as $ad)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        @if($ad->image)
                                            @if(Str::startsWith($ad->image, 'http'))
                                                <img src="{{ $ad->image }}" class="w-20 h-10 object-cover rounded shadow-sm">
                                            @else
                                                <img src="{{ asset('uploads/' . $ad->image) }}" class="w-20 h-10 object-cover rounded shadow-sm">
                                            @endif
                                        @else
                                            <div class="w-20 h-10 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-[10px] italic">No Image</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $ad->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 rounded text-xs">{{ $ad->position }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $ad->status == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                            {{ $ad->status == 'inactive' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                            {{ $ad->status == 'draft' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                        ">
                                            {{ ucfirst($ad->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">No ads found for this partner.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
