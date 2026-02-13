<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <div class="py-6 bg-[#0b0e14] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            
            

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                <!-- Users list -->
                <div class="lg:col-span-7 bg-[#161b2c] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
                    <div class="p-4 border-b border-white/5">
                        <h2 class="text-lg font-black text-white">Gestão de Utilizadores</h2>
                    </div>

                    <!-- Estatísticas (moved to left column) -->
                    <div class="hidden sm:grid sm:grid-cols-3 md:grid-cols-3 gap-2 p-2">
                        <div class="bg-[#161b22] p-4 rounded-[1.2rem] border border-white/5">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Dia Mais Ativo</p>
                            <p class="text-2xl font-black text-white uppercase italic">{{ $diaMaisAtivo ? \Carbon\Carbon::parse($diaMaisAtivo->dia)->format('d . M') : 'N/A' }}</p>
                            <p class="text-xs text-purple-400 mt-1 font-bold">{{ $diaMaisAtivo->total ?? 0 }} Registos</p>
                        </div>

                        <div class="bg-[#161b22] p-4 rounded-[1.2rem] border border-white/5">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Média Diária</p>
                            <p class="text-2xl font-black text-indigo-500 italic">{{ number_format($mediaRegistos, 1) }}</p>
                            <p class="text-[10px] text-gray-500 mt-1 font-bold uppercase tracking-widest">Registos / Dia</p>
                        </div>

                        <div class="bg-[#161b22] p-4 rounded-[1.2rem] border border-white/5">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total Histórico</p>
                            <p class="text-2xl font-black text-white italic">{{ $totalLogsSempre }}</p>
                            <p class="text-[10px] text-gray-500 mt-1 font-bold uppercase tracking-widest">Entradas totais</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-[#111625] border-b border-white/5">
                                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Colaborador</th>
                                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Nível</th>
                                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($users as $user)
                                <tr class="hover:bg-white/[0.02] transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center font-black text-indigo-500 border border-indigo-500/20">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-white font-bold">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-600 font-mono">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $user->tipo === 'admin' ? 'bg-indigo-600 text-white' : 'bg-[#0b0e14] text-gray-400 border border-white/5' }}">
                                            {{ $user->tipo }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                            @csrf
                                            <button class="bg-[#0b0e14] hover:bg-white/5 text-xs text-indigo-400 font-black py-3 px-6 rounded-2xl border border-white/5 transition active:scale-95">
                                                ALTERAR PARA {{ $user->tipo === 'admin' ? 'USER' : 'ADMIN' }}
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-[10px] text-gray-700 font-black uppercase tracking-tighter italic">Você (Admin Principal)</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Logs & Filters -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-[#161b22]/50 p-4 rounded-[1.2rem] border border-white/5">
                        <form action="{{ route('admin.panel') }}" method="GET" class="flex flex-wrap gap-3 items-center">
                            <div class="w-full sm:w-1/3">
                                <label class="block text-xs text-white mb-1">Mês</label>
                                <select name="mes" class="w-full bg-[#0b0e14] rounded-xl p-2 text-sm text-white">
                                    <option value="">Todos os Meses</option>
                                    @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $i => $nome)
                                        <option value="{{ $i+1 }}" {{ request('mes') == $i+1 ? 'selected' : '' }}>{{ $nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full sm:w-1/3">
                                <label class="block text-xs text-white mb-1">Ano</label>
                                <select name="ano" class="w-full bg-[#0b0e14] rounded-xl p-2 text-sm text-white">
                                    <option value="">Todos os Anos</option>
                                    @php $currentYear = now()->year; @endphp
                                    @for($y = $currentYear; $y >= $currentYear - 5; $y--)
                                        <option value="{{ $y }}" {{ request('ano') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="w-full sm:w-1/3">
                                <label class="block text-xs text-white mb-1">Utilizador</label>
                                <select name="user_id" class="w-full bg-[#0b0e14] rounded-xl p-2 text-sm text-white">
                                    <option value="">Todos os Utilizadores</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full sm:w-1/3 flex gap-2 items-end">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 transition-transform px-4 py-2 rounded-xl text-white font-bold">Aplicar</button>
                                <a href="{{ route('admin.panel') }}" class="bg-indigo-600 hover:bg-indigo-700 active:scale-95 transition-transform px-4 py-2 rounded-xl text-white font-bold">Limpar</a>
                                <a href="{{ route('admin.logs.export', array_merge(request()->all(), ['format' => 'txt'])) }}" class="bg-white/5 hover:bg-white/10 transition px-4 py-2 rounded-xl text-gray-300">TXT</a>
                                <a href="{{ route('admin.logs.export', array_merge(request()->all(), ['format' => 'pdf'])) }}" class="bg-white/5 hover:bg-white/10 transition px-4 py-2 rounded-xl text-gray-300">PDF</a>
                            </div>
                        </form>
                    </div>

                    <div class="bg-[#161b22] rounded-[2rem] border border-white/5 overflow-hidden">
                        <div class="hidden sm:block overflow-x-auto">
                            <table class="w-full text-left table-fixed">
                                <thead class="bg-black/20 text-[10px] font-black text-gray-500 uppercase tracking-widest">
                                    <tr>
                                        <th class="px-4 py-3 w-[35%]">Utilizador</th>
                                        <th class="px-4 py-3 w-[20%]">Data</th>
                                        <th class="px-4 py-3 w-[15%]">Entrada</th>
                                        <th class="px-4 py-3 w-[15%]">Saída</th>
                                        <th class="px-4 py-3 w-[15%] text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($todosOsLogs as $log)
                                    <tr class="hover:bg-white/[0.02] transition">
                                        <td class="px-4 py-3 text-white font-bold">{{ $log->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm font-mono text-gray-400">{{ \Carbon\Carbon::parse($log->data)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-green-400 font-mono">{{ $log->entrada }}</td>
                                        <td class="px-4 py-3 text-rose-400 font-mono">{{ $log->saida ?? 'ATIVO' }}</td>
                                        <td class="px-4 py-3 text-right text-white font-bold">{{ $log->total_horas ?? '0' }}h</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="sm:hidden space-y-4 p-4">
                            @foreach($todosOsLogs as $log)
                                <div class="bg-[#0b0e14] border border-white/5 rounded-xl p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($log->data)->format('d/m/Y') }}</div>
                                            <div class="text-base font-bold text-white">{{ $log->user->name ?? 'N/A' }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-green-400 font-mono">{{ $log->entrada }}</div>
                                            <div class="text-rose-400 font-mono">{{ $log->saida ?? '--:--' }}</div>
                                            <div class="text-xs text-white font-bold mt-1">{{ $log->total_horas ?? '0' }}h</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-6 bg-black/10">
                            {{ $todosOsLogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>