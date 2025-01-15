@extends('layouts.admin')
@section('content')

<!-- Send Newsletter Section -->
<div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20  rounded-lg">
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.newsletter.subscribers') }}"
                class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-600 hover:text-white transition duration-300">
            View Subscribers
    </a>
    </div>
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Send Newsletter</h2>
    <form method="POST" action="{{ route('admin.newsletter.send.post') }}">
        @csrf
        <div class="mb-4">
            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
            <input type="text" id="subject" name="subject" class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" required></textarea>
        </div>
        {{-- <div class="mb-4">
            <label for="send_to_all" class="flex items-center">
                <input type="checkbox" id="send_to_all" name="send_to_all" class="mr-2">
                Send to all subscribers
            </label>
        </div> --}}
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            Send Newsletter
        </button>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Handle form submission via AJAX
        $('#newsletterForm').submit(function(event) {
            event.preventDefault();  // Prevent normal form submission

            var formData = $(this).serialize(); // Serialize the form data

            // Send AJAX request
            $.ajax({
                url: $(this).attr('action'),  // Form action (POST to route)
                method: 'POST',
                data: formData,
                success: function(response) {
                    // On success, show success message and clear the form
                    $('#success-message').text(response.message).show();
                    $('#error-message').hide(); // Hide any error messages
                    $('#newsletterForm')[0].reset(); // Reset the form
                },
                error: function(xhr) {
                    // On error, show error message
                    var errorMessage = xhr.responseJSON.message || 'Something went wrong.';
                    $('#error-message').text(errorMessage).show();
                    $('#success-message').hide(); // Hide any success messages
                }
            });
        });
    });
</script>
@endsection