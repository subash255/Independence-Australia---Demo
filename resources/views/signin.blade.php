 @extends('layouts.master')
 @section('content')

 @vite(['resources/css/app.css', 'resources/js/app.js'])
 <!-- Hero Section -->
 <section class="relative bg-blue-50 py-16 pt-32 mt-7">
    <div class="absolute inset-0 bg-center bg-cover opacity-40" style="background-image: url('images/hand.jpg');">
    </div>
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center">
        <p class="text-gray-600">Home | Sign In</p>
        <h1 class="text-4xl font-bold text-[#00718f]">Sign In</h1>
    </div>
</section>

<!-- Main Content -->
<main class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <div class="p-6 rounded-lg bg-white space-y-10 mb-6">
            <h2 class="text-3xl font-extrabold text-[#00718f]">Registered Customer</h2>
            <form method="POST" action="{{route('login')}}" >
                @csrf
                <div class="mb-6 flex items-center">
                    <label class="block text-lg font-normal text-gray-700 mr-4 w-1/4">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-3/4 py-2 px-4 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-6 flex items-center">
                    <label class="block text-lg font-normal text-gray-700 mr-4 w-1/4">Password</label>
                    <input type="password" name="password" placeholder="Enter your password"
                        class="w-3/4 py-2 px-4 border border-gray-300 rounded-lg">
                </div>
                <div class="flex items-center justify-between mb-4">
                    <button type="submit"
                        class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
                        Sign In
                    </button>
                    <a href="{{route('password.request')}}" class="text-[#00718f] text-lg font-semibold">Forgot Your Password?</a>
                </div>
            </form>
        </div>

        <!-- New Customer -->
        <div class="p-6 rounded-lg bg-white flex flex-col items-start justify-start space-y-8 mb-6">
            <h2 class="text-3xl font-extrabold text-[#00718f] mb-4">New Customer</h2>
            <p class="text-gray-600 mb-4">Creating an account has many benefits: check out faster, keep more than
                one address, track orders, and more.</p>
           <a href="/create"> <button type="button"
            class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
            Create an Account
            </button></a>
        </div>

    </div>
</main>

@endsection