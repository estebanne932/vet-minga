<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Editar Consulta
            </h2>

            <a href="{{ route('consultas.index') }}"
               class="text-sm text-gray-500 hover:underline">
                ← Volver
            </a>
        </div>

        <form method="POST"
              action="{{ route('consultas.update', $consulta) }}"
              class="space-y-6">

            @csrf
            @method('PUT')

            {{-- 🧍‍♂️ PROPIETARIO --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Propietario</h3>

                <div class="grid grid-cols-2 gap-4">
                    <input class="input" name="propietario_nombre"
                        value="{{ $consulta->propietario->nombre }}">

                    <input class="input" name="propietario_telefono"
                        value="{{ $consulta->propietario->telefono }}">

                    <input class="input" name="propietario_correo"
                        value="{{ $consulta->propietario->correo }}">

                    <input class="input" name="propietario_direccion"
                        value="{{ $consulta->propietario->direccion }}">
                </div>
            </div>

            {{-- 🐶 MASCOTA --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Mascota</h3>

                <div class="grid grid-cols-2 gap-4">
                    <input class="input" name="mascota_nombre"
                        value="{{ $consulta->mascota->nombre }}">

                    <input class="input" name="mascota_especie"
                        value="{{ $consulta->mascota->especie }}">

                    <input class="input" name="mascota_raza"
                        value="{{ $consulta->mascota->raza }}">

                    <input class="input" name="mascota_edad"
                        value="{{ $consulta->mascota->edad }}">

                    <input class="input" name="mascota_peso"
                        value="{{ $consulta->mascota->peso }}">

                    <div class="flex items-center gap-2 col-span-2">
                        <input type="checkbox" name="mascota_esterilizado" value="1"
                            {{ $consulta->mascota->esterilizado ? 'checked' : '' }}>
                        <label class="text-sm text-gray-600">
                            Mascota esterilizada
                        </label>
                    </div>
                </div>
            </div>

            {{-- 📋 CONSULTA --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Consulta</h3>

                <textarea name="motivo"
                    class="input w-full mb-4">{{ $consulta->motivo }}</textarea>

                <div class="grid grid-cols-2 gap-4">
                    <input type="date" name="fecha" class="input"
                        value="{{ $consulta->fecha }}">

                    <input name="veterinario" class="input"
                        value="{{ $consulta->veterinario }}">
                </div>
            </div>

            {{-- =========================
📋 CONSULTA
========================= --}}
<div class="bg-white rounded-xl shadow p-6">
    <h3 class="font-semibold text-gray-700 mb-4">Consulta</h3>

    <textarea
        name="motivo"
        class="input w-full mb-4"
        placeholder="Motivo de consulta"
    >{{ $consulta->motivo }}</textarea>

    <div class="grid grid-cols-2 gap-4">
        <input
            type="date"
            name="fecha"
            class="input"
            value="{{ $consulta->fecha }}"
        >

        <input
            name="veterinario"
            class="input"
            placeholder="Veterinario"
            value="{{ $consulta->veterinario }}"
        >
    </div>
</div>


{{-- =========================
🩺 EXAMEN FÍSICO
========================= --}}
@php
    $examen = config('examen_fisico');
    $examenData = $consulta->examenFisico->pluck('respuesta','punto');
@endphp

<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-6">Examen físico</h3>

    @foreach ($examen as $grupo => $puntos)
        <div class="mb-8">
            <h4 class="font-semibold text-gray-700 mb-4 capitalize">
                {{ str_replace('_', ' ', $grupo) }}
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($puntos as $key => $label)
                    <div>
                        <label class="text-sm text-gray-500 mb-1 block">
                            {{ $label }}
                        </label>

                        <input
                            type="text"
                            name="examen_fisico[{{ $key }}]"
                            class="input w-full"
                            placeholder="Respuesta"
                            value="{{ $examenData[$key] ?? '' }}"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>


{{-- =========================
✅ CHECKLIST
========================= --}}
@php
    $checks = config('examen_fisico_check');
    $checkData = $consulta->examenFisicoCheck->pluck('respuesta','punto');
@endphp

<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-6">
        Examen físico (checklist)
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($checks as $key => $label)
            <div class="flex items-center justify-between bg-gray-50 border rounded-lg p-4">

                <span class="text-sm text-gray-700">
                    {{ $label }}
                </span>

                <select
                    name="examen_fisico_check[{{ $key }}]"
                    class="border-gray-300 rounded text-sm focus:ring-teal-500 focus:border-teal-500"
                >
                    <option value="">—</option>
                    <option value="1"
                        {{ (isset($checkData[$key]) && $checkData[$key]) ? 'selected' : '' }}>
                        Sí
                    </option>
                    <option value="0"
                        {{ (isset($checkData[$key]) && !$checkData[$key]) ? 'selected' : '' }}>
                        No
                    </option>
                </select>

            </div>
        @endforeach
    </div>
</div>

            {{-- 🧠 DIAGNÓSTICO --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Diagnóstico</h3>

                <textarea name="diagnosticos_diferenciales"
                    class="input w-full mb-3"
                    placeholder="Diagnósticos diferenciales">
{{ optional($consulta->diagnostico)->diagnosticos_diferenciales }}
                </textarea>

                <textarea name="diagnostico_definitivo"
                    class="input w-full"
                    placeholder="Diagnóstico definitivo">
{{ optional($consulta->diagnostico)->diagnostico_definitivo }}
                </textarea>
            </div>

            {{-- 💊 MEDICAMENTOS --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Medicamentos</h3>

                <div class="space-y-3">
                    @foreach($consulta->medicamentosAplicados as $i => $med)
                        <div class="grid grid-cols-4 gap-3">
                            <input name="medicamentos[{{ $i }}][medicamento]" value="{{ $med->medicamento }}" class="input">
                            <input name="medicamentos[{{ $i }}][dosis]" value="{{ $med->dosis }}" class="input">
                            <input name="medicamentos[{{ $i }}][frecuencia]" value="{{ $med->frecuencia }}" class="input">
                            <input name="medicamentos[{{ $i }}][periodo]" value="{{ $med->periodo }}" class="input">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ✍️ FIRMA --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Firma</h3>

                @if($consulta->firma)
                    <img src="{{ asset('storage/' . $consulta->firma) }}"
                         class="h-32 border rounded">
                @else
                    <p class="text-gray-400">Sin firma</p>
                @endif
            </div>

            {{-- BOTÓN --}}
            <div class="flex justify-end">
                <button class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg shadow">
                    Actualizar consulta
                </button>
            </div>

        </form>
    </div>
</x-app-layout>