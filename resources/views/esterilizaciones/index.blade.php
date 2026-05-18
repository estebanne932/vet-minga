<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Cartas de Consentimiento</h2>

           <a href="{{ route('esterilizaciones.create') }}">
                Nueva carta
            </a>

        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Propietario</th>
                        <th class="px-4 py-3">Mascota</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3">Veterinario</th>
                        <th class="px-4 py-3">PDF</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($esterilizaciones as $esterilizacion)
                        <tr>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($esterilizacion->fecha)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $esterilizacion->propietario->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $esterilizacion->mascota->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $esterilizacion->tipo }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $esterilizacion->veterinario }}
                            </td>

                            <td class="px-4 py-3">
                                @if($esterilizacion->archivo_pdf)
                                    <a
                                        href=""
                                        class="text-green-600 hover:underline"
                                    >
                                        Ver PDF
                                    </a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-right space-x-2">

                                <a
                                    href="{{ route('esterilizaciones.show', $esterilizacion) }}"
                                    class="text-teal-600 hover:underline"
                                >
                                    Ver
                                </a>

                                <form action="{{ route('esterilizaciones.destroy', $esterilizacion->id) }}" method="POST" onsubmit="return confirm('¿Eliminar registro?')">
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
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No hay cartas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $esterilizaciones->links() }}
        </div>

    </div>
</x-app-layout>
