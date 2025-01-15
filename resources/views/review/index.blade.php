<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<style>
    /* Hide the modal */
    .modal-hidden {
        display: none !important;
    }

    /* Show the modal with flex */
    .modal-visible {
        display: flex !important;
    }
</style>
@if(session('error'))
  <div id="flash-message" class="bg-red-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('error') }}
    </div>
@endif

<!-- Full-Width Container -->
<div class="w-full p-8">

    <!-- Average Rating and Add Review Button Section -->
    <div class="flex justify-between items-center mb-8">
        <!-- Average Rating -->
        <div class="text-left">
            <p class="text-xl font-medium text-gray-800">Average Rating</p>
            <div class="flex justify-start items-center space-x-1 mt-2">
                @php
                $averageRating = $reviews->avg('rating');
                @endphp
                @for ($i = 0; $i < round($averageRating); $i++) <i class="ri-star-fill text-yellow-400 text-xl"></i>
                    @endfor
                    @for ($i = round($averageRating); $i < 5; $i++) <i class="ri-star-line text-gray-300 text-xl"></i>
                        @endfor
            </div>
            <p class="text-sm text-gray-500 mt-2">Based on {{ $reviews->count() }} reviews</p>
        </div>

        <!-- Add Your Review Button -->
        <button id="openModalButton"
            class="inline-block bg-blue-600 text-white text-lg font-medium py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-300">
            Add Your Review
        </button>
    </div>

    <h1 class="text-4xl font-semibold text-center text-gray-900 mb-8">Customer Reviews</h1>

    <!-- Reviews Section -->

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($reviews as $review)
            <div x-data="{ open: false }" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 min-h-[250px]">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold text-gray-900">{{ $review->user->name }} {{ $review->user->last_name }}</p>
                    <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                </div>
                
                <!-- Review Message (Initially truncated to 2 lines) -->
                <p :class="open ? 'line-clamp-none' : 'line-clamp-2'" class="mt-3 text-gray-700 leading-relaxed">
                    {{ $review->message }}
                </p>
                
                <!-- Show More / Show Less Button -->
                <button @click="open = !open" class="text-sm text-blue-500 mt-2">
                    <span x-text="open ? 'Show Less' : 'Show More'"></span>
                </button>
                
                <!-- Star Rating -->
                <div class="flex items-center space-x-1 mt-3">
                    @for ($i = 0; $i < $review->rating; $i++)
                        <i class="ri-star-fill text-yellow-400 text-xl"></i>
                    @endfor
                    @for ($i = $review->rating; $i < 5; $i++)
                        <i class="ri-star-line text-gray-300 text-xl"></i>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
    

   
    <div id="reviewModal"
    class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px]">
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
        <h1 class="text-3xl font-semibold text-center mb-6 text-gray-800">Submit Your Review</h1>

      

        <form action="{{ route('review.store')}}" method="POST" class="space-y-6">
            @csrf

            <!-- Hidden product ID field -->
            <input type="hidden" name="product_id" value="{{ $product->id }}">


            <!-- Message field -->
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                <textarea name="message" id="message" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    required></textarea>
            </div>

            <!-- Rating field -->
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                <div class="flex items-center space-x-2 cursor-pointer">
                    <span class="star text-3xl" data-value="1">&#9733;</span>
                    <span class="star text-3xl" data-value="2">&#9733;</span>
                    <span class="star text-3xl" data-value="3">&#9733;</span>
                    <span class="star text-3xl" data-value="4">&#9733;</span>
                    <span class="star text-3xl" data-value="5">&#9733;</span>
                </div>
                <input type="hidden" name="rating" id="rating" required>
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
                    class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-4 ml-[13rem] rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>



<script>
    // Check if the user is authenticated by passing the auth state from Laravel Blade to JavaScript
    const isAuthenticated = @auth true @else false @endauth;

    // Open the modal
    document.getElementById('openModalButton').addEventListener('click', function() {
        if (isAuthenticated) {
            // User is authenticated, show the modal
            const reviewModal = document.getElementById('reviewModal');
            reviewModal.classList.remove('modal-hidden');
            reviewModal.classList.add('modal-visible'); // Show modal
            document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open

            // Set the first star as the default (1 star)
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');
            ratingInput.value = 1; // Default rating value is 1
            stars.forEach((star, index) => {
                if (index < 1) {
                    star.classList.add('text-yellow-400'); // Highlight the first star
                } else {
                    star.classList.remove('text-yellow-400'); // Reset the rest
                }
            });
        } else {
            // User is not authenticated, show an alert
            alert('You must log in to leave a review. Please log in to continue.');
        }
    });

    // Close the modal
    document.getElementById('closeModalButton').addEventListener('click', function() {
        const reviewModal = document.getElementById('reviewModal');
        reviewModal.classList.remove('modal-visible');
        reviewModal.classList.add('modal-hidden'); // Hide modal
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    });

    // Rating functionality
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    // Set default gray stars on page load (no hover or click)
    stars.forEach(star => {
        star.classList.add('text-gray-400'); // Ensure stars are gray by default
    });

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;
            stars.forEach(star => {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-400');
            });
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('text-yellow-400'); // Highlight the selected stars in yellow
            }
        });

        star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('text-yellow-300'); // Light yellow when hovering
                } else {
                    star.classList.remove('text-yellow-300');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            stars.forEach(star => {
                star.classList.remove('text-yellow-300'); // Remove light yellow when mouse is out
            });
        });
    });
</script>

