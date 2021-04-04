<!DOCTYPE html>
<html>
<head>
    <title>Industry2u</title>
</head>
<body>
    <p>Hello,</p>
    <p>{{ $firstname }} {{ $lastname }} has verified a Quotation in <a href="{{ route('home') }}">Industry2u Inductry ecommerce system</a></p>
    <p>Please click below link for the Quotation Detail <br/><a href="{{ route('buyer.quote.issued') }}">{{ route('buyer.quote.issued') }}</a></p>
    <p>On behalf of<br/>
       {{ $firstname }} {{ $lastname }}</p>
</body>
</html>
