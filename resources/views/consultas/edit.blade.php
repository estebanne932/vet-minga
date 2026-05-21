<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- HEADER --}}
        <div class="mb-8 flex items-center justify-between gap-4 flex-wrap">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('consultas.index') }}" class="hover:text-teal-600 transition">
                        Consultas
                    </a>
                    <span>/</span>
                    <span class="text-gray-700 font-medium">Editar consulta</span>
                </div>

                <h2 class="text-3xl font-bold text-gray-800">
                    Editar Consulta
                </h2>

                <p class="text-gray-500 mt-2">
                    Actualiza la información clínica del paciente.
                </p>
            </div>

            <a href="{{ route('consultas.index') }}"
               class="inline-flex items-center px-4 py-2 rounded-2xl border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                ← Volver
            </a>
        </div>

        <form method="POST"
              action="{{ route('consultas.update', $consulta) }}"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- PROPIETARIO --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 11c2.761 0 5-2.239 5-5S14.761 1 12 1 7 3.239 7 6s2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v3h16v-3c0-2.761-3.582-5-8-5z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Propietario</h3>
                        <p class="text-sm text-gray-500">Datos del dueño de la mascota.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="propietario_nombre"
                            value="{{ old('propietario_nombre', $consulta->propietario->nombre) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="propietario_telefono"
                            value="{{ old('propietario_telefono', $consulta->propietario->telefono) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Correo</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="propietario_correo"
                            value="{{ old('propietario_correo', $consulta->propietario->correo) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Dirección</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="propietario_direccion"
                            value="{{ old('propietario_direccion', $consulta->propietario->direccion) }}"
                        >
                    </div>
                </div>
            </div>

            {{-- MASCOTA --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-pink-50 flex items-center justify-center text-pink-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5a3 3 0 100 6 3 3 0 000-6zm6 0a3 3 0 100 6 3 3 0 000-6zM5 13a3 3 0 100 6 3 3 0 000-6zm14 0a3 3 0 100 6 3 3 0 000-6zM12 10c-2.5 0-5 2-5 4.5S9.5 19 12 19s5-2 5-4.5S14.5 10 12 10z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Mascota</h3>
                        <p class="text-sm text-gray-500">Información general del paciente.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre de la mascota</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="mascota_nombre"
                            value="{{ old('mascota_nombre', $consulta->mascota->nombre) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Especie</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="mascota_especie"
                            value="{{ old('mascota_especie', $consulta->mascota->especie) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Raza</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="mascota_raza"
                            value="{{ old('mascota_raza', $consulta->mascota->raza) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Edad</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="mascota_edad"
                            value="{{ old('mascota_edad', $consulta->mascota->edad) }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Peso</label>
                        <input
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            name="mascota_peso"
                            value="{{ old('mascota_peso', $consulta->mascota->peso) }}"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center justify-between gap-4 border border-gray-200 rounded-2xl px-5 py-4 bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
                            <div>
                                <p class="font-semibold text-gray-800">Mascota esterilizada</p>
                                <p class="text-sm text-gray-500">Marca esta opción si ya fue esterilizada.</p>
                            </div>

                            <input
                                type="checkbox"
                                name="mascota_esterilizado"
                                value="1"
                                class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                {{ old('mascota_esterilizado', $consulta->mascota->esterilizado) ? 'checked' : '' }}
                            >
                        </label>
                    </div>
                </div>
            </div>

            {{-- CONSULTA --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h3m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Consulta</h3>
                        <p class="text-sm text-gray-500">Motivo, fecha y veterinario responsable.</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Motivo de consulta</label>
                        <textarea
                            name="motivo"
                            rows="4"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition resize-none"
                        >{{ old('motivo', $consulta->motivo) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha</label>
                            <input
                                type="date"
                                name="fecha"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                value="{{ old('fecha', $consulta->fecha) }}"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Veterinario</label>
                            <input
                                name="veterinario"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                value="{{ old('veterinario', $consulta->veterinario) }}"
                            >
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXAMEN FÍSICO --}}
            @php
                $examen = config('examen_fisico');
                $examenData = $consulta->examenFisico->pluck('respuesta', 'punto');
            @endphp

            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Examen físico</h3>
                        <p class="text-sm text-gray-500">Registra los hallazgos clínicos.</p>
                    </div>
                </div>

                <div class="space-y-8">
                    @foreach ($examen as $grupo => $puntos)
                        <div class="border border-gray-100 rounded-3xl p-5 bg-gray-50/50">
                            <div class="mb-5">
                                <h4 class="font-bold text-gray-800 text-lg capitalize">
                                    {{ str_replace('_', ' ', $grupo) }}
                                </h4>
                                <div class="w-14 h-1 bg-teal-500 rounded-full mt-2"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                @foreach ($puntos as $key => $label)
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            {{ $label }}
                                        </label>

                                        <input
                                            type="text"
                                            name="examen_fisico[{{ $key }}]"
                                            placeholder="Escribe una observación..."
                                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                            value="{{ old('examen_fisico.' . $key, $examenData[$key] ?? '') }}"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                @php
                    $checks = config('examen_fisico_check');
                    $checkData = $consulta->examenFisicoCheck->pluck('respuesta', 'punto');
                @endphp

                <div class="mt-10">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                        <h4 class="font-bold text-gray-800 text-lg">Evaluaciones rápidas</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($checks as $key => $label)
                            <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 hover:border-teal-300 transition">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $label }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Selecciona Sí o No</p>
                                </div>

                                <select
                                    name="examen_fisico_check[{{ $key }}]"
                                    class="rounded-xl border-gray-300 text-sm focus:ring-teal-500 focus:border-teal-500"
                                >
                                    <option value="">—</option>
                                    <option value="1" {{ (old("examen_fisico_check.$key", $checkData[$key] ?? null)) ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ (old("examen_fisico_check.$key", $checkData[$key] ?? null) !== null && !old("examen_fisico_check.$key", $checkData[$key] ?? null)) ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- DIAGNÓSTICO --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Diagnóstico</h3>
                        <p class="text-sm text-gray-500">Diagnóstico diferencial y definitivo.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Diagnósticos diferenciales</label>
                        <textarea
                            name="diagnosticos_diferenciales"
                            rows="5"
                            placeholder="Ej. Gastroenteritis, parasitosis, cuerpo extraño..."
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition resize-none"
                        >{{ old('diagnosticos_diferenciales', optional($consulta->diagnostico)->diagnosticos_diferenciales) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Diagnóstico definitivo</label>
                        <textarea
                            name="diagnostico_definitivo"
                            rows="5"
                            placeholder="Ej. Gastroenteritis infecciosa"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition resize-none"
                        >{{ old('diagnostico_definitivo', optional($consulta->diagnostico)->diagnostico_definitivo) }}</textarea>
                    </div>
                </div>
            </div>

           {{-- MEDICAMENTOS --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center justify-between flex-wrap gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a4 4 0 00-5.656-5.656l-8.486 8.486a2 2 0 102.828 2.828l8.486-8.486m-4.243-4.243l1.414-1.414a4 4 0 115.657 5.657l-1.414 1.414" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Medicamentos aplicados</h3>
                            <p class="text-sm text-gray-500">Registra los medicamentos administrados durante la consulta.</p>
                        </div>
                    </div>

                    <button
                        type="button"
                        onclick="agregarMedicamento()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-teal-600 text-white text-sm font-medium hover:bg-teal-700 transition shadow-sm"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Agregar medicamento
                    </button>
                </div>

                <div id="medicamentos-container" class="space-y-5">
                    @foreach($consulta->medicamentosAplicados as $i => $med)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 medicamento-item border border-gray-100 rounded-3xl p-5 bg-gray-50/60 relative">

                            <button
                                type="button"
                                onclick="eliminarMedicamento(this)"
                                class="absolute top-3 right-3 text-red-500 hover:text-red-700 font-bold"
                                title="Quitar medicamento"
                            >
                                ×
                            </button>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Medicamento</label>
                                <input
                                    name="medicamentos[{{ $i }}][medicamento]"
                                    value="{{ old("medicamentos.$i.medicamento", $med->medicamento) }}"
                                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Dosis</label>
                                <input
                                    name="medicamentos[{{ $i }}][dosis]"
                                    value="{{ old("medicamentos.$i.dosis", $med->dosis) }}"
                                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Frecuencia</label>
                                <select
                                    name="medicamentos[{{ $i }}][frecuencia]"
                                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                >
                                    <option value="">Selecciona una frecuencia</option>
                                    <option value="SID" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'SID' ? 'selected' : '' }}>SID</option>
                                    <option value="BID" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'BID' ? 'selected' : '' }}>BID</option>
                                    <option value="TID" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'TID' ? 'selected' : '' }}>TID</option>
                                    <option value="QID" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'QID' ? 'selected' : '' }}>QID</option>
                                    <option value="q24h" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'q24h' ? 'selected' : '' }}>q24h</option>
                                    <option value="q12h" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'q12h' ? 'selected' : '' }}>q12h</option>
                                    <option value="q8h" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'q8h' ? 'selected' : '' }}>q8h</option>
                                    <option value="q6h" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'q6h' ? 'selected' : '' }}>q6h</option>
                                    <option value="PRN" {{ old("medicamentos.$i.frecuencia", $med->frecuencia) == 'PRN' ? 'selected' : '' }}>PRN</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Periodo</label>
                                <input
                                    name="medicamentos[{{ $i }}][periodo]"
                                    value="{{ old("medicamentos.$i.periodo", $med->periodo) }}"
                                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- FIRMA --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 3l5 5-9 9H7v-5l9-9z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Firma</h3>
                        <p class="text-sm text-gray-500">Firma capturada en la consulta.</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50 p-3">
                        @if($consulta->firma)
                            <img src="{{ asset('storage/' . $consulta->firma) }}"
                                 alt="Firma"
                                 class="w-full max-h-52 object-contain bg-white rounded-2xl shadow-inner">
                        @else
                            <div class="w-full h-40 md:h-52 bg-white rounded-2xl flex items-center justify-center text-gray-400">
                                Sin firma
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- BOTÓN --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-3 rounded-2xl bg-gradient-to-r from-teal-600 to-emerald-500 text-white font-semibold shadow-lg shadow-teal-200 hover:scale-[1.02] hover:shadow-xl transition">
                    Actualizar consulta
                </button>
            </div>
        </form>

        <script>
            let medicamentoIndex = {{ $consulta->medicamentosAplicados->count() }};

            window.agregarMedicamento = function () {
                const container = document.getElementById('medicamentos-container');
                if (!container) return;

                const div = document.createElement('div');
                div.className = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 medicamento-item border border-gray-100 rounded-3xl p-5 bg-gray-50/60 relative';

                div.innerHTML = `
                    <button
                        type="button"
                        onclick="eliminarMedicamento(this)"
                        class="absolute top-3 right-3 text-red-500 hover:text-red-700 font-bold"
                        title="Quitar medicamento"
                    >
                        ×
                    </button>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Medicamento
                        </label>

                        <input
                            name="medicamentos[${medicamentoIndex}][medicamento]"
                            type="text"
                            placeholder="Ej. Amoxicilina"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Dosis
                        </label>

                        <input
                            name="medicamentos[${medicamentoIndex}][dosis]"
                            type="text"
                            placeholder="Ej. 5 ml"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Frecuencia
                        </label>

                        <select
                            name="medicamentos[${medicamentoIndex}][frecuencia]"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                            <option value="">Selecciona una frecuencia</option>
                            <option value="SID">SID</option>
                            <option value="BID">BID</option>
                            <option value="TID">TID</option>
                            <option value="QID">QID</option>
                            <option value="q24h">q24h</option>
                            <option value="q12h">q12h</option>
                            <option value="q8h">q8h</option>
                            <option value="q6h">q6h</option>
                            <option value="PRN">PRN</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Periodo
                        </label>

                        <input
                            name="medicamentos[${medicamentoIndex}][periodo]"
                            type="text"
                            placeholder="Ej. 7 días"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>
                `;

                container.appendChild(div);
                medicamentoIndex++;
            };

            window.eliminarMedicamento = function (button) {
                const item = button.closest('.medicamento-item');
                if (item) {
                    item.remove();
                }
            };
        </script>
    </div>
</x-app-layout>