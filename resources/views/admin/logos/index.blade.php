<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Management</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold">Logo Management</h1>
        <a href="{{ route('admin.logos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Upload New Logo</a>

        <div class="grid grid-cols-3 gap-4 mt-8">
            @foreach ($logos as $logo)
                <div class="bg-white p-4 rounded shadow">
                    <img src="{{asset('logos/' . $logo->filename) }}" alt="{{ $logo->position }}" class="w-full h-48 object-cover rounded mb-4">
                    <h2 class="text-lg font-semibold">{{ ucfirst($logo->position) }}</h2>
                    <form action="{{ route('admin.logos.destroy', $logo->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </form>
                    <a href="{{ route('admin.logos.edit', $logo->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded mt-2 inline-block">Edit</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
