<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background: #f4f4f4; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Logs — Todos os Utilizadores</h2>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Utilizador</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Total Horas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->data->format('d/m/Y') }}</td>
                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                    <td>{{ $log->entrada ? $log->entrada->format('H:i') : '--:--' }}</td>
                    <td>{{ $log->saida ? $log->saida->format('H:i') : '--:--' }}</td>
                    <td>{{ $log->total_horas ?? '0' }}h</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>