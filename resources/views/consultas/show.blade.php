<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-cyan-600 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                            <i class="bi bi-clipboard2-pulse-fill text-2xl"></i>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold">
                                Consulta #{{ $consulta->expediente_num }}
                            </h2>
                            <p class="text-cyan-100 text-sm">
                                Expediente clínico veterinario
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($consulta->estatus === 'abierta') bg-green-100 text-green-700
                            @elseif($consulta->estatus === 'en_proceso') bg-yellow-100 text-yellow-700
                            @elseif($consulta->estatus === 'cerrada') bg-gray-200 text-gray-700
                            @else bg-red-100 text-red-700
                            @endif
                        ">
                            {{ ucfirst(str_replace('_',' ', $consulta->estatus)) }}
                        </span>

                        <a
                            href="{{ route('consultas.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-cyan-700 font-medium hover:scale-105 transition"
                        >
                            <i class="bi bi-arrow-left-circle-fill"></i>
                            Volver
                        </a>
                    </div>
                </div>
            </div>

            {{-- PROPIETARIO --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center">
                        <i class="bi bi-person-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Propietario
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Nombre</p>
                        <p class="font-semibold text-gray-800">{{ $consulta->propietario->nombre }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Teléfono</p>
                        <p class="font-semibold text-gray-800">{{ $consulta->propietario->telefono }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Correo</p>
                        <p class="font-semibold text-gray-800 break-all">{{ $consulta->propietario->correo }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Dirección</p>
                        <p class="font-semibold text-gray-800">{{ $consulta->propietario->direccion }}</p>
                    </div>
                </div>
            </div>

            {{-- MASCOTA --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center">
                        <i class="bi bi-heart-pulse-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Mascota
                    </h3>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="shrink-0">
                        @if($consulta->mascota->imagen)
                            <img
                                src="{{ asset('storage/' . $consulta->mascota->imagen) }}"
                                class="w-40 h-40 object-cover rounded-2xl border-4 border-cyan-100 shadow-sm"
                                alt="Foto de {{ $consulta->mascota->nombre }}"
                            >
                        @else
                            <div class="w-40 h-40 rounded-2xl border-4 border-cyan-100 shadow-sm bg-gray-100 flex items-center justify-center text-gray-400">
                                <i class="bi bi-image text-4xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1 text-sm">
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Nombre</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->nombre }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Especie</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->especie }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Raza</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->raza }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Edad</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->edad }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Peso</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->peso }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Esterilizada</p>
                            @if($consulta->mascota->esterilizado)
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    <i class="bi bi-check-circle-fill mr-1"></i>
                                    Sí
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">
                                    <i class="bi bi-dash-circle-fill mr-1"></i>
                                    No
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATOS DE LA CONSULTA --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <i class="bi bi-clipboard2-pulse-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Datos de la consulta
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Fecha</p>
                        <p class="font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Veterinario</p>
                        <p class="font-semibold text-gray-800">{{ $consulta->veterinario }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 sm:col-span-2">
                        <p class="text-gray-500 mb-1">Motivo</p>
                        <p class="font-semibold text-gray-800 leading-relaxed">{{ $consulta->motivo }}</p>
                    </div>
                </div>
            </div>

            {{-- EXAMEN FÍSICO --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center">
                        <i class="bi bi-clipboard2-pulse-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Examen físico
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse ($consulta->examenFisico as $item)
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 hover:shadow-sm transition">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                {{ $item->punto }}
                            </p>
                            <p class="text-gray-700 mt-2 text-sm leading-relaxed">
                                {{ $item->respuesta ?: '—' }}
                            </p>
                        </div>
                    @empty
                        <div class="md:col-span-2 text-center py-6 text-gray-500">
                            No se registró examen físico descriptivo.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- EXAMEN FÍSICO CHECK --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center">
                        <i class="bi bi-check2-square text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Examen físico (checklist)
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse ($consulta->examenFisicoCheck as $item)
                        <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <span class="text-sm text-gray-700 pr-3">
                                {{ $item->punto }}
                            </span>

                            @if ($item->respuesta)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Sí
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    <i class="bi bi-x-circle-fill"></i>
                                    No
                                </span>
                            @endif
                        </div>
                    @empty
                        <div class="lg:col-span-3 text-center py-6 text-gray-500">
                            No se registró checklist de examen físico.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- QUÍMICA --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-violet-100 text-violet-700 flex items-center justify-center">
                        <i class="bi bi-droplet-half text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Química
                    </h3>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-700">
                            Estado:
                            @if($consulta->quimica->isNotEmpty())
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Registrada
                                </span>
                            @else
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    No registrada
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @if($consulta->quimica->isNotEmpty())
                            <a
                                href="{{ route('quimica.show', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-eye-fill"></i>
                                Ver
                            </a>

                            <a
                                href="{{ route('quimica.edit', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white shadow hover:bg-yellow-600 hover:scale-105 transition"
                            >
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </a>

                            <form
                                action="{{ route('quimica.destroy', $consulta->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar la biometría hemática?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white shadow hover:bg-red-700 hover:scale-105 transition"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                    Eliminar
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('quimica.create', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-plus-circle-fill"></i>
                                Agregar biometría
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- BIOMETRÍA HEMÁTICA --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-violet-100 text-violet-700 flex items-center justify-center">
                        <i class="bi bi-droplet-half text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Biometría hemática
                    </h3>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-700">
                            Estado:
                            @if($consulta->biometria->isNotEmpty())
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Registrada
                                </span>
                            @else
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    No registrada
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @if($consulta->biometria->isNotEmpty())
                            <a
                                href="{{ route('biometrias.show', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-eye-fill"></i>
                                Ver
                            </a>

                            <a
                                href="{{ route('biometrias.edit', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white shadow hover:bg-yellow-600 hover:scale-105 transition"
                            >
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </a>

                            <form
                                action="{{ route('biometrias.destroy', $consulta->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar la biometría hemática?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white shadow hover:bg-red-700 hover:scale-105 transition"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                    Eliminar
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('biometrias.create', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-plus-circle-fill"></i>
                                Agregar biometría
                            </a>
                        @endif
                    </div>
                </div>
            </div>


            {{-- EXAMEN DE ORINA --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-violet-100 text-violet-700 flex items-center justify-center">
                        <i class="bi bi-droplet-half text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Examen de orina
                    </h3>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-700">
                            Estado:
                            @if(($consulta->orinaExamenes ?? collect())->isNotEmpty())
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Registrado
                                </span>
                            @else
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    No registrado
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @if(($consulta->orinaExamenes ?? collect())->isNotEmpty())
                            <a
                                href="{{ route('examenes.show', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-eye-fill"></i>
                                Ver
                            </a>

                            <a
                                href="{{ route('examenes.edit', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white shadow hover:bg-yellow-600 hover:scale-105 transition"
                            >
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </a>

                            <form
                                action="{{ route('examenes.destroy', $consulta->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar el examen de orina?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white shadow hover:bg-red-700 hover:scale-105 transition"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                    Eliminar
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('examenes.create', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-plus-circle-fill"></i>
                                Agregar examen
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- PERFIL TIROIDEO --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-700 flex items-center justify-center">
                        <i class="bi bi-heart-pulse-fill text-lg"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Perfil tiroideo
                    </h3>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <p class="text-sm text-gray-700">
                            Estado:

                            @if(($consulta->perfilTiroides ?? collect())->isNotEmpty())
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Registrado
                                </span>
                            @else
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    No registrado
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">

                        @if(($consulta->perfilTiroides ?? collect())->isNotEmpty())

                            <a
                                href="{{ route('tiroides.show', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-eye-fill"></i>
                                Ver
                            </a>

                            <a
                                href="{{ route('tiroides.edit', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-500 text-white shadow hover:bg-yellow-600 hover:scale-105 transition"
                            >
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </a>

                            <form
                                action="{{ route('tiroides.destroy', $consulta->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar el perfil tiroideo?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white shadow hover:bg-red-700 hover:scale-105 transition"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                    Eliminar
                                </button>
                            </form>

                        @else

                            <a
                                href="{{ route('tiroides.create', $consulta->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700 hover:scale-105 transition"
                            >
                                <i class="bi bi-plus-circle-fill"></i>
                                Agregar perfil tiroideo
                            </a>

                        @endif

                    </div>

                </div>
            </div>

            {{-- RADIOGRAFÍAS --}}
<div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">

    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center">
                <i class="bi bi-image-fill text-lg"></i>
            </div>

            <h3 class="text-lg font-semibold text-gray-800">
                Radiografías
            </h3>
        </div>

        <form
            action="{{ route('radiografias.store',$consulta->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <input
                type="file"
                name="imagenes[]"
                multiple
                accept="image/*"
                onchange="this.form.submit()"
                class="hidden"
                id="radiografias_{{ $consulta->id }}"
            >

            <label
                for="radiografias_{{ $consulta->id }}"
                class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-600 text-white shadow hover:bg-indigo-700"
            >
                <i class="bi bi-plus-circle-fill"></i>
                Adjuntar
            </label>

        </form>
    </div>

    @if($consulta->radiografias->isNotEmpty())

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">

            @foreach($consulta->radiografias as $radiografia)

                <div class="relative group">

                    <a
                        href="{{ asset('storage/'.$radiografia->imagen) }}"
                        target="_blank"
                    >
                        <img
                            src="{{ asset('storage/'.$radiografia->imagen) }}"
                            class="w-full h-32 object-cover rounded-xl border"
                        >
                    </a>

                    <form
                        action="{{ route('radiografias.destroy',$radiografia->id) }}"
                        method="POST"
                        class="absolute top-2 right-2"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('¿Eliminar radiografía?')"
                            class="bg-red-600 text-white rounded-full w-8 h-8"
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center py-8 text-gray-500">
            No hay radiografías registradas
        </div>

    @endif

</div>

            {{-- DIAGNÓSTICO --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center">
                        <i class="bi bi-file-medical-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Diagnóstico
                    </h3>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-sm font-semibold text-gray-700">
                            Diagnósticos diferenciales
                        </p>
                        <p class="text-gray-600 mt-1 leading-relaxed">
                            {{ $consulta->diagnostico->diagnosticos_diferenciales ?? '—' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-sm font-semibold text-gray-700">
                            Diagnóstico definitivo
                        </p>
                        <p class="text-gray-600 mt-1 leading-relaxed">
                            {{ $consulta->diagnostico->diagnostico_definitivo ?? '—' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- MEDICAMENTOS APLICADOS --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="px-6 pt-6 pb-4 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <i class="bi bi-capsule-pill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Medicamentos aplicados
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Medicamento</th>
                                <th class="px-6 py-4 text-left font-semibold">Dosis</th>
                                <th class="px-6 py-4 text-left font-semibold">Frecuencia</th>
                                <th class="px-6 py-4 text-left font-semibold">Periodo</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($consulta->medicamentosAplicados as $med)
                                <tr class="hover:bg-cyan-50/60 transition">
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $med->medicamento }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $med->dosis ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $med->frecuencia ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $med->periodo ?? '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        No se registraron medicamentos.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FIRMA --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center">
                        <i class="bi bi-pen-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Firma del propietario
                    </h3>
                </div>

                <div class="flex flex-col items-center">
                    @if($consulta->firma)
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 shadow-sm">
                            <img
                                src="{{ asset('storage/' . $consulta->firma) }}"
                                class="border-2 border-gray-200 rounded-xl max-w-md bg-white p-3"
                                alt="Firma del propietario"
                            >
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-10 text-center text-gray-500">
                            <i class="bi bi-file-earmark-excel-fill text-3xl text-gray-300 block mb-2"></i>
                            Sin firma registrada
                        </div>
                    @endif
                </div>
                @if($consulta->autorizacion_emergencia)

    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-2xl p-5">

        <div class="flex items-start gap-3">

            <div class="mt-1 text-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div>
                <h4 class="text-sm font-semibold text-amber-800 mb-1">
                    Autorización de emergencia aceptada
                </h4>

                <p class="text-sm text-amber-700 leading-relaxed">
                    El propietario autorizó al médico veterinario responsable
                    a tomar decisiones médicas y terapéuticas necesarias en caso
                    de emergencia cuando no sea posible establecer comunicación.
                </p>
            </div>

        </div>

    </div>

@endif
            </div>

        </div>
    </div>
</x-app-layout>