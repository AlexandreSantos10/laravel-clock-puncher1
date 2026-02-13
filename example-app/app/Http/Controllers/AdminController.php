<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Exibe o Painel Administrativo com listagens e filtros
     */
    public function index(Request $request)
    {
        // Filtros para a lista de utilizadores
        $queryUsers = User::query();

        if ($request->filled('search')) {
            $queryUsers->where('name', 'like', '%' . $request->search . '%')
                       ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Query principal de logs (para a tabela detalhada)
        $queryLogs = Log::with('user')->orderBy('data', 'desc')->orderBy('entrada', 'desc');

        // Aplicar filtros enviados (mês/ano/user)
        if ($request->filled('mes')) {
            $queryLogs->whereMonth('data', $request->mes);
        }
        if ($request->filled('ano')) {
            $queryLogs->whereYear('data', $request->ano);
        }
        if ($request->filled('user_id')) {
            $queryLogs->where('user_id', $request->user_id);
        }

        // Estatísticas gerais (independentes dos filtros da tabela)
        $logsPorDia = Log::select(DB::raw('DATE(data) as dia'), DB::raw('count(*) as total'))
            ->groupBy('dia')
            ->orderBy('dia', 'desc')
            ->take(30)
            ->get();

        $diaMaisAtivo = Log::select(DB::raw('DATE(data) as dia'), DB::raw('count(*) as total'))
            ->groupBy('dia')
            ->orderBy('total', 'desc')
            ->first();

        $totalLogsSempre = Log::count();
        $totalDiasComLogs = Log::distinct('data')->count() ?: 1;
        $mediaRegistos = $totalLogsSempre / $totalDiasComLogs;

        // Paginado da tabela detalhada (com filtros aplicados)
        $todosOsLogs = $queryLogs->paginate(20)->withQueryString();

        // Lista de utilizadores para filtros e tabela de utilizadores
        $users = $queryUsers->get();

        return view('admin.panel', compact(
            'users', 'logsPorDia', 'diaMaisAtivo', 'mediaRegistos', 'totalLogsSempre', 'todosOsLogs'
        ));
    }

    /**
     * Alterna o tipo de utilizador entre 'admin' e 'user'
     */
    public function toggleRole(User $user)
    {
        // Segurança: Não permitir que o admin logado altere o seu próprio cargo
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Não podes alterar o teu próprio nível de acesso.');
        }

        $user->tipo = ($user->tipo === 'admin') ? 'user' : 'admin';
        $user->save();

        return back()->with('success', "Cargo de {$user->name} alterado para " . strtoupper($user->tipo));
    }

    /**
     * Método auxiliar para as estatísticas da Dashboard
     * Podes chamar isto no DashboardController
     */
    public static function getDashboardStats()
    {
        return [
            'ativos' => User::where('state', 'active')->count(),
            'inativos' => User::where('state', 'inactive')->count(),
            'registos_hoje' => Log::whereDate('data', Carbon::today())->count(),
        ];
    }
    public function showLog(Log $log)
{
    $log->load('user'); // Garante que trazemos os dados do funcionário
    return view('admin.logs_detail', compact('log'));
}
    
public function statistics(Request $request)
{
    // 1. Logs por dia (Query que faltava para o gráfico/tabela de intensidade)
    $logsPorDia = Log::select(DB::raw('DATE(data) as dia'), DB::raw('count(*) as total'))
        ->groupBy('dia')
        ->orderBy('dia', 'desc')
        ->take(30)
        ->get();

    // 2. Dia mais logado de sempre (Para o card de métrica)
    $diaMaisAtivo = Log::select(DB::raw('DATE(data) as dia'), DB::raw('count(*) as total'))
        ->groupBy('dia')
        ->orderBy('total', 'desc')
        ->first();

    // 3. Métricas Gerais
    $totalLogsSempre = Log::count();
    
    // Média de registos (evitar divisão por zero se não houver logs)
    $totalDiasComLogs = Log::distinct('data')->count() ?: 1;
    $mediaRegistos = $totalLogsSempre / $totalDiasComLogs;

    // 4. Query para a Tabela Detalhada com Filtros
    $query = Log::with('user')->orderBy('data', 'desc')->orderBy('entrada', 'desc');

    if ($request->filled('dia')) {
        $query->whereDate('data', $request->dia);
    }
    if ($request->filled('mes')) {
        $query->whereMonth('data', $request->mes);
    }
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    $todosOsLogs = $query->paginate(20);
    $users = User::all(); // Para preencher o select de filtros
    
    // Agora todas as variáveis existem!
    return view('admin.statistics', compact(
        'logsPorDia', 
        'diaMaisAtivo', 
        'mediaRegistos', 
        'totalLogsSempre', 
        'todosOsLogs', 
        'users'
    ));
}

    public function exportLogs(Request $request)
    {
        $query = Log::with('user')->orderBy('data', 'desc');

        if ($request->filled('mes')) {
            $query->whereMonth('data', $request->mes);
        }
        if ($request->filled('ano')) {
            $query->whereYear('data', $request->ano);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logs = $query->get();
        $format = $request->get('format', 'txt');

        if ($format === 'txt') {
            $lines = [];
            foreach ($logs as $log) {
                $date = $log->data->format('d/m/Y');
                $user = $log->user->name ?? 'Unknown';
                $entrada = $log->entrada ? $log->entrada->format('H:i') : '--:--';
                $saida = $log->saida ? $log->saida->format('H:i') : '--:--';
                $total = $log->total_horas ?? '0';
                $lines[] = "$date | $user | Entrada: $entrada | Saída: $saida | Total: {$total}h";
            }
            $content = implode("\n", $lines);
            $filename = 'todos-logs-'.now()->format('Y-m-d_His').'.txt';

            return response($content, 200, [
                'Content-Type' => 'text/plain; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            ]);
        }

        if ($format === 'pdf') {
            if (class_exists('\\Barryvdh\\DomPDF\\Facade\\Pdf')) {
                $filename = 'todos-logs-'.now()->format('Y-m-d_His').'.pdf';
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.logs_pdf', compact('logs'));
                return $pdf->download($filename);
            }

            return back()->with('error', 'Biblioteca de geração de PDF não está instalada. Executa: composer require barryvdh/laravel-dompdf');
        }

        return back()->with('error', 'Formato de exportação não suportado.');
    }
}