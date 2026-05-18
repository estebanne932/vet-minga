<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Consultas</h2>

            <a
                href="{{ route('consultas.create') }}"
                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700"
            >
                Nueva consulta
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Propietario</th>
                        <th class="px-4 py-3">Mascota</th>
                        <th class="px-4 py-3">Motivo</th>
                        <th class="px-4 py-3">Firma</th>
                        <th class="px-4 py-2">Estatus</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($consultas as $consulta)
                        <tr>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $consulta->propietario->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $consulta->mascota->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $consulta->motivo }}
                            </td>

                            <td class="px-4 py-3">
                                @if($consulta->firma)
                                    <span class="text-green-600 font-medium">✔</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>

                            <td class="px-4 py-2">
                                <form
                                    method="POST"
                                    action="{{ route('consultas.estatus', $consulta) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="estatus"
                                        onchange="this.form.submit()"
                                        class="text-xs font-semibold rounded-full px-3 py-1 border cursor-pointer
                                            {{ $colors[$consulta->estatus] ?? '' }}"
                                    >
                                        <option value="abierta" @selected($consulta->estatus === 'abierta')>
                                            Abierta
                                        </option>
                                        <option value="en_proceso" @selected($consulta->estatus === 'en_proceso')>
                                            En proceso
                                        </option>
                                        <option value="cerrada" @selected($consulta->estatus === 'cerrada')>
                                            Cerrada
                                        </option>
                                        <option value="cancelada" @selected($consulta->estatus === 'cancelada')>
                                            Cancelada
                                        </option>
                                    </select>
                                </form>

                            </td>


                            <td class="px-4 py-3 text-right space-x-2">
                                <a
                                    href="{{ route('consultas.show', $consulta) }}"
                                    class="text-teal-600 hover:underline"
                                >
                                    Ver
                                </a>
                                <a href="{{ route('consultas.edit', $consulta) }}"
                                class="text-blue-600 hover:underline">
                                    Editar
                                </a>

                                <form
                                    action="{{ route('consultas.destroy', $consulta) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta consulta? Esta acción no se puede deshacer.')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                No hay consultas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $consultas->links() }}
        </div>

    </div>
</x-app-layout>
