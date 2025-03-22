<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Please click the following link to verify your email address:</p>
    <a href="{{ route('api.verify', ['token' => $user->verification_token]) }}">Verify Email</a>
</body>
</html>