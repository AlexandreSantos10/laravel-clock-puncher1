<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histórico Geral') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" action="{{ route('system.logs') }}" class="mb-6 flex flex-wrap gap-4 items-end bg-gray-50 p-4 rounded-lg">
                    <div class="w-full md:w-auto">
                        <label class="block text-sm font-medium text-gray-700">Colaborador</label>
                        <select name="user_id" class="w-full md:w-48 border-gray-300 rounded-md shadow-sm">
                            <option value="">Todos</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <label class="block text-sm font-medium text-gray-700">De</label>
                        <input type="date" name="date_start" value="{{ request('date_start') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="w-full md:w-auto">
                        <label class="block text-sm font-medium text-gray-700">Até</label>
                        <input type="date" name="date_end" value="{{ request('date_end') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar</button>
                        <a href="{{ route('system.logs') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50">Limpar</a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entrada</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fim Almoço</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saída</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($logs as $log)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $log->data->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $log->user->name }}</td>
                                <td class="px-4 py-3 text-green-600">{{ $log->entrada->format('H:i') }}</td>
                                <td class="px-4 py-3 text-yellow-600">{{ $log->final_almoco ? $log->final_almoco->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-3 text-red-600">{{ $log->saida ? $log->saida->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-3 font-bold">{{ $log->total_horas }}h</td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Sem dados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $logs->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>