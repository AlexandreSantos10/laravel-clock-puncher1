<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <div class="py-12 bg-[#0b0e14] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <h1 class="text-3xl font-black text-white uppercase italic">Meu <span class="text-indigo-500">Histórico</span></h1>

            <form class="flex gap-4 bg-[#161b22] p-6 rounded-3xl border border-white/5">
                <select name="mes" class="bg-[#0b0e14] border-none rounded-xl text-gray-300 text-sm focus:ring-indigo-500">
                    <option value="">Todos os Meses</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>Mês {{ $m }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-indigo-600 px-6 py-2 rounded-xl text-white font-bold text-sm transition hover:bg-indigo-500">Filtrar</button>
            </form>

            <div class="bg-[#161b22] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
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
                <div class="p-6 bg-black/10">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>