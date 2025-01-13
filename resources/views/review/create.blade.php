<div class="container mx-auto p-8 max-w-2xl">
    <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Submit Your Review</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md shadow-lg mb-6 text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('review.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-xl">
        @csrf

        <!-- Hidden product ID field -->
        <input type="hidden" name="product_id" value="{{ $productId }}">

        <!-- Email field -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
        </div>

        <!-- Message field -->
        <div class="mb-6">
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
            <textarea name="message" id="message" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required></textarea>
        </div>

        <!-- Rating field -->
        <div class="mb-6">
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

        <!-- Submit button -->
        <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white text-lg font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none">Submit Review</button>
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

        star.addEventListener('mouseover', function () {
            const value = this.getAttribute('data-value');
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('text-yellow-300');
                } else {
                    star.classList.remove('text-yellow-300');
                }
            });
        });

        star.addEventListener('mouseout', function () {
            stars.forEach(star => {
                star.classList.remove('text-yellow-300');
            });
        });
    });
</script>
