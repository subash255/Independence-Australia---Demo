<!-- resources/views/reviews/index.blade.php -->


    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Customer Reviews</h1>

        <div class="space-y-6">
            @foreach($reviews as $review)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-lg font-semibold">{{ $review->email }}</p>
                    <p class="mt-2 text-gray-700">{{ $review->message }}</p>
                    <div class="mt-2 text-yellow-400">
                        @for($i = 0; $i < $review->rating; $i++)
                            &#9733;
                        @endfor
                        @for($i = $review->rating; $i < 5; $i++)
                            &#9734;
                        @endfor
                    </div>
                    <p class="mt-2 text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    </div>
