<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
   
    public function users(Request $request)
    {
        $query = User::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        $users = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('management.users', compact('users'));
    }

    
    public function logs(Request $request)
    {
        $query = Log::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('date_start')) {
            $query->whereDate('data', '>=', $request->date_start);
        }
        if ($request->filled('date_end')) {
            $query->whereDate('data', '<=', $request->date_end);
        }

        $logs = $query->latest('data')->latest('entrada')->paginate(15)->withQueryString();
        $users = User::orderBy('name')->get();

        return view('management.logs', compact('logs', 'users'));
    }
}