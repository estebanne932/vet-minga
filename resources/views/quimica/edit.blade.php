<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">
                Editar Quimica
            </h2>

            <a
                href="{{ route('consultas.show', $consulta->id) }}"
                class="text-sm text-gray-600 hover:underline"
            >
                ← Volver a consulta
            </a>
        </div>

        <form
            action="{{ route('quimica.update', $consulta->id) }}"
            method="POST"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            {{-- Datos del paciente --}}
            <div class="bg-white rounded shadow p-5">
                <h3 class="font-semibold mb-3">Datos del paciente</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <p><strong>Mascota:</strong> {{ $consulta->mascota->nombre }}</p>
                    <p><strong>Especie:</strong> {{ $consulta->mascota->especie }}</p>
                    <p><strong>Veterinario:</strong> {{ $consulta->veterinario }}</p>
                    <p><strong>Fecha:</strong> {{ now()->format('d/m/Y') }}</p>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-2 text-left">Parámetro</th>
                            <th class="px-4 py-2 text-left">Resultado</th>
                            <th class="px-4 py-2 text-left">Referencia Perro</th>
                            <th class="px-4 py-2 text-left">Referencia Gato</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($parametros as $key => $item)

                            @php
                                $valor = $quimica->firstWhere('parametro', $item['label']);
                            @endphp

                            <tr>
                                <td class="px-4 py-2 font-semibold">
                                    {{ $item['label'] }}
                                </td>

                                <td class="px-4 py-2">
                                    <input
                                        type="text"
                                        name="quimica[{{ $key }}][resultado]"
                                        value="{{ $valor->resultado ?? '' }}"
                                        class="w-full border rounded px-2 py-1 text-sm"
                                    >
                                </td>

                                <td class="px-4 py-2">
                                    {{ $item['perro'] }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $item['gato'] }}
                                </td>

                                {{-- Hidden --}}
                                <input type="hidden"
                                    name="quimica[{{ $key }}][parametro]"
                                    value="{{ $item['label'] }}">

                                <input type="hidden"
                                    name="quimica[{{ $key }}][referencia_perro]"
                                    value="{{ $item['perro'] }}">

                                <input type="hidden"
                                    name="quimica[{{ $key }}][referencia_gato]"
                                    value="{{ $item['gato'] }}">
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3">
                <a
                    href="{{ route('consultas.show', $consulta->id) }}"
                    class="px-4 py-2 border rounded text-sm"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm"
                >
                    Guardar cambios
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
