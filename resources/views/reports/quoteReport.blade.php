<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lorem</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        :root{
            --blue: #0F547F;
            --gray: #526D82;
        }
        body{
            color: #161A30;
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
    </style>
</head>
<body>
    <!--second--> 
        @foreach ($data['quotedetail'] as $item)
            <table>
                <tr>
                    <td style="width:30%">
                        <img src="{{ public_path('images/logo.jpg') }}"width="175" />
                    </td>
                    <td style="">
                        <div class="sect2">
                            <p class="p1">COLOR DIGITAL SA DE CV</p>
                            <p>Carretera a San Marcos #1810 San Salvador - El Salvador- Centroamérica Telefóno: (503) 2213-5501</p>
                        </div>
                    </td>
                    <td style="width:30%">
                        <div class="sect3">
                            Cotización {{ $item['quote_id'] }}-24 <br>
                            Fecha: {{ $data['date'] }}
                        </div>
                    </td>
                </tr>
            </table>
            <!--second-->
        @foreach ($data['quote'] as $contact)
            <table style="width: 100%">
                <tr>
                    <td style="width:33%">
                        <div>
                            <p>Cliente: <span style="text-transform:uppercase">{{ $contact['contact']['name']}} {{ $contact['contact']['lastname']}} </span></p>
                            <p>Atención: <span style="text-transform:uppercase">{{ $contact['user']['name']}}</span> </p>
                        </div>
                    </td>
                    <td style="width:33%">
                        <div>
                            <p>Teléfono: {{ $contact['contact']['cellphone']}} </p>
                            <p>Correo: {{ $contact['contact']['email']}} </p>    
                        </div>
                    </td>
                    <td style="width:33%">
                        <div>
                            <p>País: {{ $contact['contact']['country']['name'] }}</p>
                            <p>Incoterm: {{ $item['quote']['incoterm'] }} </p>
                        </div>
                    </td>
                </tr>
            </table>
            <!--Products table-->
            <table class="producttable">
                <tr class="">
                    <th class="widthproduct">PRODUCTO</th>
                    <th style="border: 1px solid black">DESCRIPCIÓN</th>
                    <th class="widthproduct">CANTIDAD</th>
                    <th class="widthproduct">UNITARIO</th>
                        <th class="widthproduct">TOTAL</th>
                </tr>
                @foreach ($contact->products as $pr)
                <tr>
                    <td style="border: 1px solid black; padding:7px">{{ $pr['name'] }}</td>
                    <td style="border: 1px solid black; padding:7px">{{ $pr['pivot']['details'] }}</td>
                    <td style="border: 1px solid black; padding:7px">{{ $pr['pivot']['quantity'] }}</td>
                    <td style="border: 1px solid black; padding:7px">{{ $pr['pivot']['price'] }}</td>
                    <td style="border: 1px solid black; padding:7px">${{ $pr['pivot']['total'] }}</td>
                </tr>
                @endforeach
            </table>

            <br>
            <!--Products table-->
            <table class="producttable">
                <tr class="">
                    <th>AUTORIZADO</th>
                    <th>TOTALIZACIÓN DE COSTOS</th>
                </tr>
                <tr>
                    <td  style="border: 1px solid black">
                        <p>Atención al Cliente:</p>
                        <p>Vendedor:</p>
                        <p style="float:right">Firma y nombre autorizado cliente</p>
                    </td>
                    <td style="border: 1px solid black">
                        <div style="float:right">
                            <p style="text-align:right">SUBTOTAL: ${{ $item['total_products'] }}</p>
                            <p style="text-align:right">IVA: {{ $item['iva'] }}%</p>
                            <p style="text-align:right">TOTAL: ${{ $item['total'] }}</p>
                        </div>
                    </td>
                </tr>
            </table>
            @endforeach
        @endforeach

    <!--second
    <div class="secondContainer">
        <div>
            <p>Cliente:</p>
            <p>Atención:</p>
        </div>
        <div>
            <p>Teléfono:</p>
            <p>Email:</p>
        </div>
        <div>
            <p>País:</p>
            <p>Incoterm:</p>
        </div>
    </div>--> 
</body>
</html>