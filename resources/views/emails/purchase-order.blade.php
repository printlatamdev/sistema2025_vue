<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lorem</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body{
            color: #161A30;
        }
        
        .montserrat {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .sect2{
            padding: 10px;
            text-align: center;
        }
        .sect3 {
            background: #0F547F;
            border-radius: 5px;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .p1{
            color: #0F547F;
        }
        .producttable{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid;

        }
        .widthproduct{
            width: 10%;
            background: #0F547F !important;
            padding: 2px;
            color: white;
        }
        .producttable  .widthproduct{
            border: 1px solid black;
        }
        .borderstable{
            border: 1px solid black; padding:7px
        }
    </style>
</head>
<body class="montserrat">
    <div style="padding:25px">
        <h1>{{ $emailData['title'] }} Orden No. {{ $emailData['purchaseorder_id'] }}</h1>
        @php 
            echo $emailData['body'];
        @endphp
    </div>
</body>
</html>