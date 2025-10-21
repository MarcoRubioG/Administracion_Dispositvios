<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta Poder - Asignación de Dispositivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #7f8c8d;
            margin: 5px 0;
        }
        .content {
            margin: 30px 0;
        }
        .section {
            margin: 25px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
        }
        .section h3 {
            color: #2c3e50;
            margin-top: 0;
            font-size: 18px;
        }
        .info-row {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        .label {
            font-weight: bold;
            color: #34495e;
            width: 40%;
        }
        .value {
            color: #2c3e50;
            width: 60%;
        }
        .qr-section {
            text-align: center;
            margin: 40px 0;
            padding: 20px;
            background-color: #ecf0f1;
            border-radius: 8px;
        }
        .qr-section img {
            margin: 20px auto;
            border: 3px solid #2c3e50;
            padding: 10px;
            background-color: white;
        }
        .signature-section {
            margin-top: 80px;
            display: flex;
            justify-content: space-around;
        }
        .signature {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            border-top: 2px solid #333;
            margin-top: 60px;
            padding-top: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #bdc3c7;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CARTA PODER</h1>
        <p>Asignación de Dispositivo Móvil</p>
        <p><strong>Folio: #{{ str_pad($assignment->id, 6, '0', STR_PAD_LEFT) }}</strong></p>
    </div>

    <div class="content">
        <div class="section">
            <h3>Información del Usuario</h3>
            <div class="info-row">
                <span class="label">Nombre Completo:</span>
                <span class="value">{{ $assignment->user->name }}</span>
            </div>
            <div class="info-row">
                <span class="label">Correo Electrónico:</span>
                <span class="value">{{ $assignment->user->email }}</span>
            </div>
        </div>

        <div class="section">
            <h3>Información del Dispositivo</h3>
            <div class="info-row">
                <span class="label">Tipo:</span>
                <span class="value">{{ ucfirst($assignment->device->tipo) }}</span>
            </div>
            <div class="info-row">
                <span class="label">Marca y Modelo:</span>
                <span class="value">{{ $assignment->device->marca }} {{ $assignment->device->modelo }}</span>
            </div>
            <div class="info-row">
                <span class="label">Número de Serie:</span>
                <span class="value">{{ $assignment->device->numero_serie }}</span>
            </div>
            @if($assignment->device->imei)
            <div class="info-row">
                <span class="label">IMEI:</span>
                <span class="value">{{ $assignment->device->imei }}</span>
            </div>
            @endif
        </div>

        <div class="section">
            <h3>Detalles de la Asignación</h3>
            <div class="info-row">
                <span class="label">Fecha de Asignación:</span>
                <span class="value">{{ $assignment->fecha_asignacion->format('d/m/Y') }}</span>
            </div>
            @if($assignment->observaciones)
            <div class="info-row">
                <span class="label">Observaciones:</span>
                <span class="value">{{ $assignment->observaciones }}</span>
            </div>
            @endif
        </div>

        <div class="qr-section">
            <h3>Código de Verificación</h3>
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="Código QR">
            <p style="margin: 10px 0; color: #7f8c8d; font-size: 14px;">
                Escanee este código para verificar la autenticidad de este documento
            </p>
        </div>

        <p style="text-align: justify; margin: 30px 0; font-size: 14px;">
            Por medio de la presente, se hace constar que el dispositivo descrito ha sido asignado 
            al usuario mencionado para el desempeño de sus actividades laborales. El usuario se 
            compromete a hacer buen uso del equipo y a reportar cualquier daño o pérdida de manera inmediata.
        </p>

        <div class="signature-section">
            <div class="signature">
                <div class="signature-line">
                    <strong>{{ $assignment->user->name }}</strong><br>
                    Usuario Responsable
                </div>
            </div>
            <div class="signature">
                <div class="signature-line">
                    <strong>Administrador</strong><br>
                    Departamento de TI
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Este documento fue generado electrónicamente el {{ now()->format('d/m/Y H:i') }}</p>
        <p>Sistema de Gestión de Dispositivos - {{ config('app.name') }}</p>
    </div>
</body>
</html>