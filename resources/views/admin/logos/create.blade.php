<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Logo</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold">Upload New Logo</h1>
        <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium">Logo</label>
                <input type="file" name="logo" class="mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium">Position</label>
                <select name="position" class="mt-1 block w-full" required>
                    <option value="front">Front</option>
                    <option value="back">Back</option>
                    <option value="bottom">Bottom</option>
                    <option value="middle">Middle</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
        </form>
    </div>
</body>
</html>
