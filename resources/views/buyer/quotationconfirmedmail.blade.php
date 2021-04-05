<!DOCTYPE html>
<html>
<head>
    <title>Industry2u</title>
</head>
<body>
    <p>Hello,</p>
    <p>{{ $purchaser }} has confirmed the Quotation in <a href="{{ route('home') }}">Industry2u Inductry ecommerce system</a></p>
    <p>Please click below link for the Quotation Detail <br/><a href="{{ route('seller.quote.issued') }}">{{ route('seller.quote') }}</a></p>
    <p>On behalf of<br/>
       {{ $purchaser }}</p>
</body>
</html>
