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
            font-size: 14px;
        }
        
        .montserrat {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .maintable{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid;
            margin-top: 7px;
        }
        .widthTable{
            width: 10%;
            background: #DDDDDD !important;
            padding: 2px;
        }
        .maintable  .widthTable{
            border: 1px solid #161A30;
        }
        .borderstable{
            border: 1px solid #161A30; padding:7px
        }
    </style>
</head>
<body class="montserrat">
    @foreach ($data['purchaseorder'] as $item)
        <!--first section-->
        <table style="width:100%">
            <tr>
                <td style="width:50%; float:left;">
                    <img src="{{ public_path('images/logo.jpg') }}" style="width:40%" />
                </td>
                <td style="width:50%; float:right">ORDEN No. {{ $item['id'] }}<br></td>
            </tr>
        </table>
        <!--second section-->
        <table class="maintable">
            <tr>
                <th class="widthTable">FECHA</th>
                <th class="widthTable">PROVEEDOR</th>
                <th class="widthTable">SOLICITADO POR</th>
                <th class="widthTable">AUTORIZADO POR</th>
                <th class="widthTable">OP</th>
            </tr>
            <tr>
                <td class="borderstable" style="width:10%">{{ $data['date'] }}</td>
                <td class="borderstable">{{ $item['provider']['name'] }}</td>
                <td class="borderstable">requested</td>
                <td class="borderstable">approved</td>
                <td class="borderstable" style="width:5%">{{ $item['ordertype'] }}</td>
            </tr>
            <tr>
                <th class="widthTable" colspan="5">DETALLE DE SOLICITUD DE ORDEN</th>
            </tr>
            <tr>
                <td class="borderstable" colspan="5" style="width:100%">{{ $item['details'] }}</td>
            </tr>
        </table> 
        <br>
    @endforeach
</body>
</html>