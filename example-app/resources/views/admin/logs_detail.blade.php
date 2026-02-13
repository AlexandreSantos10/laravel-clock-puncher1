
<script src="https://cdn.tailwindcss.com"></script><x-app-layout>
    <div class="py-12 bg-[#0b0e14] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#161b22] rounded-[3rem] border border-white/5 p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-600/10 blur-3xl"></div>
                
                <div class="flex items-center gap-6 mb-12">
                    <div class="w-20 h-20 bg-indigo-500/20 rounded-3xl flex items-center justify-center text-3xl font-black text-indigo-500 border border-indigo-500/20">
                        {{ substr($log->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">{{ $log->user->name }}</h2>
                        <p class="text-indigo-400 font-bold tracking-widest text-xs uppercase">Detalhe de Auditoria</p>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="bg-black/20 p-6 rounded-2xl">
                            <p class="text-[10px] font-black text-gray-500 uppercase mb-2">Data do Registo</p>
                            <p class="text-xl text-white font-bold">{{ $log->data->format('d . M . Y') }}</p>
                        </div>
                        <div class="bg-black/20 p-6 rounded-2xl">
                            <p class="text-[10px] font-black text-gray-500 uppercase mb-2">Total de Horas</p>
                            <p class="text-xl text-indigo-400 font-bold italic">{{ $log->total_horas ?? 'Calculando...' }}h</p>
                        </div>
                    </div>

                    <div class="border-y border-white/5 py-8 grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-black text-green-500 uppercase mb-1">Check-In</p>
                            <p class="text-4xl text-white font-mono font-black">{{ $log->entrada->format('H:i') }}</p>
                            <p class="text-[10px] text-gray-600 mt-1 font-mono italic">IP: 192.168.1.1 (Exemplo)</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-rose-500 uppercase mb-1">Check-Out</p>
                            <p class="text-4xl text-white font-mono font-black">{{ $log->saida ? $log->saida->format('H:i') : 'Pendente' }}</p>
                        </div>
                    </div>

                    <div class="bg-black/20 p-6 rounded-3xl">
                        <p class="text-[10px] font-black text-gray-500 uppercase mb-3">Observações do Colaborador</p>
                        <p class="text-gray-300 italic text-sm leading-relaxed">
                            {{ $log->obs ?? 'Nenhuma observação registada para este turno.' }}
                        </p>
                    </div>
                </div>

                <div class="mt-12 flex justify-between items-center">
                    <a href="{{ route('admin.statistics') }}" class="text-xs font-black text-gray-500 hover:text-white transition uppercase tracking-widest">← Voltar aos Logs</a>
                    <span class="px-4 py-2 bg-indigo-600/10 text-indigo-400 text-[10px] font-black rounded-full border border-indigo-500/20 uppercase tracking-tighter">Validado pelo Sistema</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>