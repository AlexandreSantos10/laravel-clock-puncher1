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

        // Filtros para os Logs
        $queryLogs = Log::with('user')->orderBy('data', 'desc');

        if ($request->filled('date_start')) {
            $queryLogs->whereDate('data', '>=', $request->date_start);
        }

        if ($request->filled('date_end')) {
            $queryLogs->whereDate('data', '<=', $request->date_end);
        }

        return view('admin.panel', [
            'users' => $queryUsers->get(),
            'logs' => $queryLogs->paginate(15)->withQueryString(),
        ]);
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
}