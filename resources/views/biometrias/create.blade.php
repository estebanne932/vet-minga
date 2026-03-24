<x-app-layout>
<div class="max-w-6xl mx-auto p-6">

    <h2 class="text-xl font-bold mb-4">Biometría Hemática</h2>

    <div class="bg-white rounded shadow p-6 mb-6 grid grid-cols-2 gap-4 text-sm">
        <p><strong>Paciente:</strong> {{ $consulta->mascota->nombre }}</p>
        <p><strong>Especie:</strong> {{ strtoupper($consulta->mascota->especie) }}</p>
        <p><strong>Médico:</strong> {{ $consulta->veterinario }}</p>
        <p><strong>Fecha:</strong> {{ now()->format('d/m/Y') }}</p>
    </div>

    <form method="POST" action="{{ route('biometrias.store', $consulta) }}">
        @csrf

        <table class="min-w-full bg-white rounded shadow text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Parámetro</th>
                    <th class="px-4 py-2 text-center">Resultado</th>
                    <th class="px-4 py-2 text-center">Perro</th>
                    <th class="px-4 py-2 text-center">Gato</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($parametros as $key => $p)
                    <tr>
                        <td class="px-4 py-2">{{ $p['label'] }}</td>

                        <td class="px-4 py-2 text-center">
                            <input
                                name="biometria[{{ $key }}]"
                                class="input text-center w-24"
                            >
                        </td>

                        <td class="px-4 py-2 text-center text-gray-600">
                            {{ $p['perro'] }}
                        </td>

                        <td class="px-4 py-2 text-center text-gray-600">
                            {{ $p['gato'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <button class="bg-teal-600 text-white px-6 py-2 rounded">
                Guardar biometría
            </button>
        </div>
    </form>
</div>
</x-app-layout>
