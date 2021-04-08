<!DOCTYPE html>
<html>
<head>
    <title>Industry2u</title>
</head>
<body>
    <p>Hello,</p>
    <p>{{ $supplier_company_name }} has submitted a Quotation as per requested in <a href="{{ route('home') }}">Industry2u Inductry ecommerce system</a></p>
    <p>Please click below link for the Quotation Detail <br/><a href="{{ route('buyer.quote.issued') }}">{{ route('seller.quote') }}</a></p>
    <p>On behalf of<br/>
       {{ $supplier_company_name }}</p>
</body>
</html>
