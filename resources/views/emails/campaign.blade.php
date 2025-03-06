<!DOCTYPE html>
<html>
<head>
    <title>{{ $campaign->subject }}</title>
</head>
<body>
    <div>
        {!! nl2br(e($content)) !!}
    </div>
</body>
</html>
