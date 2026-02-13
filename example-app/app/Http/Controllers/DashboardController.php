<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $hoje = \Carbon\Carbon::today();
    
    $registoHoje = \App\Models\Log::where('user_id', $user->id)
                                 ->whereDate('data', $hoje)
                                 ->first();

    // Obtém as stats do AdminController
    $stats = \App\Http\Controllers\AdminController::getDashboardStats();

    return view('dashboard', compact('user', 'registoHoje', 'stats'));
}

    // Ação para Entrar/Sair
    // DashboardController.php

public function registrarPonto(Request $request)
{
    $user = Auth::user();
    $hoje = \Carbon\Carbon::today();
    $agora = \Carbon\Carbon::now();

    $log = Log::where('user_id', $user->id)->where('data', $hoje)->first();

    if (!$log) {
        // ENTRADA
        Log::create([
            'user_id' => $user->id,
            'data' => $hoje,
            'entrada' => $agora,
            'obs' => $request->obs // Grava a observação inicial
        ]);
        return back();
    } elseif (!$log->saida) {
        // SAÍDA
        // Definimos o final_almoco automaticamente se existir um início padrão
        $finalAlmoco = $user->inicio_almoco ? \Carbon\Carbon::parse($user->inicio_almoco)->addHour() : null;

        $log->update([
            'saida' => $agora,
            'final_almoco' => $log->final_almoco ?? $finalAlmoco,
            'obs' => $log->obs . " | Saída: " . $request->obs // Concatena obs de saída
        ]);
        return back();
    }


        return back()->with('error', 'Ponto já fechado para hoje.');
    }

    // Atualizar hora de almoço
    public function updateAlmoco(Request $request)
    {
        $request->validate(['inicio_almoco' => 'required']);
        
        $user = Auth::user();
        // Nota: O seu campo na tabela users é DATETIME, mas para "hora de almoço" idealmente seria TIME.
        // Vou salvar como uma data fictícia com a hora escolhida ou converter conforme sua lógica.
        // Abaixo assumo que quer salvar apenas a hora preferida (formatando para o datetime de hoje ou null).
        
        $user->inicio_almoco = Carbon::parse($request->inicio_almoco);
        $user->save();

        return back()->with('success', 'Hora de almoço atualizada.');
    }
    public function meusLogs(Request $request)
{
    $query = \App\Models\Log::where('user_id', auth()->id())->orderBy('data', 'desc');

    if ($request->filled('mes')) {
        $query->whereMonth('data', $request->mes);
    }
    if ($request->filled('ano')) {
        $query->whereYear('data', $request->ano);
    }

    $logs = $query->paginate(10);
    return view('user.logs', compact('logs'));
}
}