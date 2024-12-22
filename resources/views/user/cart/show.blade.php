<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @elseif(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <!-- Checkout form -->
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <h3>Billing Information</h3>
        <label for="billing_first_name">First Name:</label>
        <input type="text" id="billing_first_name" name="billing[first_name]" value="{{ old('billing.first_name') }}" required><br>

        <label for="billing_last_name">Last Name:</label>
        <input type="text" id="billing_last_name" name="billing[last_name]" value="{{ old('billing.last_name') }}" required><br>

        <label for="billing_address_1">Address 1:</label>
        <input type="text" id="billing_address_1" name="billing[address_1]" value="{{ old('billing.address_1') }}" required><br>

        <label for="billing_city">City:</label>
        <input type="text" id="billing_city" name="billing[city]" value="{{ old('billing.city') }}" required><br>

        <label for="billing_state">State:</label>
        <input type="text" id="billing_state" name="billing[state]" value="{{ old('billing.state') }}" required><br>

        <label for="billing_postcode">Postcode:</label>
        <input type="text" id="billing_postcode" name="billing[postcode]" value="{{ old('billing.postcode') }}" required><br>

        <label for="billing_country">Country:</label>
        <input type="text" id="billing_country" name="billing[country]" value="{{ old('billing.country') }}" required><br>

        <label for="billing_email">Email:</label>
        <input type="email" id="billing_email" name="billing[email]" value="{{ old('billing.email') }}" required><br>

        <label for="billing_phone">Phone:</label>
        <input type="text" id="billing_phone" name="billing[phone]" value="{{ old('billing.phone') }}" required><br>

        <h3>Shipping Information</h3>
        <label for="shipping_first_name">First Name:</label>
        <input type="text" id="shipping_first_name" name="shipping[first_name]" value="{{ old('shipping.first_name') }}" required><br>

        <label for="shipping_last_name">Last Name:</label>
        <input type="text" id="shipping_last_name" name="shipping[last_name]" value="{{ old('shipping.last_name') }}" required><br>

        <label for="shipping_address_1">Address 1:</label>
        <input type="text" id="shipping_address_1" name="shipping[address_1]" value="{{ old('shipping.address_1') }}" required><br>

        <label for="shipping_city">City:</label>
        <input type="text" id="shipping_city" name="shipping[city]" value="{{ old('shipping.city') }}" required><br>

        <label for="shipping_state">State:</label>
        <input type="text" id="shipping_state" name="shipping[state]" value="{{ old('shipping.state') }}" required><br>

        <label for="shipping_postcode">Postcode:</label>
        <input type="text" id="shipping_postcode" name="shipping[postcode]" value="{{ old('shipping.postcode') }}" required><br>

        <label for="shipping_country">Country:</label>
        <input type="text" id="shipping_country" name="shipping[country]" value="{{ old('shipping.country') }}" required><br>

        <button type="submit">Submit Order</button>
    </form>
</body>
</html>
