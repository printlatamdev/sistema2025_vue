<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lorem</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .firstContainer {
            display: flex;
            justify-content: center;
        }
        .coticont {
            background: blue;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="firstContainer">
        @foreach ($data['quotedetail'] as $item)
            {{ $item }}
        @endforeach
        <div>
            IMAGE
        </div>
        <div>
            <h2>COLOR DIGITAL SA DE CV</h2>
            <p>Carretera a San Marcos #1810 San Salvador - El Salvador- Centroamérica Telefóno: (503) 2213-5501</p>
        </div>
        <div class="coticont">
            Cotización {{ $item['quote_id'] }}-24
            Fecha: Lorem
        </div>
    </div>

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
    </div>
    <div class="thirdContainer">
        Tabla
    </div>
</body>
</html>