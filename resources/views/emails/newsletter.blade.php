<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>{{ $subject }}</h1>
    <p>{!! nl2br(e($content)) !!}</p> <!-- You can use nl2br to preserve line breaks -->
</body>
</html>
