<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $facturaData['factura_id'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header, .footer { text-align: center; }
        .container { width: 80%; margin: auto; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Factura {{ $facturaData['factura_id'] }}</h2>
            <p>Fecha de emisión: {{ $facturaData['fecha_emision'] }}</p>
            <p>Fecha de vencimiento: {{ $facturaData['fecha_vencimiento'] }}</p>
        </div>

        <h3>Conjunto Residencial: {{ $facturaData['empresa']->razon_social }}</h3>

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
                        <td>{{ $cuota->concepto->nombreConcepto }}</td>
                        <td>${{ number_format($cuota->vrlIndividual, 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td>${{ number_format($facturaData['total'], 3) }}</td>
                </tr>
            </tfoot>
        </table>

        <p><strong>Total en letras:</strong> {{ $facturaData['valor_en_letras'] }}</p>
        <p><strong>Cuenta bancaria:</strong> {{ $facturaData['cuenta_bancaria'] }}</p>
        <p><strong>Correo para pagos:</strong> {{ $facturaData['correo_pago'] }}</p>

        <div class="footer">
            <p>Gracias por su pago oportuno.</p>
        </div>
    </div>
</body>
</html>
