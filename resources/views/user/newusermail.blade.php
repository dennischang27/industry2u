<!DOCTYPE html>
<html>
<head>
    <title>Digital Ocean</title>
</head>
<body>
    <p>Hello,</p>
    <p>{{ $company }} would like to invite you to register an account in Industry2u Industry ecommerce system</p>
    <p>Register <a href="{{ route('register') }}?code={{ $invitation_code }}">Here</a></p>
    <p>On behalf of</p>
    <p>{{ $company }}</p>
</body>
</html>
