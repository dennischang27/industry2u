<!DOCTYPE html>
<html>
<head>
    <title>Industry2u</title>
</head>
<body>
    <p>Hello,</p>
    <p>Your quotation request had been submitted to {{ $supplier_company_name }}</p>
    <p>Please click below link to check the status <br/><a href="{{ route('buyer.quote') }}">{{ route('buyer.quote') }}</a></p>
    <p>On behalf of<br/>
       {{ $firstname }} {{ $lastname }}</p>
</body>
</html>
