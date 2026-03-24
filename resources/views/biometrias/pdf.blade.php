@php
    $esFelino = in_array(
        strtolower($biometrias->first()->especie),
        ['felino', 'gato', 'felina']
    );
@endphp


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biometría Hemática</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .watermark {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.08;
            z-index: -1;
            width: 400px;
        }

        .header {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .clinic-info {
            text-align: right;
            font-size: 11px;
            color: #4b5563;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            text-align: left;
            padding: 8px;
            font-size: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            font-size: 10px;
            color: #6b7280;
        }


        .resultado {
            text-align: center;
            font-weight: bold;
        }

        .ok {
            color: #16a34a; /* verde */
        }

        .bad {
            color: #dc2626; /* rojo */
        }

    </style>
</head>
<body>

    {{-- MARCA DE AGUA --}}
    <img
        src="{{ public_path('images/logo.png') }}"
        class="watermark"
    >

    {{-- HEADER --}}
    <div class="header">
        <table>
            <tr>
                <td width="20%">
                    <img src="{{ public_path('images/logo.png') }}" height="60">
                </td>

                <td width="80%" class="clinic-info">
                    <strong>Clínica Veterinaria MINGA</strong><br>
                    MVZ Valeria Mingura Gamboa<br>
                    CED. PROF. 12746833. UACJ<br>
                   
                </td>
            </tr>
        </table>
    </div>

    {{-- TÍTULO --}}
    <div class="title">
        BIOMETRÍA HEMÁTICA
    </div>

    {{-- DATOS DEL PACIENTE --}}
    <div class="card">
        <table>
            <tr>
                <td><strong>Mascota:</strong> {{ $biometrias->first()->paciente }}</td>
                <td><strong>Especie:</strong> {{ $biometrias->first()->especie }}</td>
            </tr>
            <tr>
                <td><strong>Veterinario:</strong> {{ $biometrias->first()->veterinario }}</td>
                <td>
                    <strong>Fecha:</strong>
                    {{ \Carbon\Carbon::parse($biometrias->first()->fecha)->format('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- RESULTADOS --}}
    <div class="card table-wrapper">
        <table class="results-table">

        <thead>
            <tr>
                <th>Parámetro</th>
                <th style="text-align:center;">Resultado</th>
                <th style="text-align:center;">Referencia</th>
            </tr>
        </thead>


        <tbody>
@foreach ($biometrias as $item)
    @php
        $referencia = $esFelino
            ? $item->referencia_gato
            : $item->referencia_perro;
    @endphp

    <tr>
        <td>{{ $item->parametro }}</td>

        <td class="resultado
            @if($item->esta_en_rango === true) ok
            @elseif($item->esta_en_rango === false) bad
            @endif
        ">
            {{ $item->resultado }}
        </td>

        <td style="text-align:center;">
            {{ $referencia }}
        </td>
    </tr>
@endforeach
</tbody>

      </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <table>
            <tr>
                <td>
                    Clínica Veterinaria MINGA · Cuauhtémoc, Chihuahua<br>
                    Av. José María Morelos y Pavón entre Centauro del Norte y Revolución Mexicana<br>
                    Emiliano Zapata, 31579 Cuauhtémoc, Chih.<br>
                    Tel. 625 229 8478
                    Documento generado el {{ now()->format('d/m/Y H:i') }}
                </td>

                <td style="text-align:right;">
                    Tel. 625 229 8478
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
