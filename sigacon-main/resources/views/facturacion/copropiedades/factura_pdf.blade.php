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
            margin: 0;
        }
        .header h2 {
            margin: 10px 0;
        }
        .header h3 {
            margin: 5px 0;
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
            margin-left: 8rem;
            vertical-align: top;
        }
        .factura-datos p {
            margin: 5px 0;
        }
        .unidad-info p {
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
            margin-top: 3rem;
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
            <h3>Nit: {{ $facturaData['empresa']->numero_identificacion }}</h3>
            <h3>Dirección Física: {{ $facturaData['empresa']->physical_address }}</h3>
        </div>

        <!-- Logo e información de la factura -->
        <div class="header">
            <div class="logo">
                @if(!empty($facturaData['logo']))
                    <img src="{{ public_path('images/' . basename($facturaData['logo'])) }}" alt="Logo de la empresa" style="max-width: 150px;">
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

        <!-- Información de la unidad -->
        <div class="unidad-info">
            <p><strong>Unidad:</strong> {{ $facturaData['detalle_cuotas'][0]['tipoUnidad'] }} {{ $facturaData['detalle_cuotas'][0]['number'] }} - {{ $facturaData['detalle_cuotas'][0]['torreBloque'] ? 'Torre/Bloque ' . $facturaData['detalle_cuotas'][0]['torreBloque'] : '' }}</p>
            <p><strong>A nombre de:</strong> {{ $facturaData['detalle_cuotas'][0]['aNombreDe'] }}</p>
            @if(count($facturaData['cuotas']) === 1)
                <p><strong>Descripción:</strong> {{ $facturaData['detalle_cuotas'][0]['observacion'] }}</p>
            @endif
        </div>

        <!-- Tabla de conceptos y valores -->
        <table class="table">
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturaData['cuotas'] as $cuota)
                    <tr>
                        <td>{{ $cuota->concepto->nombreConcepto ?? 'Sin concepto' }}</td>
                        <td>${{ number_format($cuota->vrlIndividual, 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>${{ number_format($facturaData['total'], 3) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <!-- Tabla para descuento pronto pago -->
        @if($facturaData['dias_pronto_pago'] && $facturaData['porcentaje_descuento'])
            <table class="table" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Descuento Pronto Pago</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Descuento pronto pago ({{ $facturaData['dias_pronto_pago'] }} días, {{ $facturaData['porcentaje_descuento'] }}%)</td>
                        <td>-${{ number_format($facturaData['descuento'], 3) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total a pagar</strong></td>
                        <td><strong>${{ number_format($facturaData['total_con_descuento'], 3) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @endif


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
