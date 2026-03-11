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
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-medium">Tags List</h3>
                        <a href="{{ route('admin.tags.create') }}" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create Tag
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mb-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-4/5">Tag Name</th>
                                    <th scope="col" class="px-6 py-3 w-1/5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $tag->name ?? 'Unnamed' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('admin.tags.edit', $tag) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center">No tags found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function confirmDelete(tagId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This tag will be permanently removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#1f2937',
            confirmButtonText: 'Yes, delete it!',
            background: '#1f2937',
            color: '#ffffff',
            iconColor: '#f87171'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form berdasarkan ID yang kita buat di atas
                document.getElementById('delete-form-' + tagId).submit();
            }
        })
    }
</script>