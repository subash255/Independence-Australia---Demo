@extends('layouts.admin')
@section('content')
    {{-- Flash Message --}}
    @if (session('success'))
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

    <div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20  rounded-lg">
        <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
            <div class="flex items-center space-x-2">
                <label for="entries" class="mr-2">Show entries:</label>
                <select id="entries" class="border border-gray-300 px-5 py-1 w-full sm:w-auto pr-10"
                    onchange="updateEntries()">
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

        <div class="">
            <!-- Table Section -->
            <table id="orderTable" class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">S.N</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Billing Address</th>
                        <th class="border border-gray-300 px-4 py-2">Shipping Address</th>
                        <th class="border border-gray-300 px-4 py-2">Total Products</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @php
                            $billing = json_decode($order->billings);
                            $shipping = json_decode($order->shippings);
                        @endphp
                        <tr class="border border-gray-300 items-center">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->user->name }}
                                {{ $order->user->last_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">${{ ucfirst($order->total) }} </td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->status) }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $billing->first_name }}<br>
                                {{ $billing->last_name }}<br>
                                {{ $billing->address_1 }}<br>
                                {{ $billing->city }}<br>
                                {{ $billing->country }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $shipping->first_name }}<br>
                                {{ $shipping->last_name }}<br>
                                {{ $shipping->address_1 }}<br>
                                {{ $shipping->city }}<br>
                                {{ $shipping->country }}
                            </td>
                            <td class="border border-gray-300 px-2 py-2">
    @if (isset($order->orderitems) && count($order->orderitems) > 0)
        <div class="px-4 py-2">
            <span class="font-semibold"> {{ collect($order->orderitems)->unique('sku')->count() }}</span>
        </div>
    @else
        <div class="px-4 py-2 text-center">No items available</div>
    @endif
</td>
                            <td class="px-2 py-2 flex justify-center items-center space-x-4">
                                <a href="{{ route('admin.order.view', $order->id) }}" class="flex items-center">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
                                        <i class="ri-eye-line text-white"></i>
                                    </button>
                                </a>
                                <!-- Delete button -->
                                <form action="#" class="flex items-center">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
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
                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of
                    {{ $orders->total() }}
                    entries
                </span>
            </div>

            <div class="flex items-center space-x-2">
                {{ $orders->links() }}
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


        document.getElementById('search').addEventListener('input', function() {
            const searchQuery = this.value.toLowerCase();
            history.pushState(null, null, `?search=${searchQuery}`);
            filterTableByUsername(searchQuery);
        });


        function filterTableByUsername(query) {
            const rows = document.querySelectorAll('#orderTable tbody tr');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                const usernameCell = cells[4];

                if (usernameCell.textContent.toLowerCase().startsWith(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        window.addEventListener('popstate', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const searchQuery = urlParams.get('search') || '';
            document.getElementById('search').value = searchQuery;
            filterTableByUsername(searchQuery);
        });
    </script>
@endsection
