<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <div class="py-12 bg-[#0b0e14] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <h1 class="text-3xl font-black text-white uppercase italic">Meu <span class="text-indigo-500">Histórico</span></h1>

            <form method="GET" action="{{ route('user.logs') }}" class="flex flex-wrap items-center gap-4 bg-[#161b22] p-6 rounded-3xl border border-white/5">
                <div class="w-full sm:w-auto">
                    <label class="text-xs text-gray-400 mb-1 block">Mês</label>
                    <select name="mes" class="w-full bg-[#0b0e14] border-none rounded-xl text-gray-300 text-sm p-2">
                        <option value="">Todos os Meses</option>
                        @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $i => $nome)
                            <option value="{{ $i+1 }}" {{ request('mes') == $i+1 ? 'selected' : '' }}>{{ $nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full sm:w-auto">
                    <label class="text-xs text-gray-400 mb-1 block">Ano</label>
                    <select name="ano" class="w-full bg-[#0b0e14] border-none rounded-xl text-gray-300 text-sm p-2">
                        <option value="">Todos os Anos</option>
                        @php $currentYear = now()->year; @endphp
                        @for($y = $currentYear; $y >= $currentYear - 5; $y--)
                            <option value="{{ $y }}" {{ request('ano') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="flex gap-3 ms-auto items-center">
                    <button type="submit" class="bg-indigo-600 px-4 py-2 rounded-xl text-white font-bold text-sm transition hover:bg-indigo-500">Filtrar</button>
                    <a href="{{ route('user.logs') }}" class="bg-indigo-600 px-4 py-2 rounded-xl text-white font-bold text-sm transition hover:bg-indigo-500">Limpar</a>
                    <a href="{{ route('user.logs.export', array_merge(request()->all(), ['format' => 'txt'])) }}" class="bg-indigo-600 px-4 py-2 rounded-xl text-white font-bold text-sm transition hover:bg-indigo-500">TXT</a>
                    <a href="{{ route('user.logs.export', array_merge(request()->all(), ['format' => 'pdf'])) }}" class="bg-indigo-600 px-4 py-2 rounded-xl text-white font-bold text-sm transition hover:bg-indigo-500">PDF</a>
                </div>
            </form>

            <div class="bg-[#161b22] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
                <!-- Desktop table -->
                <div class="hidden sm:block">
                    <table class="w-full text-left">
                        <thead class="bg-black/20 text-[10px] font-black text-gray-500 uppercase tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Data</th>
                                <th class="px-8 py-5">Entrada</th>
                                <th class="px-8 py-5">Saída</th>
                                <th class="px-8 py-5 text-right">Total Horas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($logs as $log)
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="px-8 py-6 text-white font-bold">{{ $log->data->format('d/m/Y') }}</td>
                                <td class="px-8 py-6 text-green-400 font-mono">{{ $log->entrada->format('H:i') }}</td>
                                <td class="px-8 py-6 text-rose-400 font-mono">{{ $log->saida ? $log->saida->format('H:i') : '--:--' }}</td>
                                <td class="px-8 py-6 text-right text-gray-400 font-black">{{ $log->total_horas ?? '0' }}h</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile cards -->
                <div class="sm:hidden space-y-4 p-4">
                    @foreach($logs as $log)
                        <div class="bg-[#0b0e14] border border-white/5 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-400">{{ $log->data->format('d/m/Y') }}</div>
                                    <div class="text-lg font-bold text-white">Total: {{ $log->total_horas ?? '0' }}h</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-green-400 font-mono">{{ $log->entrada->format('H:i') }}</div>
                                    <div class="text-rose-400 font-mono">{{ $log->saida ? $log->saida->format('H:i') : '--:--' }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 bg-black/10">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>