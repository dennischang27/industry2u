<!DOCTYPE html>
<html>
<head>
    <title>Industry2u</title>
</head>
<body>
    <p>Hello,</p>
    <p>{{ $firstname }} {{ $lastname }} has submitted a Quotation Approval Request in <a href="{{ route('home') }}">Industry2u Inductry ecommerce system</a></p>
    <p>Please click below link for Quotation Details <br/><a href="{{ route('seller.quote') }}">{{ route('seller.quote') }}</a></p>
    <p>On behalf of<br/>
       {{ $firstname }} {{ $lastname }}</p>
</body>
</html>
