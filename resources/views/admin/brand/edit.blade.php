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

<div class="max-w-8xl mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <h1 class="text-2xl font-bold mb-4">Edit Brand</h1>

    <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Brand Name Field -->
        <div class="mb-6">
            <label for="name" class="block text-lg font-medium text-gray-700">Brand Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg" required>
        </div>

        <!-- Brand Image Field -->
        <div class="mb-6">
            <label for="image" class="block text-lg font-medium text-gray-700">Brand Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="mt-2 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border-0 file:rounded-full file:text-sm file:bg-blue-100 hover:file:bg-blue-200">
            
            @if($brand->image)
                <div class="mt-2">
                    <img src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-24 h-24 object-cover rounded-md">
                </div>
            @endif
        </div>

        <!-- Button Container -->
        <div class="flex justify-between gap-4 mt-8">
            <!-- Cancel Button -->
            <button type="button" id="closeModalButton" class="w-full md:w-auto bg-red-500 font-semibold text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
                Cancel
            </button>

            <!-- Submit Button -->
            <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                Update Brand
            </button>
        </div>
    </form>
</div>

<script>
    // Close the modal or go back to the previous page
    document.getElementById('closeModalButton').addEventListener('click', function () {
        window.history.back(); // Go back to the previous page
    });
</script>

@endsection
