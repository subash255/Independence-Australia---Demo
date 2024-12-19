

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
</head>
<body>
    <h1>Upload Products CSV</h1>

    <!-- Display success message if available -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ url('/upload-csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="csv_file">Choose CSV File:</label>
        <input type="file" name="csv_file" accept=".csv, .xlsx" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
