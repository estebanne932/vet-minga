<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Pacientes</h2>

            <a
                href="{{ route('pacientes.create') }}"
                class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700"
            >
                Nuevo paciente
            </a>
        </div>

        {{-- 👤 PROPIETARIOS --}}
        <div class="mt-10">
            <h3 class="text-lg font-bold mb-4">
                Propietarios
            </h3>

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Teléfono</th>
                            <th class="px-4 py-3">Correo</th>
                            <th class="px-4 py-3">Dirección</th>
                            <th class="px-4 py-3">Mascotas</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse ($propietarios as $propietario)
                            <tr>
                                <td class="px-4 py-3">{{ $propietario->nombre }}</td>
                                <td class="px-4 py-3">{{ $propietario->telefono }}</td>
                                <td class="px-4 py-3">{{ $propietario->correo }}</td>
                                <td class="px-4 py-3">{{ $propietario->direccion }}</td>
                                <td class="px-4 py-3">{{ $propietario->mascotas->count() }}</td>
                                <td class="px-4 py-3">
                                    <a
                                        href="{{ route('propietarios.edit', $propietario->id) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Editar
                                    </a>
                                    <form action="{{ route('propietarios.destroy', $propietario->id) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('¿Eliminar este propietario y todas sus mascotas?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                    <a href="{{ route('propietarios.mascotas.create', $propietario->id) }}">
                                        Agregar mascota
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    No hay propietarios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        {{-- 🐶 MASCOTAS / PACIENTES --}}
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-4 py-3">Mascota</th>
                        <th class="px-4 py-3">Especie</th>
                        <th class="px-4 py-3">Edad</th>
                        <th class="px-4 py-3">Propietario</th>
                        <th class="px-4 py-3">Teléfono</th>
                        <th class="px-4 py-3">Esterilizado</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($mascotas as $mascota)
                        <tr>
                            {{-- Mascota + imagen --}}
                            <td class="px-4 py-3 flex items-center gap-3">
                                @if($mascota->imagen)
                                    <img
                                        src="{{ asset('storage/' . $mascota->imagen) }}"
                                        class="w-10 h-10 rounded-full object-cover"
                                        alt="Foto de {{ $mascota->nombre }}"
                                    >
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                                @endif

                                <span class="font-medium">
                                    {{ $mascota->nombre }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                {{ $mascota->especie ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $mascota->edad ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $mascota->propietario->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $mascota->propietario->telefono ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                @if($mascota->esterilizado)
                                    <span class="text-green-600 font-medium">✔</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-right space-x-2">
                                <a
                                    href="{{ route('pacientes.show', $mascota) }}"
                                    class="text-teal-600 hover:underline"
                                >
                                    Ver
                                </a>

                                <a
                                    href="{{ route('mascotas.edit', $mascota) }}"
                                    class="text-blue-600 hover:underline"
                                >
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No hay pacientes registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $mascotas->links() }}
        </div>

    </div>
</x-app-layout>