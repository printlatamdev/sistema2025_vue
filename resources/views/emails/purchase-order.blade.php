<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orden de compra</title>
</head>
<body>
    <div style="padding: 25px">
        <h1>{{ $emailData['title'] }} #{{ $emailData['purchaseorder_id'] }}</h1>
        {{ $emailData['body'] }}
    </div>
  
</body>
</html>