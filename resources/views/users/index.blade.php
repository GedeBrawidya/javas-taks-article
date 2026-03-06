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
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-medium">Users List</h3>
                        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create User
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mb-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-2/5">Name</th>
                                    <th scope="col" class="px-6 py-3 w-2/5">Email</th>
                                    <th scope="col" class="px-6 py-3 w-1/5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete('{{ $user->id }}')"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center">No users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This user's data will be permanently removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5', // Warna Indigo sesuai tombol Create kamu
            cancelButtonColor: '#1f2937',  // Warna gelap
            confirmButtonText: 'Yes, delete it!',
            background: '#1f2937',         // Background gelap sesuai dashboard
            color: '#ffffff',              // Teks putih
            iconColor: '#f87171'           // Warna merah untuk icon warning
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik OK, submit form-nya
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>
