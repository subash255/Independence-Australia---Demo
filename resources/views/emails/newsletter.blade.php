<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>{{ $subject }}</h1>
    <p>{!! nl2br(e($content)) !!}</p> <!-- You can use nl2br to preserve line breaks -->
    @if($attachment)
        <img src="{{ $message->embed(public_path('attachment/' . $attachment)) }}" alt="Attachment Image">
    @endif
    
</body>
</html>
