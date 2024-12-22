<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Logo</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold">Edit Logo</h1>
        <form action="{{ route('admin.logos.update', $logo->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('patch')
            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium">Logo</label>
                <input type="file" name="logo" class="mt-1 block w-full">
            </div>
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium">Position</label>
                <select name="position" class="mt-1 block w-full">
                    <option value="front" {{ $logo->position == 'front' ? 'selected' : '' }}>Front</option>
                    <option value="back" {{ $logo->position == 'back' ? 'selected' : '' }}>Back</option>
                    <option value="bottom" {{ $logo->position == 'bottom' ? 'selected' : '' }}>Bottom</option>
                    <option value="middle" {{ $logo->position == 'middle' ? 'selected' : '' }}>Middle</option>
                </select>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</body>
</html>
