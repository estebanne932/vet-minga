<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="fixed bottom-6 right-6 z-50">
            <a
                href="{{ route('cirugias.create') }}"
                class="w-16 h-16 flex items-center justify-center rounded-full bg-cyan-600 text-white shadow-xl hover:bg-cyan-700 hover:scale-110 transition-all duration-200"
                title="Nueva carta"
            >
                <i class="bi bi-plus-lg text-2xl"></i>
            </a>
        </div>

        <div class="mt-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Cirugias
                    </h3>
                    <p class="text-sm text-gray-500">
                        Registro de procedimientos y documentos PDF
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                            <tr class="text-left">
                                <th class="px-6 py-4 font-semibold">Fecha</th>
                                <th class="px-6 py-4 font-semibold">Propietario</th>
                                <th class="px-6 py-4 font-semibold">Mascota</th>
                                <th class="px-6 py-4 font-semibold">Tipo</th>
                                <th class="px-6 py-4 font-semibold">Veterinario</th>
                                <th class="px-6 py-4 font-semibold text-center">PDF</th>
                                <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($cirugias as $cirugia)
                                <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ \Carbon\Carbon::parse($cirugia->fecha)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $cirugia->propietario->nombre ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $cirugia->mascota->nombre ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                                            {{ $cirugia->tipo }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $cirugia->veterinario }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($cirugia->archivo_pdf)
                                            <a
                                                href="{{ asset('storage/' . $cirugia->archivo_pdf) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-red-100 text-red-700 font-semibold text-xs shadow-sm transition-all duration-200 hover:bg-red-600 hover:text-white hover:scale-105"
                                                title="Ver PDF"
                                            >
                                                <i class="bi bi-file-earmark-pdf-fill text-sm"></i>
                                                PDF
                                            </a>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">
                                                Sin archivo
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('cirugias.show', $cirugia) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-teal-100 text-teal-600 shadow-sm transition-all duration-200 hover:bg-teal-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-400"
                                                title="Ver cirugia"
                                            >
                                                <i class="bi bi-eye-fill text-base"></i>
                                            </a>

                                            <form
                                                action="{{ route('cirugias.destroy', $cirugia->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Eliminar registro?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow-sm transition-all duration-200 hover:bg-red-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-400"
                                                    title="Eliminar esterilización"
                                                >
                                                    <i class="bi bi-trash-fill text-base"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center gap-2 text-gray-500">
                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class="bi bi-scissors text-2xl text-gray-400"></i>
                                            </div>
                                            <p class="font-medium">No hay cartas registradas</p>
                                            <p class="text-sm">Agrega el primer registro de cirugia para comenzar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $cirugias->links() }}
        </div>

    </div>
</x-app-layout>
