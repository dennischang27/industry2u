<!DOCTYPE html>
<html>
<head>
    <title>Industry2u</title>
</head>
<body>
    <p>Hello,</p>
    <p>{{ $purchaser }} has submitted a Quotation Request in <a href="{{ route('home') }}">Industry2u Inductry ecommerce system</a></p>
    <p>Please click below link for the Quotation Request Detail <br/><a href="{{ route('seller.quote') }}">{{ route('seller.quote') }}</a></p>
    <p>On behalf of<br/>
       {{ $purchaser }}</p>
</body>
</html>
