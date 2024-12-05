@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-4">
  <h2 class="text-lg font-semibold">Product List</h2>
  <a  href="{{route('product.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
    Add Product
</a>
</div>

<table class="min-w-full table-auto border-collapse">
  <thead>
    <tr class="bg-gray-100">
      <th class="px-4 py-2 border">Name</th>
      <th class="px-4 py-2 border">Price</th>
      <th class="px-4 py-2 border">Quantity</th>
      <th class="px-4 py-2 border">Brand</th>
      <th class="px-4 py-2 border">image</th>
      <th class="px-4 py-2 border">Options</th>
      

    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
    <tr class="bg-white">
      <td class="px-4 py-2 border"> {{$product->name}} </td>
      <td class="px-4 py-2 border">{{$product->price}}</td>
      <td class="px-4 py-2 border">{{$product->quantity}}</td>
      <td class="px-4 py-2 border"> {{$product->brand}}</td>
      <td class="px-4 py-2 border">
      <img src="{{ asset('/products/'.$product->image) }}" class="w-24" alt="">
        </td>

      <td class="px-4 py-2 border">
        <a href="{{route('product.edit', $product->id)}}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
        <form action="{{ route('product.delete', $product->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this room?');">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>




@endsection