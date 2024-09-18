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
        :root{
            --blue: #0F547F;
            --gray: #526D82;
        }
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
        .bluecolor: {

        }
        .sect3 {
            background: --var(--blue);
            border-radius: 5px;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .p1{
            color: --var(--blue);
        }
        .producttable{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid;

        }
        .widthproduct{
            width: 10%;
            background: --var(--blue) !important;
            padding: 5px;
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
    @foreach ($data['quote'] as $item)
        <!--first section-->
        <table>
            <tr>
                <td style="width:25%">
                    <img src="{{ public_path('images/logo.jpg') }}" style="width:80%" />
                </td>
                <td style="width: 40%">
                    <div class="sect2">
                        <p class="p1" style="color: #0F547F">COLOR DIGITAL SA DE CV</p>
                        <p>Carretera a San Marcos #1810 San Salvador - El Salvador- Centroamérica Telefóno: (503) 2213-5501</p>
                    </div>
                </td>
                <td style="width:25%">
                    <div class="sect3">
                        Cotización {{ $item['id'] }}-24 <br>
                        Fecha: {{ $data['date'] }}
                    </div>
                </td>
            </tr>
        </table>
        <!--second section-->
        <table style="width: 100%">
            <tr>
                <td style="width:33%">
                    <div>
                        <p>Cliente: <span style="text-transform:uppercase">{{ $item['contact']['name']}} {{ $item['contact']['lastname']}} </span></p>
                        <p>Atención: <span style="text-transform:uppercase">{{ $item['user']['name']}}</span> </p>
                    </div>
                </td>
                <td style="width:33%">
                    <div>
                        <p>Teléfono: {{ $item['contact']['cellphone']}} </p>
                        <p>Correo: {{ $item['contact']['email']}} </p>    
                    </div>
                </td>
                <td style="width:33%">
                    <div>
                        <p>País: {{ $item['contact']['country']['name'] }}</p>
                        <p>Incoterm: {{ $item['incoterm'] }} </p>
                    </div>
                </td>
            </tr>
        </table>
        <!--products section-->
        <table class="producttable">
            <tr class="">
                <th class="widthproduct">PRODUCTO</th>
                <th style="border: 1px solid black">DESCRIPCIÓN</th>
                <th class="widthproduct">CANTIDAD</th>
                <th class="widthproduct">UNITARIO</th>
                    <th class="widthproduct">TOTAL</th>
            </tr>
            @foreach ($item->products as $pr)
            <tr>
                <td class="borderstable">
                    <img src="{{ url($pr['pivot']['image']) }}">
                    <p class="">{{ $pr['name'] }}</p>
                </td>
                <td class="borderstable">{{ $pr['pivot']['details'] }}</td>
                <td class="borderstable">{{ $pr['pivot']['quantity'] }}</td>
                <td class="borderstable">{{ $pr['pivot']['price'] }}</td>
                <td class="borderstable">${{ $pr['pivot']['total'] }}</td>
            </tr>
            @endforeach
        </table>           
        <br>
        <!--Products table-->
        <table style="width:100%" class="producttable">
            <tr style="width: 50%">
                <th class="widthproduct">AUTORIZADO</th>
                <th class="widthproduct">TOTALIZACIÓN DE COSTOS</th>
            </tr>
            <tr style=" padding:7px">
                <td style="padding:7px">
                    <div>Atención al Cliente:</div>
                    <div>Vendedor:</div>
                    <div style="margin-top: 35px; text-align:right;">Firma y nombre autorizado cliente</div>
                </td>
                <td style="border: 1px solid black; padding:7px">
                    <div style="text-align:right;">SUBTOTAL: ${{ $data['quotedetail']['total_products'] }}</div>
                    <div style="text-align:right;">IVA: {{ $data['quotedetail']['iva'] }}%</div>
                    <div style="margin-top: 35px; text-align:right;">TOTAL: ${{ $data['quotedetail']['total'] }}</div>
                </td>
            </tr>
        </table>
    @endforeach
</body>
</html>