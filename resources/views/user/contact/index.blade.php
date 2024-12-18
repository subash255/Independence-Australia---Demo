<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
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

    <!-- Container -->
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h2 class="text-2xl font-bold mb-6 text-center">User Information Form</h2>

        <form action="{{ route('user.contact.store') }}" method="POST">
            @csrf 
            <input type="hidden" name="user_id" value="{{ $userId }}">

            <!-- Flex Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Contact Information -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Contact Information</h3>
                    
                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" 
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" 
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="contact_info" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" id="contact_info" name="contact_info" placeholder="XX XXXX XXXX"
                               value="{{ old('contact_info') }}"
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               required>
                    </div>
                </div>

                <!-- Address Information -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Address</h3>

                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Please enter your address</label>
                        <input type="text" id="address" name="address" placeholder="e.g. 123 Long Street, Melbourne VIC, 3000" 
                               value="{{ old('address') }}"
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               required>
                    </div>

                    <!-- Default Billing and Shipping -->
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="is_billing" name="is_billing" value="yes" 
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_billing" class="ml-2 text-sm text-gray-600">Use as my default billing address</label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="is_shipping" name="is_shipping" value="yes" 
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_shipping" class="ml-2 text-sm text-gray-600">Use as my default shipping address</label>
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" 
                                class="w-full md:w-1/2 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Address
                        </button>
                    </div>
                </div>
                
            </div>

            <!-- Save Address Button -->
            
        </form>
    </div>

</body>
</html>
