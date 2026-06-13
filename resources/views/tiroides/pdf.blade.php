@php
    $primero = $perfil->first();
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Tiroideo</title>

    <style>
        @page {
            margin: 24px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
            line-height: 1.5;
        }

        .watermark {
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.06;
            z-index: -1;
            width: 380px;
        }

        .header {
            border-bottom: 2px solid #0f766e;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .clinic-info {
            text-align: right;
            font-size: 11px;
            color: #4b5563;
            line-height: 1.4;
        }

        .title {
            text-align: center;
            margin: 18px 0 20px;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.5px;
            color: #0f766e;
        }

        .subtitle {
            text-align: center;
            margin-top: -10px;
            margin-bottom: 18px;
            font-size: 11px;
            color: #6b7280;
        }

        .card {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 18px;
            background: #ffffff;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e7eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 6px 8px;
            vertical-align: top;
        }

        .info-label {
            color: #6b7280;
            font-weight: bold;
            width: 22%;
        }

        .results-table th {
            background: #0f766e;
            color: #ffffff;
            text-align: left;
            padding: 9px 8px;
            font-size: 11px;
            border: 1px solid #0f766e;
        }

        .results-table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .results-table tr:nth-child(even) td {
            background: #f9fafb;
        }

        .resultado {
            text-align: center;
            font-weight: bold;
        }

        .ok {
            color: #15803d;
        }

        .bad {
            color: #dc2626;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-ok {
            background: #dcfce7;
            color: #166534;
        }

        .badge-bad {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-neutral {
            background: #e5e7eb;
            color: #374151;
        }

        .footer {
            margin-top: 24px;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            font-size: 10px;
            color: #6b7280;
            line-height: 1.5;
        }

        .footer strong {
            color: #374151;
        }
    </style>
</head>
<body>

    <img
        src="{{ public_path('images/logo.png') }}"
        class="watermark"
        alt="Logo"
    >

    <div class="header">
        <table>
            <tr>
                <td width="18%">
                    <img
                        src="{{ public_path('images/logo.png') }}"
                        height="60"
                        alt="Logo"
                    >
                </td>

                <td width="82%" class="clinic-info">
                    <strong>Clínica Veterinaria MINGA</strong><br>
                    MVZ Valeria Mingura Gamboa<br>
                    CED. PROF. 12746833. UACJ
                </td>
            </tr>
        </table>
    </div>

    <div class="title">
        PERFIL TIROIDEO
    </div>

    <div class="subtitle">
        Resultados del paciente
    </div>

    <div class="card">

        <div class="section-title">
            Datos del paciente
        </div>

        <table class="info-table">

            <tr>
                <td class="info-label">Mascota:</td>
                <td>{{ $primero->paciente }}</td>

                <td class="info-label">Especie:</td>
                <td>{{ $primero->especie }}</td>
            </tr>

            <tr>
                <td class="info-label">Veterinario:</td>
                <td>{{ $primero->veterinario }}</td>

                <td class="info-label">Fecha:</td>
                <td>
                    {{ \Carbon\Carbon::parse($primero->fecha)->format('d/m/Y') }}
                </td>
            </tr>

        </table>

    </div>

    <div class="card">

        <div class="section-title">
            Resultados
        </div>

        <table class="results-table">

            <thead>
                <tr>
                    <th width="35%">Parámetro</th>
                    <th width="20%" style="text-align:center;">Resultado</th>
                    <th width="25%" style="text-align:center;">Referencia</th>
                    <th width="20%" style="text-align:center;">Estado</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($perfil as $item)

                    <tr>

                        <td>
                            {{ $item->parametro }}
                        </td>

                        <td class="resultado
                            @if($item->esta_en_rango === true)
                                ok
                            @elseif($item->esta_en_rango === false)
                                bad
                            @endif
                        ">
                            {{ $item->resultado }}
                        </td>

                        <td style="text-align:center;">
                            {{ $item->referencia }}
                        </td>

                        <td style="text-align:center;">

                            @if($item->esta_en_rango === true)

                                <span class="badge badge-ok">
                                    Dentro de rango
                                </span>

                            @elseif($item->esta_en_rango === false)

                                <span class="badge badge-bad">
                                    Fuera de rango
                                </span>

                            @else

                                <span class="badge badge-neutral">
                                    Sin validar
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="footer">

        <table>

            <tr>

                <td width="70%">
                    <strong>Dirección:</strong>
                    Av. José María Morelos y Pavón entre Centauro del Norte y Revolución Mexicana,
                    Emiliano Zapata, 31579 Cuauhtémoc, Chih.
                    <br>

                    <strong>Documento generado:</strong>
                    {{ now()->format('d/m/Y H:i') }}
                </td>

                <td width="30%" style="text-align:right;">
                    <strong>Tel.</strong>
                    625 229 8478
                </td>

            </tr>

        </table>

    </div>

</body>
</html>