<!DOCTYPE html>
<html>
<head>
    <title>Digital Ocean</title>
</head>
<body>
    <p>Hello, Good Day!</p>
    <p>I am delighted to invite you on behalf of {{ $company }} to become their customer in Industry2u - Industry ecommerce system</p>
    <p>Click <a href="{{ route('user.suppliermanagement.mysupplier') }}?code={{ $invitation_code }}">Here</a> to join today.</p>
    
    <p>Thank You!</p>
    <p>On behalf of</p>
    <p>{{ $company }}</p>

</body>
</html>
