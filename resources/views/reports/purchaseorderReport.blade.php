<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reporte de Orden de compra - Color Digital</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        ul li{
            list-style: none;
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
                <td style="width:50%; text-align:right; font-weight: bold;">ORDEN No. {{ $item['id'] }}</td>
            </tr>
        </table>
        <!--second section-->
        <table class="maintable">
            <tr>
                <th class="widthTable" style="width:10%">FECHA</th>
                <th class="widthTable" style="width:20%">PROVEEDOR</th>
                <th class="widthTable" style="width:30%">SOLICITADO POR</th>
                <th class="widthTable" style="width:30%">AUTORIZADO POR</th>
                <th class="widthTable" style="width:10%">OP</th>
            </tr>
            <tr>
                <td class="borderstable">{{ $data['date'] }}</td>
                <td class="borderstable">{{ $item['provider']['name'] }}</td>
                <td class="borderstable">requested</td>
                <td class="borderstable">approved</td>
                <td class="borderstable">{{ $item['ordertype'] }}</td>
            </tr>
            <tr>
                <th class="widthTable" colspan="5">DETALLE DE SOLICITUD DE ORDEN</th>
            </tr>
            <tr>
                <td class="borderstable" colspan="5" style="width:100%">{{ $item['details'] }}</td>
            </tr>
        </table> 
        <br>

        
        <!--second section-->
        <table class="maintable">
            <tr>
                <th class="widthTable" style="width:70%">ESPECIFICACIONES DE MATERIAL</th>
                <th class="widthTable" style="width:10%">CANTIDAD</th>
                <th class="widthTable" style="width:10%">P. UNIT</th>
                <th class="widthTable" style="width:10%">C. TOTAL</th>
            </tr>
            @foreach($item['materials'] as $mat)
            <tr>
                <td class="borderstable">{{ $mat['name'] }}</td>
                <td class="borderstable">{{ $mat['pivot']['quantity'] }}</td>
                <td class="borderstable">${{ $mat['pivot']['price'] }}</td>
                <td class="borderstable">${{ $mat['pivot']['subtotal'] }}</td>
            </tr>
            @endforeach
            <tr>
                <td class="borderstable" colspan="2">
                    <p style="margin-top: 1px; margin-bottom: 0"><span style="font-weight: bold">Nota:</span> La orden de compra solo es válida con firma y sello.</p>
                    <p style="margin-top: 0"><span style="font-weight: bold">Forma de pago:</span> {{ $item['provider']['payment_condition'] }} </p>
                </td>
                <td class="borderstable" colspan="2">
                    <div>
                        <div style="display:flex !important; justify-content:space-between">
                            <span style="font-weight: bold">Subtotal:</span>
                            <span>${{ number_format($data['purchaseorderDetail']['total_materials'], 2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between">
                            <span style="font-weight: bold">IVA:</span>
                            <span>${{ number_format($data['purchaseorderDetail']['iva'], 2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between">
                            <span style="font-weight: bold">Total:</span>
                            <span>${{ number_format($data['purchaseorderDetail']['total'], 2) }}</span>
                        </div>
                    </div>
                </td>
            </tr>
        </table> 
        <br>
    @endforeach
</body>
</html>