<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="fixed bottom-6 right-6 z-50">
            <a
                href="{{ route('pacientes.create') }}"
                class="w-16 h-16 flex items-center justify-center rounded-full bg-teal-600 text-white shadow-xl hover:bg-teal-700 hover:scale-110 transition-all duration-200"
                title="Nuevo paciente"
            >
                <i class="bi bi-plus-lg text-2xl"></i>
            </a>
        </div>

       {{-- 👤 PROPIETARIOS --}}
        <div class="mt-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Propietarios
                    </h3>
                    <p class="text-sm text-gray-500">
                        Registro de clientes y sus mascotas
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
                            <tr class="text-left">
                                <th class="px-6 py-4 font-semibold">Nombre</th>
                                <th class="px-6 py-4 font-semibold">Teléfono</th>
                                <th class="px-6 py-4 font-semibold">Correo</th>
                                <th class="px-6 py-4 font-semibold">Dirección</th>
                                <th class="px-6 py-4 font-semibold text-center">Mascotas</th>
                                <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($propietarios as $propietario)
                                <tr class="hover:bg-emerald-50/60 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                        {{ $propietario->nombre }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $propietario->telefono }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 break-all">
                                        {{ $propietario->correo }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $propietario->direccion }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center min-w-8 px-3 py-1 rounded-full bg-amber-100 text-amber-700 font-semibold text-xs">
                                            {{ $propietario->mascotas->count() }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('propietarios.edit', $propietario->id) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 shadow-sm transition-all duration-200 hover:bg-blue-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                title="Editar propietario"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </a>

                                            <form
                                                action="{{ route('propietarios.destroy', $propietario->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Eliminar este propietario y todas sus mascotas?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow-sm transition-all duration-200 hover:bg-red-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-400"
                                                    title="Eliminar propietario"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                                    </svg>
                                                </button>
                                            </form>

                                            <a
                                                href="{{ route('propietarios.mascotas.create', $propietario->id) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 shadow-sm transition-all duration-200 hover:bg-emerald-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                                                title="Agregar mascota"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M11 13a5 5 0 1 0-4.975-5.5H4A1.5 1.5 0 0 0 2.5 6h-1A1.5 1.5 0 0 0 0 7.5v1A1.5 1.5 0 0 0 1.5 10h1A1.5 1.5 0 0 0 4 8.5h2.025A5 5 0 0 0 11 13m.5-7.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2a.5.5 0 0 1 1 0"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center gap-2 text-gray-500">
                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-gray-400" viewBox="0 0 16 16">
                                                    <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1ZM3.5 8a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0Z"/>
                                                </svg>
                                            </div>
                                            <p class="font-medium">No hay propietarios registrados</p>
                                            <p class="text-sm">Agrega el primer propietario para comenzar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <br>

        {{-- 🐶 MASCOTAS / PACIENTES --}}
        <div class="mt-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Mascotas / Pacientes
                    </h3>
                    <p class="text-sm text-gray-500">
                        Registro de pacientes y sus propietarios
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white">
                            <tr class="text-left">
                                <th class="px-6 py-4 font-semibold">Mascota</th>
                                <th class="px-6 py-4 font-semibold">Especie</th>
                                <th class="px-6 py-4 font-semibold">Edad</th>
                                <th class="px-6 py-4 font-semibold">Propietario</th>
                                <th class="px-6 py-4 font-semibold">Teléfono</th>
                                <th class="px-6 py-4 font-semibold text-center">Esterilizado</th>
                                <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($mascotas as $mascota)
                                <tr class="hover:bg-teal-50/60 transition-colors duration-200">
                                    {{-- Mascota --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($mascota->imagen)
                                                <img
                                                    src="{{ asset('storage/' . $mascota->imagen) }}"
                                                    class="w-12 h-12 rounded-full object-cover ring-2 ring-teal-100"
                                                    alt="Foto de {{ $mascota->nombre }}"
                                                >
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-gray-200 ring-2 ring-gray-100 flex items-center justify-center text-gray-400 font-semibold">
                                                    {{ strtoupper(substr($mascota->nombre, 0, 1)) }}
                                                </div>
                                            @endif

                                            <div>
                                                <p class="font-semibold text-gray-800 leading-tight">
                                                    {{ $mascota->nombre }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    Paciente activo
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $mascota->especie ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $mascota->edad ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $mascota->propietario->nombre ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $mascota->propietario->telefono ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($mascota->esterilizado)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-xs">
                                                Sí
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 font-semibold text-xs">
                                                No
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- VER --}}
                                            <a
                                                href="{{ route('pacientes.show', $mascota) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-teal-100 text-teal-600 shadow-sm transition-all duration-200 hover:bg-teal-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-400"
                                                title="Ver paciente"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                </svg>
                                            </a>

                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route('mascotas.edit', $mascota) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 shadow-sm transition-all duration-200 hover:bg-blue-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                title="Editar mascota"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center gap-2 text-gray-500">
                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-gray-400" viewBox="0 0 16 16">
                                                    <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1ZM3.5 8a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0Z"/>
                                                </svg>
                                            </div>
                                            <p class="font-medium">No hay pacientes registrados</p>
                                            <p class="text-sm">Agrega una mascota para comenzar con el registro clínico.</p>
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
            {{ $mascotas->links() }}
        </div>

    </div>
</x-app-layout>