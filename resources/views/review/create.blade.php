
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Submit Your Review</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('review.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            <!-- Hidden product ID field -->
            <input type="hidden" name="product_id" value="{{ $productId }}">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="mt-1 p-2 w-full border rounded-md" required></textarea>
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <div class="flex items-center space-x-2">
                    <span class="star text-2xl cursor-pointer" data-value="1">&#9733;</span>
                    <span class="star text-2xl cursor-pointer" data-value="2">&#9733;</span>
                    <span class="star text-2xl cursor-pointer" data-value="3">&#9733;</span>
                    <span class="star text-2xl cursor-pointer" data-value="4">&#9733;</span>
                    <span class="star text-2xl cursor-pointer" data-value="5">&#9733;</span>
                </div>
                <input type="hidden" name="rating" id="rating" required>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Submit Review</button>
        </form>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;
                stars.forEach(star => {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-400');
                });
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('text-yellow-400');
                }
            });
        });
    </script>
