<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">

        {{-- HEADER --}}
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                Nuevo paciente
            </h2>

            <p class="text-gray-500 mt-1">
                Registra la información del propietario y la mascota.
            </p>
        </div>

        <form method="POST" action="{{ route('pacientes.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- =========================
                PROPIETARIO
            ========================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">

                <div class="flex items-center gap-2 mb-6">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center">
                        👤
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Propietario
                        </h3>

                        <p class="text-sm text-gray-500">
                            Datos de contacto del dueño de la mascota.
                        </p>
                    </div>
                </div>

                <input type="hidden" name="propietario_id" id="propietario_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Nombre --}}
                    <div class="md:col-span-2 relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre del propietario
                        </label>

                        <input
                            id="propietario_nombre"
                            name="propietario_nombre"
                            type="text"
                            autocomplete="off"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >

                        <div
                            id="propietario-suggestions"
                            class="absolute mt-2 bg-white border border-gray-200 rounded-xl shadow-lg w-full z-20 hidden overflow-hidden"
                        ></div>
                    </div>

                    {{-- Teléfono --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Teléfono
                        </label>

                        <input
                            name="propietario_telefono"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                    {{-- Correo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Correo electrónico
                        </label>

                        <input
                            name="propietario_correo"
                            type="email"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                    {{-- Dirección --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Dirección
                        </label>

                        <input
                            name="propietario_direccion"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                </div>
            </div>

            {{-- =========================
                MASCOTA
            ========================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">

                <div class="flex items-center gap-2 mb-6">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center">
                        🐾
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Mascota
                        </h3>

                        <p class="text-sm text-gray-500">
                            Información general del paciente.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Nombre mascota --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la mascota
                        </label>

                        <input
                            name="mascota_nombre"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                    {{-- Imagen --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto de la mascota
                        </label>

                        <input
                            type="file"
                            name="mascota_imagen"
                            class="w-full rounded-xl border border-gray-300 bg-white file:bg-teal-50 file:border-0 file:px-4 file:py-2 file:mr-4 file:text-teal-700 hover:file:bg-teal-100"
                        >
                    </div>

                    {{-- Esterilizado --}}
                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer">
                            <input
                                type="checkbox"
                                name="mascota_esterilizado"
                                value="1"
                                class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                            >

                            <span class="text-sm font-medium text-gray-700">
                                Mascota esterilizada
                            </span>
                        </label>
                    </div>

                    {{-- Especie --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
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

                    {{-- Raza --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Raza
                        </label>

                        <input
                            name="mascota_raza"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                    {{-- Edad --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Edad
                        </label>

                        <input
                            name="mascota_edad"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                    {{-- Peso --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Peso
                        </label>

                        <input
                            name="mascota_peso"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                        >
                    </div>

                </div>
            </div>

            {{-- BOTÓN --}}
            <div class="flex justify-end">
                <button
                    class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-8 py-3 rounded-xl shadow-sm transition"
                >
                    Guardar paciente
                </button>
            </div>

        </form>

    </div>

    {{-- 🔥 AUTOCOMPLETE --}}
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

                div.className =
                    'px-4 py-3 hover:bg-gray-50 cursor-pointer border-b last:border-b-0';

                div.innerHTML = `
                    <div class="font-medium text-gray-800">${p.nombre}</div>
                    <div class="text-sm text-gray-500">${p.telefono ?? ''}</div>
                `;

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

