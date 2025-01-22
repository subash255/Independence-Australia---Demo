@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-16 text-center">
    <h1 class="text-3xl font-semibold text-green-600">Thank you for your purchase!</h1>
    <p class="mt-4 text-lg text-gray-600">Your order has been successfully processed.</p>
    <p class="mt-4 text-lg text-gray-800">Order ID: {{ $order->id }}</p>
</div>
@endsection
