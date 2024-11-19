<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $facturaData['factura_id'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .header h2 {
            margin: 10px 0;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 1rem;
            margin-top: 2rem;
            display: inline-block;
        }
        .factura-datos {
            display: inline-block;
            text-align: right;
            margin-left: 8rem; /* Aumento el espacio entre el logo y la información de la factura */
            vertical-align: top;
        }
        .factura-datos p {
            margin: 5px 0;
        }
        .unidad-info, .observaciones {
            /* margin-top: 5px; Reducción del margen entre el logo y la unidad */
        }
        .unidad-info p, .observaciones p {
            /* margin-top: 10px; */
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Título de la factura -->
        <div class="header">
            <h3>Conjunto Residencial: {{ $facturaData['empresa']->razon_social }}</h3>
        </div>

        <!-- Logo a la izquierda y datos de la factura a la derecha -->
        <div class="header">
            <div class="logo">
                @if(!empty($empresa->logo))
                    <img src="{{ public_path('images/' . basename($empresa->logo)) }}" alt="Logo de la empresa" class="h-16 w-auto" style="max-width: 150px;">
                @else
                    <p>No se encontró el logo de la empresa.</p>
                @endif
            </div>

            <div class="factura-datos">
                <p><strong>Factura:</strong> {{ $facturaData['factura_id'] }}</p>
                <p><strong>Fecha de emisión:</strong> {{ $facturaData['fecha_emision'] }}</p>
                <p><strong>Fecha de vencimiento:</strong> {{ $facturaData['fecha_vencimiento'] }}</p>
            </div>
        </div>

        <!-- Información de la unidad (incluye torre/bloque) -->
        <div class="unidad-info">
            <p><strong>Unidad:</strong> {{ $facturaData['detalle_cuotas'][0]['tipoUnidad'] }}  {{ $facturaData['detalle_cuotas'][0]['number'] }} - {{ $facturaData['detalle_cuotas'][0]['torreBloque'] ? 'Torre/Bloque ' . $facturaData['detalle_cuotas'][0]['torreBloque'] : '' }}</p>
            <p><strong>A nombre de:</strong> {{ $facturaData['detalle_cuotas'][0]['aNombreDe'] }}</p>
            <p><strong>Descripción:</strong> {{ $facturaData['detalle_cuotas'][0]['observacion'] }}</p>
        </div>

        <!-- Tabla de conceptos, valores y total -->
        <table class="table">
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Valor</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturaData['cuotas'] as $index => $cuota)
                    <tr>
                        <td>{{ $cuota->concepto->nombreConcepto ?? 'Sin concepto' }}</td>
                        <td>${{ number_format($cuota->vrlIndividual, 3) }}</td>
                        <td>${{ number_format($facturaData['total'], 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total en letras, cuenta bancaria y soporte -->
        <p><strong>Total en letras:</strong> {{ $facturaData['valor_en_letras'] }}</p>
        <p><strong>Consignar en:</strong> {{ $facturaData['cuenta_bancaria'] }}</p>
        <p><strong>Enviar soporte del pago al correo:</strong> {{ $facturaData['correo_pago'] }}</p>

        <!-- Mensaje de agradecimiento -->
        <div class="footer">
            <p>Gracias por su pago oportuno.</p>
        </div>
    </div>
</body>
</html>
