<x-app-layout>
    @php
        $propietario = $paciente->propietario ?? null;
    @endphp

    <div class="max-w-4xl mx-auto p-6">

        <h2 class="text-xl font-bold mb-6">Editar paciente</h2>

        <form method="POST" action="{{ route('pacientes.update', $paciente->id) }}">
            @csrf
            @method('PUT')

            <h3 class="font-semibold mb-2">Propietario</h3>

            <input type="hidden" name="propietario_id" id="propietario_id"
                   value="{{ $propietario->id ?? '' }}">

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="col-span-2 relative">
                    <input
                        id="propietario_nombre"
                        name="propietario_nombre"
                        class="input w-full"
                        value="{{ $propietario->nombre ?? '' }}"
                        autocomplete="off"
                    >

                    <div id="propietario-suggestions"
                        class="absolute bg-white border w-full z-20 hidden"></div>
                </div>

                <input name="propietario_telefono"
                       class="input"
                       value="{{ $propietario->telefono ?? '' }}">

                <input name="propietario_correo"
                       class="input"
                       value="{{ $propietario->correo ?? '' }}">

                <input name="propietario_direccion"
                       class="input"
                       value="{{ $propietario->direccion ?? '' }}">
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded">
                Actualizar paciente
            </button>
        </form>

    </div>
</x-app-layout>