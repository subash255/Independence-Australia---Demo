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

<div class="p-4 bg-white shadow-lg -mt-11 mx-4 z-20  rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Newsletter</h1>
    
    <form action="{{ route('admin.newsletter.update', $newsletter->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject', $newsletter->subject) }}"
                class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content"
                class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="6" required>{{ old('content', $newsletter->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment</label>
            <input type="file" id="attachment" name="attachment"
            class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            accept="image/*">
        @if ($newsletter->attachment)
            <p class="mt-2 text-sm text-gray-600">Current Attachment:</p>
            <div class="mt-2">
                <img src="{{ asset('attachment/'. $newsletter->attachment) }}" alt="Attachment Image" class="rounded" style="max-width: 100%; max-height: 150px; height: auto;">
            </div>
        @endif
        
        </div>

       

        <!-- Button Container -->
        <div class="flex justify-between gap-4 mt-8">
            <!-- Close Button -->
            <button type="button" id="closeModalButton"
            class="w-full md:w-auto bg-red-500 text-white py-2 px-4 font-semibold rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
            Cancel
        </button>
        

            <!-- Submit Button -->
            <button type="submit"
                class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                Update
            </button>
        </div>
    </form>
</div>

<script>
    // Close the modal
    document.getElementById('closeModalButton').addEventListener('click', function () {
        window.history.back(); // Go back to the previous page
    });
</script>

@endsection
