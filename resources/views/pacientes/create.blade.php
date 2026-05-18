<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        <h2 class="text-xl font-bold mb-6">Nuevo paciente</h2>

        <form method="POST" action="{{ route('pacientes.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- 🧍‍♂️ PROPIETARIO --}}
            <h3 class="font-semibold mb-2">Propietario</h3>

            <input type="hidden" name="propietario_id" id="propietario_id">

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="col-span-2 relative">
                    <input
                        id="propietario_nombre"
                        name="propietario_nombre"
                        class="input w-full"
                        placeholder="Nombre del propietario"
                        autocomplete="off"
                    >

                    <div id="propietario-suggestions"
                        class="absolute bg-white border w-full z-20 hidden"></div>
                </div>

                <input name="propietario_telefono" class="input" placeholder="Teléfono">
                <input name="propietario_correo" class="input" placeholder="Correo">
                <input name="propietario_direccion" class="input" placeholder="Dirección">
            </div>

            {{-- 🐶 MASCOTA --}}
            <h3 class="font-semibold mb-2">Mascota</h3>

            <div class="grid grid-cols-2 gap-4 mb-6">

                <div class="col-span-2">
                    <input
                        name="mascota_nombre"
                        class="input w-full"
                        placeholder="Nombre de la mascota"
                    >
                </div>

                <div class="col-span-2">
                    <label class="text-sm text-gray-600">Foto</label>
                    <input type="file" name="mascota_imagen" class="input w-full">
                </div>

                <div class="col-span-2 flex items-center gap-3">
                    <input type="checkbox" name="mascota_esterilizado" value="1">
                    <label class="text-sm">Esterilizado</label>
                </div>

                <input name="mascota_especie" class="input" placeholder="Especie">
                <input name="mascota_raza" class="input" placeholder="Raza">
                <input name="mascota_edad" class="input" placeholder="Edad">
                <input name="mascota_peso" class="input" placeholder="Peso">
            </div>

            <button class="bg-teal-600 text-white px-6 py-2 rounded">
                Guardar paciente
            </button>
        </form>

    </div>

    {{-- 🔥 AUTOCOMPLETE (REUTILIZADO) --}}
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