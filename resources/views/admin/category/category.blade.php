@extends('layouts.admin')
@section('content')

{{-- Flash Message --}}
@if(session('success'))
    <div class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-8xl mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">

    <div class="mb-4 flex justify-end">
      <a href="{{ route('admin.category.addcategory') }}" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-white hover:text-red-500">Add Category</a>
    </div>

    <div class="flex justify-between mb-4">
      <div>
        <label for="entries" class="mr-2">Show entries:</label>
        <select id="entries" class="border border-gray-300 px-2 py-1">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
        </select>
      </div>

      <div class="flex items-center space-x-2">
        <span class="text-gray-700">Search:</span>
        <input type="text" id="search" placeholder="Search..." class="border border-gray-300 px-4 py-2 w-96" />
      </div>
    </div>

    <table class="min-w-full border-collapse border border-gray-300">
      <thead>
        <tr>
          <th class="border border-gray-300 px-4 py-2">Order</th>
          <th class="border border-gray-300 px-4 py-2">Image</th>
          <th class="border border-gray-300 px-4 py-2">Category Name</th>
          <th class="border border-gray-300 px-4 py-2">Slug</th>
          <th class="border border-gray-300 px-4 py-2">Status</th>
          <th class="border border-gray-300 px-4 py-2">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>

          <!-- Displaying the Image -->
          <td class="border border-gray-300 px-4 py-2">
            <img src="{{ asset('images/brand/' . $category->image) }}" alt="{{ $category->category_name }}" class="w-12 h-12 object-cover rounded-full">
          </td>

          <td class="border border-gray-300 px-4 py-2">{{ $category->category_name }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ $category->slug }}</td>
          <td class="border border-gray-300 px-4 py-2">
            <label for="status{{ $category->id }}" class="inline-flex items-center cursor-pointer">
              <input id="status{{ $category->id }}" type="checkbox" class="hidden" {{ $category->status ? 'checked' : '' }} />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-4">
            <!-- Corrected the edit route and passed category id -->
            <a href="{{ route('admin.category.editcategory', ['id' => $category->id]) }}" class="text-white bg-blue-500 hover:bg-blue-700 p-2 py-0 "><i class="ri-edit-box-line"></i></a>
            <form action="{{ route('admin.category.deletecategory', ['id' => $category->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this category?');">
              @csrf
              @method('delete')
              <button class="text-white bg-red-500 hover:bg-red-700 p-2">
                <i class="ri-delete-bin-line"></i>
              </button>
            </form>

            <button class="text-white bg-green-500 hover:bg-green-700 p-2 "><i class="ri-settings-5-line"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
      <div class="flex items-center space-x-2">
        <span class="ml-4 text-gray-700">
          Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries
        </span>
      </div>

      <div class="flex items-center space-x-2">
        {{ $categories->links() }}
      </div>
    </div>

  </div>

@endsection
