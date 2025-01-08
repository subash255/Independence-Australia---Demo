@extends('layouts.master')
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

<div class="flex flex-col lg:flex-row"> 
    <!-- Sidebar/Nav Section -->
    <nav class="w-[21%] p-6 font-semibold mt-10">
        <a href="{{ route('user.welcome') }}" 
           class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
           hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
           {{ request()->routeIs('user.welcome') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">Account Dashboard</span>
        </a>
        <a href="#" 
           class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
           hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
           {{ request()->routeIs('user.orders.index') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">Web Orders</span>
        </a>
        <a href="{{ route('user.contact.index') }}" 
           class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
           hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
           {{ request()->routeIs('user.contact.index') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">My Information</span>
        </a>
        <a href="#" 
           class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
           hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
           {{ request()->routeIs('user.company.profile') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">Company Profile</span>
        </a>
        <!-- Conditionally show User Management link only if the user is a vendor -->
        @if(Auth::user()->role == 'vendor') <!-- Adjust this based on your role check -->
        <a href=" {{ route('user.manageuser.index') }}" 
           class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
           hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
           {{ request()->routeIs('user.manageuser.index') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">User Management</span>
        </a>


        @endif
    </nav>
    
    <div class="lg:w-[79%] w-full p-6 mt-4">
    <div class="mb-4 flex justify-end">
        <a href="{{ route('user.manageuser.create') }}"
            class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-500 hover:text-white transition duration-300">Add
            User</a>
    </div>

    <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
        <div class="flex items-center space-x-2">
            <label for="entries" class="mr-2">Show entries:</label>
            <select id="entries" class="border border-gray-300 px-5 py-1 w-full sm:w-auto pr-10" onchange="updateEntries()">
                <option value="5" {{ request('entries') == 5 ? 'selected' : '' }}>5</option>
                <option value="15" {{ request('entries') == 15 ? 'selected' : '' }}>15</option>
                <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
            </select>
        </div>
    

        <div class="flex items-center space-x-2 w-full sm:w-auto">
            <span class="text-gray-700">Search:</span>
            <input type="text" id="search" placeholder="Search..."
                class="border border-gray-300 px-4 py-2 w-full sm:w-96" />
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Order</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        
                        <td class="px-2 py-2 mt-2 flex justify-center space-x-4">
                            <!-- Edit Icon -->
                            <a href="" class="bg-blue-500 hover:bg-blue-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="ri-edit-box-line text-white"></i>
                            </a>
                            <!-- Delete Icon -->
                            <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                entries
            </span>
        </div>

        <div class="flex items-center space-x-2">
            {{ $users->links() }}
        </div>
    </div>
    </div>
</div>


<script>
    
    function updateEntries() {
        const entries = document.getElementById('entries').value;
        const url = new URL(window.location.href);
        url.searchParams.set('entries', entries); 
        window.location.href = url; 
    }
</script>

@endsection
