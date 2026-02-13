<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <div class="py-12 bg-[#0b0e14] min-h-screen text-gray-300 font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="relative p-8 rounded-[2rem] bg-gradient-to-br from-[#1a1f2e] to-[#111625] border border-white/5 overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-600/10 rounded-full blur-[80px]"></div>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic">
                            Boas Vindas<span class="text-indigo-500">.</span>
                        </h1>
                        <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-xs">Bem-vindo, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="mt-4 md:mt-0 px-6 py-3 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 text-center">
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Estado da Equipa</p>
                        <div class="flex gap-4 mt-1">
                            <span class="text-green-400 font-bold">{{ $stats['ativos'] }} <span class="text-gray-600 text-[10px]">On</span></span>
                         </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-5 group relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                    <div class="relative bg-[#161b2c] rounded-[2.5rem] p-10 h-full border border-white/5">
                        <h2 class="text-2xl font-bold text-white mb-8">Ponto Digital</h2>
                        
                        <form action="{{ route('ponto.registar') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            @if(!$registoHoje)
                                <div class="space-y-4">
                                    <div class="relative">
                                        <textarea name="obs" rows="3" 
                                            class="w-full bg-[#0b0e14] border-none rounded-3xl text-gray-300 focus:ring-2 focus:ring-indigo-500/50 p-5 placeholder-gray-600 shadow-inner"
                                            placeholder="Notas de entrada..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full py-6 bg-indigo-600 hover:bg-indigo-500 text-white rounded-3xl font-black tracking-widest transition-all shadow-xl shadow-indigo-500/20 active:scale-95">
                                        INICIAR DIA
                                    </button>
                                </div>
                            @elseif(!$registoHoje->saida)
                                <div class="p-8 bg-[#0b0e14] rounded-3xl border border-indigo-500/20 text-center mb-6">
                                    <p class="text-xs uppercase text-gray-500 font-black mb-2">Trabalhando desde</p>
                                    <p class="text-5xl font-black text-white font-mono tracking-tighter">{{ $registoHoje->entrada->format('H:i') }}</p>
                                </div>
                                <textarea name="obs" rows="2" 
                                    class="w-full bg-[#0b0e14] border-none rounded-3xl text-gray-300 focus:ring-2 focus:ring-rose-500/50 p-5 placeholder-gray-600 mb-4 shadow-inner"
                                    placeholder="Notas de saída..."></textarea>
                                <button type="submit" class="w-full py-6 bg-rose-600 hover:bg-rose-500 text-white rounded-3xl font-black tracking-widest transition-all shadow-xl shadow-rose-500/20 active:scale-95">
                                    CONCLUIR DIA
                                </button>
                            @else
                                <div class="bg-indigo-600/5 border border-indigo-500/10 p-12 rounded-[2rem] text-center border-dashed">
                                    <div class="w-16 h-16 bg-indigo-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <p class="text-white font-bold text-xl tracking-tight">Trabalho Concluído</p>
                                    <p class="text-gray-500 text-sm mt-1 uppercase tracking-tighter">Até amanhã, bom descanso!</p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-8">
                    @if(!Auth::user()->inicio_almoco)
                    <div class="bg-[#161b2c] p-8 rounded-[2.5rem] border border-white/5 relative overflow-hidden group">
                        <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                            <div class="bg-indigo-500/10 p-4 rounded-2xl">🍱</div>
                            <div class="flex-1">
                                <h3 class="text-white font-bold">Configuração de Almoço</h3>
                                <p class="text-sm text-gray-500">Defina o seu horário padrão para gerar registos automáticos.</p>
                            </div>
                            <form action="{{ route('user.almoco') }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="time" name="inicio_almoco" class="bg-[#0b0e14] border-none rounded-2xl text-white px-4">
                                <button class="bg-indigo-600 hover:bg-indigo-500 p-4 rounded-2xl text-white">✓</button>
                            </form>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-[#161b2c] p-8 rounded-[2.5rem] border border-white/5">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Total de Utilizadores</p>
                            <p class="text-3xl font-black text-white italic">{{ $stats['ativos'] + $stats['inativos'] }}</p>
                        </div>
                        <div class="bg-[#161b2c] p-8 rounded-[2.5rem] border border-white/5">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Inativos</p>
                            <p class="text-3xl font-black text-rose-500 italic">{{ $stats['inativos'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-600 p-10 rounded-[2.5rem] shadow-2xl shadow-indigo-600/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-20">
                            <svg class="w-32 h-32" fill="white" viewBox="0 0 24 24"><path d="M13 3l-2 3H3v15h18V3h-8zm5 15h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V8h2v2z"/></svg>
                        </div>
                        <h4 class="text-white font-black text-2xl uppercase italic tracking-tighter">Foco & Performance</h4>
                        <p class="text-indigo-100 mt-2 text-sm leading-relaxed max-w-sm">Use o painel lateral para ver o seu histórico completo ou editar as suas informações de perfil.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>