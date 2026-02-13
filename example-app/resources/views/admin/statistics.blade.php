
<script src="https://cdn.tailwindcss.com"></script><x-app-layout>
    <div x-data="{ openModal: false, activeLog: {} }" class="py-12 bg-[#0b0e14] min-h-screen text-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <div class="flex justify-between items-end border-b border-white/5 pb-8">
                <div>
                   <h1 class="text-3xl font-black text-white uppercase italic">Estatistica <span class="text-indigo-500 text-5xl">& Logs</span></h1>

                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#161b22] p-8 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 opacity-10 text-8xl group-hover:scale-110 transition duration-500">🔥</div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Dia Mais Ativo</p>
                    <p class="text-3xl font-black text-white uppercase italic">
                        {{ $diaMaisAtivo ? \Carbon\Carbon::parse($diaMaisAtivo->dia)->format('d . M') : 'N/A' }}
                    </p>
                    <p class="text-xs text-purple-400 mt-1 font-bold">{{ $diaMaisAtivo->total ?? 0 }} Registos</p>
                </div>

                <div class="bg-[#161b22] p-8 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 opacity-10 text-8xl group-hover:scale-110 transition duration-500">📊</div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Média Diária</p>
                    <p class="text-4xl font-black text-indigo-500 italic">{{ number_format($mediaRegistos, 1) }}</p>
                    <p class="text-[10px] text-gray-500 mt-1 font-bold uppercase tracking-widest">Registos / Dia</p>
                </div>

                <div class="bg-[#161b22] p-8 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 opacity-10 text-8xl group-hover:scale-110 transition duration-500">♾️</div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total Histórico</p>
                    <p class="text-4xl font-black text-white italic">{{ $totalLogsSempre }}</p>
                    <p class="text-[10px] text-gray-500 mt-1 font-bold uppercase tracking-widest">Entradas totais</p>
                </div>
            </div>

            <div class="bg-[#161b22]/50 backdrop-blur-xl p-2 rounded-[2.5rem] border border-white/5 shadow-2xl">
                <form action="{{ route('admin.statistics') }}" method="GET" class="flex flex-wrap md:flex-nowrap items-center gap-2">
      
                    <div class="flex-1 min-w-[150px] relative">
                        <span class="absolute left-4 top-3 text-[9px] font-black text-purple-500 uppercase tracking-tighter">Período Mensal</span>
                        <select name="mes" class="w-full pt-7 pb-3 px-4 bg-[#0b0e14] border-none rounded-[1.5rem] text-sm text-white focus:ring-2 focus:ring-purple-500/50 transition appearance-none">
                            <option value="">Todos os Meses</option>
                            @foreach(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'] as $index => $mesNome)
                                <option value="{{ $index + 1 }}" {{ request('mes') == ($index + 1) ? 'selected' : '' }}>{{ $mesNome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1 min-w-[150px] relative">
                        <span class="absolute left-4 top-3 text-[9px] font-black text-purple-500 uppercase tracking-tighter">Colaborador</span>
                        <select name="user_id" class="w-full pt-7 pb-3 px-4 bg-[#0b0e14] border-none rounded-[1.5rem] text-sm text-white focus:ring-2 focus:ring-purple-500/50 transition appearance-none">
                            <option value="">Equipa Completa</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="h-[68px] px-8 bg-gradient-to-br from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black rounded-[1.5rem] transition-all shadow-lg shadow-purple-500/20 uppercase text-xs tracking-[0.2em]">
                        Aplicar
                    </button>
                    
                    @if(request()->anyFilled(['dia', 'mes', 'user_id']))
                        <a href="{{ route('admin.statistics') }}" class="h-[68px] px-6 bg-white/5 hover:bg-white/10 text-gray-400 flex items-center justify-center rounded-[1.5rem] transition border border-white/5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3"/></svg>
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-[#161b22] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
                <div class="p-8 border-b border-white/5 bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-sm font-black text-white uppercase tracking-[0.3em] italic">Intensidade de Atividade</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 p-6 gap-4">
                    @foreach($logsPorDia->take(6) as $l)
                    <div class="bg-[#0b0e14] p-5 rounded-3xl border border-white/5">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-bold text-gray-400">{{ \Carbon\Carbon::parse($l->dia)->format('d . M . Y') }}</span>
                            <span class="text-[10px] font-black uppercase {{ $l->total >= ($mediaRegistos + 2) ? 'text-green-500' : 'text-gray-600' }}">
                                {{ $l->total }} REGISTOS
                            </span>
                        </div>
                        <div class="h-1.5 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full" style="width: {{ ($l->total / ($diaMaisAtivo->total ?? 1)) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-[#161b22] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] bg-black/40">
                                <th class="px-10 py-6">Identidade</th>
                                <th class="px-10 py-6">Data</th>
                                <th class="px-10 py-6">Duração</th>
                                <th class="px-10 py-6 text-right">Mais Detalhes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($todosOsLogs as $log)
                            <tr class="hover:bg-white/[0.03] transition-all group">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-500 font-black text-xs border border-purple-500/20">
                                            {{ substr($log->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-white font-bold">{{ $log->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-sm font-mono text-gray-400 italic">
                                    {{ \Carbon\Carbon::parse($log->data)->format('d/m/Y') }}
                                </td>
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <span class="text-green-500 font-black text-xs">{{ $log->entrada }}</span>
                                        <span class="text-gray-700">|</span>
                                        <span class="text-rose-500 font-black text-xs">{{ $log->saida ?? 'ATIVO' }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <button @click="openModal = true; activeLog = {
                                        name: '{{ $log->user->name }}',
                                        data: '{{ \Carbon\Carbon::parse($log->data)->format('d/m/Y') }}',
                                        entrada: '{{ $log->entrada }}',
                                        saida: '{{ $log->saida ?? 'Pendente' }}',
                                        total: '{{ $log->total_horas ?? '0' }}',
                                        obs: '{{ $log->obs ?? 'Nenhuma observação registada.' }}'
                                    }" class="bg-white/5 hover:bg-purple-600 text-gray-400 hover:text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase transition-all tracking-widest border border-white/5">
                                        Explorar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $todosOsLogs->links() }}
            </div>

        </div>

        <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
            <div x-show="openModal" x-transition.opacity @click="openModal = false" class="absolute inset-0 bg-black/90 backdrop-blur-md"></div>
            
            <div x-show="openModal" x-transition.scale.90 class="relative bg-[#161b22] border border-white/10 w-full max-w-lg rounded-[3rem] shadow-2xl overflow-hidden">
                <div class="p-10">
                    <div class="flex justify-between items-start mb-10">
                        <div>
                            <h2 class="text-3xl font-black text-white italic tracking-tighter" x-text="activeLog.name"></h2>
                            <p class="text-purple-500 font-black text-[10px] uppercase tracking-widest mt-1" x-text="'AUDITORIA: ' + activeLog.data"></p>
                        </div>
                        <button @click="openModal = false" class="text-gray-500 hover:text-white transition-colors text-3xl font-light">&times;</button>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#0b0e14] p-6 rounded-3xl border border-white/5 shadow-inner">
                            <p class="text-[9px] font-black text-gray-500 uppercase mb-2">Entrada</p>
                            <p class="text-3xl font-mono text-green-500 font-black" x-text="activeLog.entrada"></p>
                        </div>
                        <div class="bg-[#0b0e14] p-6 rounded-3xl border border-white/5 shadow-inner">
                            <p class="text-[9px] font-black text-gray-500 uppercase mb-2">Saida</p>
                            <p class="text-3xl font-mono text-rose-500 font-black" x-text="activeLog.saida"></p>
                        </div>
                    </div>

                    <div class="bg-white/[0.02] border border-white/5 p-8 rounded-3xl mb-8">
                        <p class="text-[9px] font-black text-purple-500 uppercase mb-3 tracking-widest">Observações do Turno</p>
                        <p class="text-gray-400 italic text-sm leading-relaxed font-medium" x-text="activeLog.obs"></p>
                    </div>

                    <div class="flex items-center justify-between px-2">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-[10px] font-black text-gray-500 uppercase">Status: Verificado</span>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-gray-500 uppercase">Carga Horária</p>
                            <p class="text-2xl font-black text-white italic" x-text="activeLog.total + 'h'"></p>
                        </div>
                    </div>

                    <button @click="openModal = false" class="w-full mt-10 py-5 bg-white/5 hover:bg-white/10 text-white font-black rounded-[1.5rem] transition uppercase text-[10px] tracking-[0.3em] border border-white/5">
                        Fechar Protocolo
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>