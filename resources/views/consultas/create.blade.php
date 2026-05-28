
<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Nueva Consulta
                    </h3>
                    <p class="text-sm text-gray-500">
                        Registro clínico 
                    </p>
                </div>
            </div>

        <form id="consulta-form" method="POST" action="{{ route('consultas.store') }}" enctype="multipart/form-data">
            @csrf

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
                    <p class="text-sm text-gray-500">Selecciona un propietario y revisa sus datos de contacto.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label for="propietario_select" class="block text-sm font-semibold text-gray-700 mb-2">
                        Propietario
                    </label>

                    <select
                        name="propietario_id"
                        id="propietario_select"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                        <option value="">Selecciona un propietario</option>

                        @foreach($propietarios as $propietario)
                            <option
                                value="{{ $propietario->id }}"
                                data-telefono="{{ $propietario->telefono }}"
                                data-correo="{{ $propietario->correo }}"
                                data-direccion="{{ $propietario->direccion }}"
                            >
                                {{ $propietario->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-2">
                        Teléfono
                    </label>
                    <input
                        id="telefono"
                        name="propietario_telefono"
                        type="text"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                </div>

                <div>
                    <label for="correo" class="block text-sm font-semibold text-gray-700 mb-2">
                        Correo
                    </label>
                    <input
                        id="correo"
                        name="propietario_correo"
                        type="text"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="direccion" class="block text-sm font-semibold text-gray-700 mb-2">
                        Dirección
                    </label>
                    <input
                        id="direccion"
                        name="propietario_direccion"
                        type="text"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                </div>
            </div>
        </div>


          {{-- MASCOTA --}}
<div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">

    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-2xl bg-pink-50 flex items-center justify-center text-pink-600">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.8"
                      d="M9 5a3 3 0 100 6 3 3 0 000-6zm6 0a3 3 0 100 6 3 3 0 000-6zM5 13a3 3 0 100 6 3 3 0 000-6zm14 0a3 3 0 100 6 3 3 0 000-6zM12 10c-2.5 0-5 2-5 4.5S9.5 19 12 19s5-2 5-4.5S14.5 10 12 10z" />
            </svg>
        </div>

        <div>
            <h3 class="text-lg font-bold text-gray-800">
                Mascota
            </h3>

            <p class="text-sm text-gray-500">
                Selecciona una mascota y completa su información.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- SELECT MASCOTA --}}
        <div class="md:col-span-2">
                    <label for="mascota_select"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Mascota
                    </label>

                    <select
                        id="mascota_select"
                        name="mascota_id"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                        <option value="">Selecciona una mascota</option>
                    </select>
                </div>

                {{-- FOTO --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Foto de la mascota
                    </label>

                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-5 bg-gray-50 hover:border-teal-400 transition">
                        <input
                            type="file"
                            name="mascota_imagen"
                            accept="image/*"
                            class="w-full text-sm text-gray-600
                                file:border-0
                                file:rounded-xl
                                file:bg-teal-600
                                file:text-white
                                file:px-4
                                file:py-2
                                file:mr-4
                                hover:file:bg-teal-700"
                        >

                        <p class="text-xs text-gray-400 mt-2">
                            JPG, PNG o WEBP
                        </p>
                    </div>
                </div>

                {{-- PREVIEW --}}
                <div class="md:col-span-2">
                    <img
                        id="mascota-preview"
                        src=""
                        alt="Foto de la mascota"
                        class="hidden max-h-48 rounded-2xl border border-gray-200 object-cover shadow-sm"
                    >
                </div>

                {{-- ESTERILIZADO --}}
                <div class="md:col-span-2">
                    <label class="flex items-center justify-between gap-4 border border-gray-200 rounded-2xl px-5 py-4 bg-gray-50 hover:bg-gray-100 transition cursor-pointer">

                        <div>
                            <p class="font-semibold text-gray-800">
                                Mascota esterilizada
                            </p>

                            <p class="text-sm text-gray-500">
                                Marca esta opción si la mascota ya fue esterilizada.
                            </p>
                        </div>

                        <input
                            type="checkbox"
                            name="mascota_esterilizado"
                            id="mascota_esterilizado"
                            value="1"
                            class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                        >
                    </label>
                </div>

                {{-- ESPECIE --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Especie
                    </label>

                    <select
                        name="mascota_especie"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                        <option value="">Selecciona una especie</option>
                        <option value="Canino">Canino</option>
                        <option value="Felino">Felino</option>
                    </select>
                </div>

                {{-- RAZA --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Raza
                    </label>

                    <input
                        name="mascota_raza"
                        type="text"
                        placeholder="Ej. Husky"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                </div>

                {{-- EDAD --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Edad
                    </label>

                    <input
                        name="mascota_edad"
                        type="text"
                        placeholder="Ej. 3 años"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                </div>

                {{-- PESO --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Peso
                    </label>

                    <input
                        name="mascota_peso"
                        type="text"
                        placeholder="Ej. 12.5 kg"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                    >
                </div>
            </div>
        </div>


            {{-- CONSULTA --}}
        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h3m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Consulta
                    </h3>

                    <p class="text-sm text-gray-500">
                        Registra el motivo y la información general de la consulta.
                    </p>
                </div>
            </div>

            <div class="space-y-5">

                {{-- MOTIVO --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Motivo de consulta
                    </label>

                    <textarea
                        name="motivo"
                        rows="4"
                        placeholder="Describe el motivo de la consulta..."
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition resize-none"
                    ></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- FECHA --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Fecha
                        </label>

                        <input
                            type="date"
                            name="fecha"
                            value="{{ now()->format('Y-m-d') }}"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                                focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>

                    {{-- VETERINARIO --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Veterinario
                        </label>

                        <input
                            name="veterinario"
                            type="text"
                            value="Valeria Mingura Gamboa"
                            placeholder="Nombre del veterinario"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                                focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>

                </div>
            </div>
        </div>

            {{-- EXAMEN FÍSICO --}}
        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">

            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Examen físico
                    </h3>

                    <p class="text-sm text-gray-500">
                        Registra los hallazgos clínicos y observaciones del paciente.
                    </p>
                </div>
            </div>

            @php
                $examen = config('examen_fisico');
            @endphp

            {{-- CAMPOS --}}
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
                                        class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700
                                            focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                                    >
                                </div>

                            @endforeach

                        </div>
                    </div>

                @endforeach

            </div>

            {{-- CHECKS --}}
            <div class="mt-10">

                <div class="flex items-center gap-2 mb-5">
                    <div class="w-2 h-2 rounded-full bg-teal-500"></div>

                    <h4 class="font-bold text-gray-800 text-lg">
                        Evaluaciones rápidas
                    </h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @foreach ($checks as $key => $label)

                        <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 hover:border-teal-300 transition">

                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $label }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Selecciona Sí o No
                                </p>
                            </div>

                            <div class="flex bg-gray-200 rounded-xl p-1">

                                {{-- NO --}}
                                <button
                                    type="button"
                                    onclick="setCheck('{{ $key }}', 0)"
                                    id="btn-no-{{ $key }}"
                                    class="px-4 py-1.5 text-sm rounded-lg text-gray-600 transition"
                                >
                                    No
                                </button>

                                {{-- SI --}}
                                <button
                                    type="button"
                                    onclick="setCheck('{{ $key }}', 1)"
                                    id="btn-si-{{ $key }}"
                                    class="px-4 py-1.5 text-sm rounded-lg text-gray-600 transition"
                                >
                                    Sí
                                </button>

                            </div>

                            <input
                                type="hidden"
                                name="examen_fisico_check[{{ $key }}]"
                                id="input-{{ $key }}"
                            >

                        </div>

                    @endforeach

                </div>
            </div>
        </div>

        {{-- DIAGNÓSTICO --}}
        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">

            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h6M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Diagnóstico
                    </h3>

                    <p class="text-sm text-gray-500">
                        Registra los diagnósticos obtenidos durante la consulta.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">

                {{-- DIFERENCIALES --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Diagnósticos diferenciales
                    </label>

                    <textarea
                        name="diagnosticos_diferenciales"
                        rows="5"
                        placeholder="Ej. Gastroenteritis, parasitosis, cuerpo extraño..."
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100
                            transition resize-none"
                    ></textarea>

                    <p class="text-xs text-gray-400 mt-2">
                        Incluye posibles diagnósticos relacionados con los signos clínicos observados.
                    </p>
                </div>

                {{-- DEFINITIVO --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Diagnóstico definitivo
                    </label>

                    <textarea
                        name="diagnostico_definitivo"
                        rows="5"
                        placeholder="Ej. Gastroenteritis infecciosa"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                            focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100
                            transition resize-none"
                    ></textarea>

                    <p class="text-xs text-gray-400 mt-2">
                        Especifica el diagnóstico confirmado del paciente.
                    </p>
                </div>

            </div>
        </div>
                
        {{-- MEDICAMENTOS APLICADOS --}}
        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">

            <div class="flex items-center justify-between flex-wrap gap-4 mb-8">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M19.428 15.428a4 4 0 00-5.656-5.656l-8.486 8.486a2 2 0 102.828 2.828l8.486-8.486m-4.243-4.243l1.414-1.414a4 4 0 115.657 5.657l-1.414 1.414" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            Medicamentos aplicados
                        </h3>

                        <p class="text-sm text-gray-500">
                            Registra los medicamentos administrados durante la consulta.
                        </p>
                    </div>
                </div>

                {{-- BOTON --}}
                <button
                    type="button"
                    onclick="agregarMedicamento()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-teal-600 text-white text-sm font-medium
                        hover:bg-teal-700 transition shadow-sm"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>

                    Agregar medicamento
                </button>
            </div>

            {{-- CONTENEDOR --}}
            <div id="medicamentos-container" class="space-y-5">

                {{-- ITEM --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 medicamento-item border border-gray-100 rounded-3xl p-5 bg-gray-50/60">

                    {{-- MEDICAMENTO --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Medicamento
                        </label>

                        <input
                            name="medicamentos[0][medicamento]"
                            type="text"
                            placeholder="Ej. Amoxicilina"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700
                                focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>

                   {{-- DOSIS --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Dosis
                        </label>

                        <div class="relative">
                            <input
                                id="dosisInput"
                                name="medicamentos[0][dosis]"
                                type="text"
                                placeholder="Ej. 5 ml"
                                class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 pr-14 text-gray-700
                                    focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                            >

                            {{-- Botón calculadora --}}
                            <button
                                type="button"
                                onclick="openDoseModal(this.closest('.relative').querySelector('input'))"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-teal-600 transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 7h6m-6 4h6m-6 4h2m4 0h2M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- FRECUENCIA --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Frecuencia
                        </label>

                        <select
                            name="medicamentos[0][frecuencia]"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700
                                focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                            <option value="">Selecciona una frecuencia</option>

                            <option value="SID">SID</option>
                            <option value="BID">BID</option>
                            <option value="TID">TID</option>
                            <option value="QID">QI</option>

                            <option value="q24h">q24h</option>
                            <option value="q12h">q12h</option>
                            <option value="q8h">q8h</option>
                            <option value="q6h">q6h</option>

                            <option value="PRN">PRN</option>
                        </select>
                    </div>

                    {{-- PERIODO --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Periodo
                        </label>

                        <input
                            name="medicamentos[0][periodo]"
                            type="text"
                            placeholder="Ej. 7 días"
                            class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700
                                focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                    </div>

                </div>
            </div>
        </div>


           {{-- FIRMA --}}
        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 md:p-8 mb-6">

            <div class="flex items-center justify-between flex-wrap gap-4 mb-8">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 3l5 5-9 9H7v-5l9-9z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            Firma del propietario
                        </h3>

                        <p class="text-sm text-gray-500">
                            Solicita la firma digital para validar la consulta y autorización.
                        </p>
                    </div>
                </div>

                {{-- LIMPIAR --}}
                <button
                    type="button"
                    onclick="clearSignature()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl border border-gray-200
                        text-sm font-medium text-gray-600 hover:bg-gray-50 transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    Limpiar firma
                </button>
            </div>

            {{-- AUTORIZACIÓN --}}
            <div class="mb-6">

                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">

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
                                    d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                            </svg>
                        </div>

                        <div class="flex-1">

                            <h4 class="text-sm font-semibold text-amber-800 mb-2">
                                Autorización médica en caso de emergencia
                            </h4>

                            <p class="text-sm text-amber-700 leading-relaxed">
                                Autorizo al médico veterinario responsable y al personal de la clínica a tomar
                                decisiones médicas, diagnósticas y terapéuticas necesarias para preservar la vida
                                y bienestar de mi mascota en caso de emergencia, cuando no sea posible localizarme
                                o establecer comunicación conmigo de manera oportuna.
                            </p>

                            <p class="text-sm text-amber-700 leading-relaxed mt-3">
                                Entiendo que dichas decisiones serán tomadas bajo criterio profesional veterinario,
                                buscando siempre el mejor beneficio para el paciente.
                            </p>

                            <label class="mt-4 flex items-start gap-3 cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="autorizacion_emergencia"
                                    value="1"
                                    required
                                    class="mt-1 rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500"
                                >

                                <span class="text-sm text-gray-700 leading-relaxed">
                                    He leído y acepto la autorización médica en caso de emergencia.
                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

            {{-- CANVAS --}}
            <div class="relative">

                <div class="border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50 p-3">

                    <canvas
                        id="signature-pad"
                        class="w-full h-40 md:h-52 bg-white rounded-2xl shadow-inner"
                    ></canvas>

                </div>

                {{-- TEXTO GUIA --}}
                <div class="flex items-center justify-between mt-3 px-1">

                    <p class="text-xs text-gray-400">
                        Firma dentro del recuadro usando mouse o pantalla táctil.
                    </p>

                    <div class="hidden md:flex items-center gap-2 text-xs text-gray-400">
                        <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                        Firma digital activa
                    </div>
                </div>

                <input
                    type="hidden"
                    name="firma"
                    id="firma"
                >
            </div>
        </div>


            <button class="bg-teal-600 text-white px-6 py-2 rounded">
                Guardar consulta
            </button>
        </form>

        {{-- MODAL CALCULADORA --}}
            <div
                id="doseModal"
                class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
            >
                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">
                            Calculadora de dosis
                        </h2>

                        <button
                            type="button"
                            onclick="closeDoseModal()"
                            class="text-gray-400 hover:text-red-500"
                        >
                            ✕
                        </button>
                    </div>

                    {{-- Equivalencia --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Equivalencia por kg
                        </label>

                        <input
                            id="equivalencia"
                            type="number"
                            step="0.01"
                            placeholder="Ej. 0.2"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:ring-4 focus:ring-teal-100"
                        >

                        <p class="text-xs text-gray-500 mt-1">
                            Ejemplo: 0.2 ml por kg
                        </p>
                    </div>

                    {{-- Peso --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Peso de la mascota (kg)
                        </label>

                        <input
                            id="pesoMascota"
                            type="number"
                            step="0.01"
                            placeholder="Ej. 12"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:ring-4 focus:ring-teal-100"
                        >
                    </div>

                    {{-- Resultado --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Resultado
                        </label>

                        <input
                            id="resultadoDosis"
                            type="text"
                            readonly
                            class="w-full rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3"
                        >
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            onclick="closeDoseModal()"
                            class="px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-50"
                        >
                            Cancelar
                        </button>

                        <button
                            type="button"
                            onclick="calcularDosis()"
                            class="px-5 py-2 rounded-xl bg-teal-600 text-white hover:bg-teal-700"
                        >
                            Calcular
                        </button>

                        <button
                            type="button"
                            onclick="aplicarDosis()"
                            class="px-5 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700"
                        >
                            Aplicar
                        </button>
                    </div>
                </div>
            </div>


        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>

       <script>
            document.addEventListener('DOMContentLoaded', () => {
                // =========================
                // ELEMENTOS PRINCIPALES
                // =========================
                const propietarioSelect = document.getElementById('propietario_select');
                const mascotaSelect = document.getElementById('mascota_select');
                const form = document.getElementById('consulta-form');
                const canvas = document.getElementById('signature-pad');

                // =========================
                // ESTADO GLOBAL
                // =========================
                let signaturePad = null;
                let medicamentoIndex = 1;
                let inputDosisActivo = null;

                // =========================
                // INICIALIZACIONES
                // =========================
                initPropietario();
                initSignaturePad();
                initMascota();
                registerGlobalFunctions();

                // =========================
                // PROPIETARIO
                // =========================
                function initPropietario() {
                    if (!propietarioSelect) return;

                    propietarioSelect.addEventListener('change', function () {
                        const option = this.options[this.selectedIndex];

                        setValueIfExists('telefono', option?.dataset.telefono || '');
                        setValueIfExists('correo', option?.dataset.correo || '');
                        setValueIfExists('direccion', option?.dataset.direccion || '');
                    });
                }

                // =========================
                // FIRMA
                // =========================
                function initSignaturePad() {
                    if (!canvas || typeof SignaturePad === 'undefined') return;

                    signaturePad = new SignaturePad(canvas);

                    const resizeCanvas = () => {
                        const ratio = Math.max(window.devicePixelRatio || 1, 1);
                        canvas.width = canvas.offsetWidth * ratio;
                        canvas.height = canvas.offsetHeight * ratio;
                        canvas.getContext('2d').scale(ratio, ratio);
                    };

                    window.addEventListener('resize', resizeCanvas);
                    resizeCanvas();

                    window.clearSignature = function () {
                        signaturePad.clear();
                    };

                    if (form) {
                        form.addEventListener('submit', function () {
                            if (!signaturePad.isEmpty()) {
                                const firma = document.getElementById('firma');
                                if (firma) {
                                    firma.value = signaturePad.toDataURL('image/png');
                                }
                            }
                        });
                    }
                }

                // =========================
                // MASCOTAS
                // =========================
                function initMascota() {
                    if (!mascotaSelect) return;

                    if (propietarioSelect) {
                        propietarioSelect.addEventListener('change', async function () {
                            const option = this.options[this.selectedIndex];

                            setValueIfExists('telefono', option?.dataset.telefono || '');
                            setValueIfExists('correo', option?.dataset.correo || '');
                            setValueIfExists('direccion', option?.dataset.direccion || '');

                            mascotaSelect.innerHTML = '<option value="">Cargando mascotas...</option>';

                            if (!this.value) {
                                mascotaSelect.innerHTML = '<option value="">Selecciona una mascota</option>';
                                limpiarDatosMascota();
                                return;
                            }

                            try {
                                const res = await fetch(`/propietarios/${this.value}/mascotas`);
                                const mascotas = await res.json();

                                mascotaSelect.innerHTML = '<option value="">Selecciona una mascota</option>';

                                mascotas.forEach(mascota => {
                                    const opt = document.createElement('option');
                                    opt.value = mascota.id;
                                    opt.textContent = mascota.nombre;
                                    opt.dataset.especie = mascota.especie || '';
                                    opt.dataset.raza = mascota.raza || '';
                                    opt.dataset.edad = mascota.edad || '';
                                    opt.dataset.peso = mascota.peso || '';
                                    opt.dataset.esterilizado = mascota.esterilizado ? 1 : 0;
                                    opt.dataset.imagen = mascota.imagen || '';
                                    mascotaSelect.appendChild(opt);
                                });
                            } catch (error) {
                                console.error(error);
                                mascotaSelect.innerHTML = '<option value="">Error al cargar mascotas</option>';
                            }
                        });
                    }

                    mascotaSelect.addEventListener('change', function () {
                        const option = this.options[this.selectedIndex];

                        setValueIfExists('mascota_especie', option?.dataset.especie || '');
                        setValueIfExists('mascota_raza', option?.dataset.raza || '');
                        setValueIfExists('mascota_edad', option?.dataset.edad || '');
                        setValueIfExists('mascota_peso', option?.dataset.peso || '');

                        const esterilizado = document.getElementById('mascota_esterilizado');
                        if (esterilizado) {
                            esterilizado.checked = option?.dataset.esterilizado == 1;
                        }

                        const preview = document.getElementById('mascota-preview');
                        if (!preview) return;

                        if (option?.dataset.imagen) {
                            preview.src = `/storage/${option.dataset.imagen}`;
                            preview.classList.remove('hidden');
                        } else {
                            preview.src = '';
                            preview.classList.add('hidden');
                        }
                    });
                }

                function limpiarDatosMascota() {
                    setValueIfExists('mascota_especie', '');
                    setValueIfExists('mascota_raza', '');
                    setValueIfExists('mascota_edad', '');
                    setValueIfExists('mascota_peso', '');

                    const esterilizado = document.getElementById('mascota_esterilizado');
                    if (esterilizado) {
                        esterilizado.checked = false;
                    }

                    const preview = document.getElementById('mascota-preview');
                    if (preview) {
                        preview.src = '';
                        preview.classList.add('hidden');
                    }
                }

                // =========================
                // MEDICAMENTOS DINÁMICOS
                // =========================
                function crearInputMedicamento(tipo, placeholder) {
                    const div = document.createElement('div');

                    const label = document.createElement('label');
                    label.className = 'block text-sm font-semibold text-gray-700 mb-2';
                    label.textContent = tipo === 'medicamento'
                        ? 'Medicamento'
                        : tipo === 'dosis'
                            ? 'Dosis'
                            : 'Periodo';

                    if (tipo === 'dosis') {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'relative';

                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = `medicamentos[${medicamentoIndex}][dosis]`;
                        input.placeholder = placeholder;
                        input.className = 'w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 pr-14 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition';

                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-teal-600 transition';
                        btn.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h2m4 0h2M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                            </svg>
                        `;

                        btn.addEventListener('click', () => {
                            openDoseModal(input);
                        });

                        wrapper.appendChild(input);
                        wrapper.appendChild(btn);
                        div.appendChild(label);
                        div.appendChild(wrapper);
                        return div;
                    }

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = tipo === 'medicamento'
                        ? `medicamentos[${medicamentoIndex}][medicamento]`
                        : `medicamentos[${medicamentoIndex}][periodo]`;
                    input.placeholder = placeholder;
                    input.className = 'w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition';

                    div.appendChild(label);
                    div.appendChild(input);
                    return div;
                }

                function crearSelectFrecuencia() {
                    const div = document.createElement('div');

                    const label = document.createElement('label');
                    label.className = 'block text-sm font-semibold text-gray-700 mb-2';
                    label.textContent = 'Frecuencia';

                    const select = document.createElement('select');
                    select.name = `medicamentos[${medicamentoIndex}][frecuencia]`;
                    select.className = 'w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition';

                    const options = [
                        ['', 'Selecciona una frecuencia'],
                        ['SID', 'SID'],
                        ['BID', 'BID'],
                        ['TID', 'TID'],
                        ['QID', 'QID'],
                        ['q24h', 'q24h'],
                        ['q12h', 'q12h'],
                        ['q8h', 'q8h'],
                        ['q6h', 'q6h'],
                        ['PRN', 'PRN'],
                    ];

                    options.forEach(([value, text]) => {
                        const option = document.createElement('option');
                        option.value = value;
                        option.textContent = text;
                        select.appendChild(option);
                    });

                    div.appendChild(label);
                    div.appendChild(select);
                    return div;
                }

                function agregarMedicamento() {
                    const container = document.getElementById('medicamentos-container');
                    if (!container) return;

                    const item = document.createElement('div');
                    item.className = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 medicamento-item border border-gray-100 rounded-3xl p-5 bg-gray-50/60 relative';

                    const btnEliminar = document.createElement('button');
                    btnEliminar.type = 'button';
                    btnEliminar.className = 'absolute top-3 right-3 text-red-500 hover:text-red-700 font-bold';
                    btnEliminar.textContent = '×';
                    btnEliminar.addEventListener('click', () => item.remove());

                    item.appendChild(btnEliminar);
                    item.appendChild(crearInputMedicamento('medicamento', 'Ej. Amoxicilina'));
                    item.appendChild(crearInputMedicamento('dosis', 'Ej. 5 ml'));
                    item.appendChild(crearSelectFrecuencia());

                    const periodoDiv = document.createElement('div');
                    const labelPeriodo = document.createElement('label');
                    labelPeriodo.className = 'block text-sm font-semibold text-gray-700 mb-2';
                    labelPeriodo.textContent = 'Periodo';

                    const inputPeriodo = document.createElement('input');
                    inputPeriodo.type = 'text';
                    inputPeriodo.name = `medicamentos[${medicamentoIndex}][periodo]`;
                    inputPeriodo.placeholder = 'Ej. 7 días';
                    inputPeriodo.className = 'w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-gray-700 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition';

                    periodoDiv.appendChild(labelPeriodo);
                    periodoDiv.appendChild(inputPeriodo);
                    item.appendChild(periodoDiv);

                    container.appendChild(item);
                    medicamentoIndex++;
                }

                // =========================
                // CHECKS GENÉRICOS
                // =========================
                function setCheck(key, value) {
                    const input = document.getElementById('input-' + key);
                    const btnNo = document.getElementById('btn-no-' + key);
                    const btnSi = document.getElementById('btn-si-' + key);

                    if (!input || !btnNo || !btnSi) return;

                    input.value = value;

                    btnNo.classList.remove('bg-red-500', 'text-white');
                    btnSi.classList.remove('bg-teal-600', 'text-white');

                    if (value == 0) {
                        btnNo.classList.add('bg-red-500', 'text-white');
                    } else {
                        btnSi.classList.add('bg-teal-600', 'text-white');
                    }
                }

                // =========================
                // MODAL DOSIS
                // =========================
                function openDoseModal(input = null) {
                    if (input) {
                        inputDosisActivo = input;
                    }

                    const modal = document.getElementById('doseModal');
                    if (!modal) return;

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeDoseModal() {
                    const modal = document.getElementById('doseModal');
                    if (!modal) return;

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }

                function calcularDosis() {
                    const equivalencia = parseFloat(document.getElementById('equivalencia')?.value);
                    const peso = parseFloat(document.getElementById('pesoMascota')?.value);

                    if (isNaN(equivalencia) || isNaN(peso)) {
                        alert('Completa los campos correctamente');
                        return;
                    }

                    const resultado = (equivalencia * peso).toFixed(2) + ' ml';
                    const resultadoInput = document.getElementById('resultadoDosis');

                    if (resultadoInput) {
                        resultadoInput.value = resultado;
                    }
                }

                function aplicarDosis() {
                    const resultadoInput = document.getElementById('resultadoDosis');
                    const resultado = resultadoInput?.value || '';

                    if (!resultado) {
                        alert('Primero calcula la dosis');
                        return;
                    }

                    if (inputDosisActivo) {
                        inputDosisActivo.value = resultado;
                    }

                    closeDoseModal();
                }

                // =========================
                // EXPONER FUNCIONES GLOBALES
                // =========================
                function registerGlobalFunctions() {
                    window.agregarMedicamento = agregarMedicamento;
                    window.setCheck = setCheck;
                    window.openDoseModal = openDoseModal;
                    window.closeDoseModal = closeDoseModal;
                    window.calcularDosis = calcularDosis;
                    window.aplicarDosis = aplicarDosis;
                }

                // =========================
                // HELPERS
                // =========================
               

                function setValueIfExists(name, value) {
                const el =
                    document.getElementById(name) ||
                    document.querySelector(`[name="${name}"]`);

                if (el) {
                    el.value = value;
                }
                }
            });
            </script>

    </div>
</x-app-layout>
