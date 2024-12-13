@extends('layouts.admin')

@section('content')

{{-- Flash Message --}}
@if(session('success'))
  <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
      {{ session('success') }}
  </div>
@endif

<script>
    if (document.getElementById('flash-message')) setTimeout(() => {
        const msg = document.getElementById('flash-message');
        msg.style.opacity = 0;
        msg.style.transition = "opacity 0.5s ease-out";
        setTimeout(() => msg.remove(), 500);
    }, 3000);
</script>

<div class="max-w-8xl mx-auto p-6 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.admin.create') }}"
        class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">Add
            Admin</a>
    </div>

    <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
        <div class="flex items-center space-x-2">
            <label for="entries" class="mr-2 text-gray-700">Show entries:</label>
            <select id="entries" class="border border-gray-300 px-2 py-1 w-full sm:w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>

        <div class="flex items-center space-x-2 w-full sm:w-auto">
            <span class="text-gray-700">Search:</span>
            <input type="text" id="search" placeholder="Search admins..."
                class="border border-gray-300 px-4 py-2 w-full sm:w-96" />
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">S.N</th>
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="border border-gray-300 hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $admin->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $admin->email }}</td>

                        <!-- Action Buttons -->
                        <td class="px-2 py-2 flex justify-center space-x-4">
                            <!-- Edit Icon -->
                            <a href="{{ route('admin.admin.edit', ['user' => $admin->id]) }}"
                               class="bg-blue-500 hover:bg-blue-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="ri-edit-box-line text-white"></i>
                            </a>

                            <!-- Delete Icon -->
                            <form action="{{ route('admin.admin.destroy', ['user' => $admin->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                @csrf
                                @method('delete')
                                <button class="bg-red-500 hover:bg-red-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="ri-delete-bin-line text-white"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2">
            <span class="ml-4 text-gray-700">
                Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }}
                entries
            </span>
        </div>

        <div class="flex items-center space-x-2">
            {{ $admins->links() }}
        </div>
    </div>

</div>


@endsection
