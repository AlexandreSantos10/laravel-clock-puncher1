<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
    <div class="py-12 bg-[#0b0e14] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="flex justify-between items-end">
                <h1 class="text-3xl font-black text-white uppercase italic">Gerir <span class="text-indigo-500 text-5xl">Equipa</span></h1>
                <p class="text-gray-500 font-bold text-xs border-b-2 border-indigo-500 pb-1 uppercase tracking-widest">Gestão de Equipa</p>
            </div>

            <div class="bg-[#161b2c] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-[#111625] border-b border-white/5">
                                <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Colaborador</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Nível</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Ação</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($users as $user)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-8 py-6">
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
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $user->tipo === 'admin' ? 'bg-indigo-600 text-white' : 'bg-[#0b0e14] text-gray-400 border border-white/5' }}">
                                        {{ $user->tipo }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
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
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full {{ $user->state === 'active' ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]' : 'bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.6)]' }}"></div>
                                        <span class="text-[10px] font-black uppercase text-gray-500">{{ $user->state }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>