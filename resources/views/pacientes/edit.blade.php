<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        <h2 class="text-xl font-bold mb-6">Editar paciente</h2>

        <form method="POST"
              action="{{ route('pacientes.update', $paciente) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- 🧍‍♂️ PROPIETARIO --}}
            <h3 class="font-semibold mb-2">Propietario</h3>

            <input type="hidden" name="propietario_id" id="propietario_id"
                   value="{{ $paciente->propietario->id }}">

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="col-span-2 relative">
                    <input
                        id="propietario_nombre"
                        name="propietario_nombre"
                        class="input w-full"
                        value="{{ $paciente->propietario->nombre }}"
                        autocomplete="off"
                    >

                    <div id="propietario-suggestions"
                        class="absolute bg-white border w-full z-20 hidden"></div>
                </div>

                <input name="propietario_telefono"
                       class="input"
                       value="{{ $paciente->propietario->telefono }}">

                <input name="propietario_correo"
                       class="input"
                       value="{{ $paciente->propietario->correo }}">

                <input name="propietario_direccion"
                       class="input"
                       value="{{ $paciente->propietario->direccion }}">
            </div>

            {{-- 🐶 MASCOTA --}}
            <h3 class="font-semibold mb-2">Mascota</h3>

            <div class="grid grid-cols-2 gap-4 mb-6">

                <div class="col-span-2">
                    <input
                        name="mascota_nombre"
                        class="input w-full"
                        value="{{ $paciente->nombre }}"
                    >
                </div>

                {{-- 🖼️ Imagen actual --}}
                <div class="col-span-2">
                    <label class="text-sm text-gray-600">Foto actual</label>

                    @if($paciente->imagen)
                        <img
                            src="{{ asset('storage/' . $paciente->imagen) }}"
                            class="w-32 h-32 object-cover rounded mb-2"
                        >
                    @endif

                    <input type="file" name="mascota_imagen" class="input w-full">
                </div>

                <div class="col-span-2 flex items-center gap-3">
                    <input type="checkbox"
                           name="mascota_esterilizado"
                           value="1"
                           {{ $paciente->esterilizado ? 'checked' : '' }}>
                    <label class="text-sm">Esterilizado</label>
                </div>

                <input name="mascota_especie"
                       class="input"
                       value="{{ $paciente->especie }}">

                <input name="mascota_raza"
                       class="input"
                       value="{{ $paciente->raza }}">

                <input name="mascota_edad"
                       class="input"
                       value="{{ $paciente->edad }}">

                <input name="mascota_peso"
                       class="input"
                       value="{{ $paciente->peso }}">
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded">
                Actualizar paciente
            </button>
        </form>

    </div>

    {{-- 🔥 AUTOCOMPLETE (igual que create) --}}
    <script>
        const propietarioInput = document.getElementById('propietario_nombre');
        const propietarioIdInput = document.getElementById('propietario_id');
        const propietarioBox = document.getElementById('propietario-suggestions');

        propietarioInput.addEventListener('input', async function () {
            const q = this.value;
            propietarioIdInput.value = '';

            if (q.length < 2) {
                propietarioBox.classList.add('hidden');
                return;
            }

            const res = await fetch(`/buscar/propietarios?q=${q}`);
            const data = await res.json();

            propietarioBox.innerHTML = '';
            propietarioBox.classList.remove('hidden');

            data.forEach(p => {
                const div = document.createElement('div');
                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                div.textContent = p.nombre;

                div.onclick = () => {
                    propietarioInput.value = p.nombre;
                    propietarioIdInput.value = p.id;

                    document.querySelector('[name=propietario_telefono]').value = p.telefono ?? '';
                    document.querySelector('[name=propietario_correo]').value = p.correo ?? '';
                    document.querySelector('[name=propietario_direccion]').value = p.direccion ?? '';

                    propietarioBox.classList.add('hidden');
                };

                propietarioBox.appendChild(div);
            });
        });
    </script>

</x-app-layout>