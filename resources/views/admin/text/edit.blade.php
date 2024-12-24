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
    <h1 class="text-2xl font-bold mb-4">Edit Text</h1>
    
    <form action="{{ route('admin.text.update', $text->id) }}" method="POST"  class="mt-6">
        @csrf
        @method('PATCH')

        <!-- Text Input -->
        <div class="mb-6">
            <label for="text" class="block text-sm font-medium text-gray-700">Text Content</label>
            <textarea id="text" name="text" rows="4" placeholder="Enter text here"
                class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">{{ old('content', $text->content) }}</textarea>
        </div>

        <!-- Priority Input -->
        <div class="mb-6">
    <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
    <select id="priority" name="priority" class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">
        <option value="" disabled>Select priority</option>
        
        <!-- Add the current priority of the text being edited -->
        <option value="{{ $text->priority }}" selected>
            Current: {{ $text->priority }}
        </option>
        
        <!-- Loop through available priorities to populate the rest of the dropdown -->
        @foreach ($availablePriorities as $priority)
            <option value="{{ $priority }}" 
                {{ $priority == old('priority', $text->priority) ? 'selected' : '' }}>
                {{ $priority }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Button Container -->
                <div class="flex justify-between gap-4 mt-8">
                    <!-- Close Button -->
                    <button type="button" id="closeModalButton"
                    class="w-full md:w-auto bg-red-500 font-semibold text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
                    Cancel
                </button>
    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                        Save Text
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
