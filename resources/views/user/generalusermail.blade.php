<!DOCTYPE html>
<html>
<head>
    <title>Digital Ocean</title>
</head>
<body>
    <p>Hello,</p>
    <p>Join {{ $company }} as a user in Industry2u Industry ecommerce system.</p>
    <p>Join <a href="{{ route('user.account') }}?code={{ $invitation_code }}">Here</a></p>
    <p>On behalf of</p>
    <p>{{ $company }}</p>
</body>
</html>
