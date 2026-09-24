<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de {{ $usuario->name }} - Respira y Sigue</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 850px;
            margin: 0 auto;
            padding: 30px 20px;
            color: #12354A;
        }

        .encabezado{
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom: 3px solid #89CFF0;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .encabezado h1{
            margin:0;
            font-size: 22px;
        }

        .encabezado p{
            margin:2px 0 0;
            color: #666;
        }

        .btn-imprimir{
            background:#2E9BE6;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
        }

        section{
            margin-bottom: 30px;
        }

        section h2{
            font-size: 17px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 6px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:10px;
        }

        th, td{
            text-align:left;
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        th{
            background:#EAF6FF;
        }

        .resumen{
            display:flex;
            gap:15px;
            flex-wrap:wrap;
        }

        .resumen-card{
            background:#F5FAFF;
            border-radius:12px;
            padding:15px 20px;
            flex:1;
            min-width:140px;
            text-align:center;
        }

        .resumen-card h3{
            margin:0;
            color:#2E9BE6;
            font-size:26px;
        }

        .resumen-card p{
            margin:4px 0 0;
            font-size:13px;
        }

        .vacio{
            color:#888;
            font-style: italic;
        }

        @media print{
            .btn-imprimir{
                display:none;
            }
            body{
                padding:0;
            }
        }
    </style>
</head>
<body>

    <div class="encabezado">
        <div>
            <h1>Reporte de bienestar emocional</h1>
            <p>{{ $usuario->name }} — {{ $usuario->email }}</p>
            <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
        </div>
        <button class="btn-imprimir" onclick="window.print()">🖨️ Descargar / Imprimir PDF</button>
    </div>

    <section>
        <h2>Resumen general</h2>
        <div class="resumen">
            <div class="resumen-card">
                <h3>{{ $tests->count() }}</h3>
                <p>Tests emocionales realizados</p>
            </div>
            <div class="resumen-card">
                <h3>{{ $ejerciciosCompletados->count() }}</h3>
                <p>Ejercicios completados</p>
            </div>
            <div class="resumen-card">
                <h3>{{ $recordatoriosActivos->count() }}</h3>
                <p>Recordatorios activos</p>
            </div>
        </div>
    </section>

    <section>
        <h2>Historial de tests emocionales</h2>
        @if ($tests->isEmpty())
            <p class="vacio">Todavía no has realizado ningún test.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nivel de estrés</th>
                        <th>Nivel de ansiedad</th>
                        <th>Recomendación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $test)
                        <tr>
                            <td>{{ $test->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $test->nivel_estres }} ({{ $test->puntaje_estres }}/20)</td>
                            <td>{{ $test->nivel_ansiedad }} ({{ $test->puntaje_ansiedad }}/20)</td>
                            <td>{{ $test->categoria_recomendada }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>

    <section>
        <h2>Ejercicios completados</h2>
        @if ($ejerciciosCompletados->isEmpty())
            <p class="vacio">Todavía no has completado ningún ejercicio.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Ejercicio</th>
                        <th>Categoría</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ejerciciosCompletados as $registro)
                        <tr>
                            <td>{{ $registro->ejercicio->titulo ?? 'Ejercicio eliminado' }}</td>
                            <td>{{ $registro->ejercicio->categoria ?? '—' }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($registro->completado_en)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>

    <section>
        <h2>Recordatorios activos</h2>
        @if ($recordatoriosActivos->isEmpty())
            <p class="vacio">No tienes recordatorios activos.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Recordatorio</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recordatoriosActivos as $recordatorio)
                        <tr>
                            <td>{{ $recordatorio->icono }} {{ $recordatorio->titulo }}</td>
                            <td>{{ $recordatorio->hora->format('h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>

    <section>
        <h2>Últimos estados de ánimo registrados</h2>
        @if ($estadosAnimo->isEmpty())
            <p class="vacio">Todavía no has registrado tu estado de ánimo.</p>
        @else
            @php
                $etiquetas = [1 => '😔 Muy mal', 2 => '😕 Mal', 3 => '😐 Regular', 4 => '🙂 Bien', 5 => '😁 Muy bien'];
            @endphp
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Estado de ánimo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estadosAnimo as $estado)
                        <tr>
                            <td>{{ $estado->fecha->format('d/m/Y') }}</td>
                            <td>{{ $etiquetas[$estado->valor] ?? $estado->valor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>

</body>
</html>