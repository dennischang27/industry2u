<!DOCTYPE html>
<html>
<head>
    <title>Digital Ocean</title>
</head>
<body>
    <p>Hello, Good Day!</p>

    <br>

    <p>I am delighted to invite you on behalf of {{ $company }} to register as Purchaser and become their customer in Industry2u - Industry ecommerce system.</p>

    <br>

    <p>
        Steps to follow to register an account and become customer of {{ $company }}:
    </p>
        <ol>
            <li>Register an account in Industry2u - Industry ecommerce system</li>
            <li>Submit the company information included the SSM Form 9 to become a Purchaser</li>
            <li>Join to become a customer of {{ $company }}</li>
        </ol>

    <p> Click  <a href="{{ route('register') }}?code={{ $invitation_code }}&type=customer"> Here</a> to register today. </p>

    <br>
    <p>Thank You!</p>
    <br><br>

    <p>On behalf of</p> 
    <p>{{ $company }}</p>



</body>
</html>


