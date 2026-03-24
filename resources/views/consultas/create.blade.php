<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-6">Nueva Consulta</h2>

        <form id="consulta-form" method="POST" action="{{ route('consultas.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- PROPIETARIO --}}
            <h3 class="font-semibold mb-2">Propietario</h3>

            <input type="hidden" name="propietario_id" id="propietario_id">

            <div class="relative grid grid-cols-2 gap-4 mb-4">
                <div class="col-span-2 relative">
                    <input
                        id="propietario_nombre"
                        name="propietario_nombre"
                        class="input w-full"
                        placeholder="Nombre del propietario"
                        autocomplete="off"
                    >

                    <div
                        id="propietario-suggestions"
                        class="absolute bg-white border w-full z-20 hidden"
                    ></div>
                </div>

                <input name="propietario_telefono" class="input" placeholder="Teléfono">
                <input name="propietario_correo" class="input" placeholder="Correo">
                <input name="propietario_direccion" class="input" placeholder="Dirección">
            </div>


            {{-- MASCOTA --}}
            <h3 class="font-semibold mb-2">Mascota</h3>

            <input type="hidden" name="mascota_id" id="mascota_id">

            <div class="relative grid grid-cols-2 gap-4 mb-4">
                <div class="col-span-2 relative">
                    <input
                        id="mascota_nombre"
                        name="mascota_nombre"
                        class="input w-full"
                        placeholder="Nombre de la mascota"
                        autocomplete="off"
                    >

                    <div
                        id="mascota-suggestions"
                        class="absolute bg-white border w-full z-20 hidden"
                    ></div>
                </div>

                <div class="col-span-2">
                    <label class="text-sm text-gray-600">Foto de la mascota</label>
                    <input
                        type="file"
                        name="mascota_imagen"
                        accept="image/*"
                        class="input w-full"
                    >
                </div>

                <div class="col-span-2 mt-3">
                    <img
                        id="mascota-preview"
                        src=""
                        alt="Foto de la mascota"
                        class="hidden max-h-48 rounded border object-cover"
                    >
                </div>


                <div class="col-span-2 flex items-center gap-3 mt-2">
                    <input
                        type="checkbox"
                        name="mascota_esterilizado"
                        id="mascota_esterilizado"
                        value="1"
                        class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                    >

                    <label for="mascota_esterilizado" class="text-sm text-gray-700">
                        Mascota esterilizada
                    </label>
                </div>



                <input name="mascota_especie" class="input" placeholder="Especie">
                <input name="mascota_raza" class="input" placeholder="Raza">
                <input name="mascota_edad" class="input" placeholder="Edad">
                <input name="mascota_peso" class="input" placeholder="Peso">
            </div>


            {{-- CONSULTA --}}
            <h3 class="font-semibold mb-2">Consulta</h3>

            <div class="mb-4">
                <textarea name="motivo" class="input w-full" placeholder="Motivo de consulta"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <input type="date" name="fecha" class="input">
                <input name="veterinario" class="input" placeholder="Veterinario">
            </div>

            {{-- EXAMEN FÍSICO --}}
            <h3 class="text-lg font-bold mt-10 mb-4">Examen físico</h3>

            @php
                $examen = config('examen_fisico');
            @endphp

            @foreach ($examen as $grupo => $puntos)
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-700 mb-2 capitalize">
                        {{ str_replace('_', ' ', $grupo) }}
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($puntos as $key => $label)
                            <div>
                                <label class="text-sm text-gray-600 mb-1 block">
                                    {{ $label }}
                                </label>

                                <input
                                    type="text"
                                    name="examen_fisico[{{ $key }}]"
                                    class="input w-full"
                                    placeholder="Respuesta"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- EXAMEN FÍSICO CHECK (SI / NO) --}}
            <h3 class="text-lg font-bold mt-10 mb-4">
                Examen físico (checklist)
            </h3>

            @php
                $checks = config('examen_fisico_check');
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
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
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                @endforeach
            </div>

        @endforeach

        {{-- DIAGNÓSTICO --}}
        <h3 class="text-lg font-bold mt-10 mb-4">Diagnóstico</h3>

        <div class="grid grid-cols-1 gap-6 mb-8">
            <div>
                <label class="text-sm text-gray-600 mb-1 block">
                    Diagnósticos diferenciales
                </label>
                <textarea
                    name="diagnosticos_diferenciales"
                    rows="4"
                    class="input w-full"
                    placeholder="Ej. Gastroenteritis, parasitosis, cuerpo extraño..."
                ></textarea>
            </div>

            <div>
                <label class="text-sm text-gray-600 mb-1 block">
                    Diagnóstico definitivo
                </label>
                <textarea
                    name="diagnostico_definitivo"
                    rows="4"
                    class="input w-full"
                    placeholder="Ej. Gastroenteritis infecciosa"
                ></textarea>
            </div>
        </div>
        
        {{-- MEDICAMENTOS APLICADOS --}}
        <h3 class="text-lg font-bold mt-10 mb-4">Medicamentos aplicados</h3>

        <div id="medicamentos-container" class="space-y-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 medicamento-item">
                <input
                    name="medicamentos[0][medicamento]"
                    class="input"
                    placeholder="Medicamento"
                >

                <input
                    name="medicamentos[0][dosis]"
                    class="input"
                    placeholder="Dosis"
                >

                <input
                    name="medicamentos[0][frecuencia]"
                    class="input"
                    placeholder="Frecuencia"
                >

                <input
                    name="medicamentos[0][periodo]"
                    class="input"
                    placeholder="Periodo"
                >
            </div>
        </div>

        <button
            type="button"
            onclick="agregarMedicamento()"
            class="text-sm text-teal-600 underline"
        >
            + Agregar otro medicamento
        </button>


            {{-- FIRMA --}}
            <h3 class="font-semibold mb-2">Firma del propietario</h3>

            <div class="mb-6">
                <canvas
                    id="signature-pad"
                    class="border rounded w-full h-40 bg-white"
                ></canvas>

                <input type="hidden" name="firma" id="firma">

                <button
                    type="button"
                    onclick="clearSignature()"
                    class="mt-2 text-sm text-gray-600 underline"
                >
                    Limpiar firma
                </button>
            </div>


            <button class="bg-teal-600 text-white px-6 py-2 rounded">
                Guardar consulta
            </button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>

    <script>
            const canvas = document.getElementById('signature-pad');
            const signaturePad = new SignaturePad(canvas);

            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            function clearSignature() {
                signaturePad.clear();
            }

            document
                .getElementById('consulta-form')
                .addEventListener('submit', function () {

                    if (!signaturePad.isEmpty()) {
                        document.getElementById('firma').value =
                            signaturePad.toDataURL('image/png');
                    }
                });


            /* ===============================
        PROPIETARIOS
        ================================ */
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

        /* ===============================
        MASCOTAS
        ================================ */
        const mascotaInput = document.getElementById('mascota_nombre');
        const mascotaIdInput = document.getElementById('mascota_id');
        const mascotaBox = document.getElementById('mascota-suggestions');

        mascotaInput.addEventListener('input', async function () {
            const q = this.value;
            mascotaIdInput.value = '';

            const propietarioId = propietarioIdInput.value;
            if (!propietarioId || q.length < 2) {
                mascotaBox.classList.add('hidden');
                return;
            }

            const res = await fetch(`/buscar/mascotas?q=${q}&propietario_id=${propietarioId}`);
            const data = await res.json();

            mascotaBox.innerHTML = '';
            mascotaBox.classList.remove('hidden');

            data.forEach(m => {
                const div = document.createElement('div');
                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                div.textContent = m.nombre;

               div.onclick = () => {
                    mascotaInput.value = m.nombre;
                    mascotaIdInput.value = m.id;

                    document.querySelector('[name=mascota_especie]').value = m.especie ?? '';
                    document.querySelector('[name=mascota_raza]').value = m.raza ?? '';
                    document.querySelector('[name=mascota_edad]').value = m.edad ?? '';
                    document.querySelector('[name=mascota_peso]').value = m.peso ?? '';

                    document.getElementById('mascota_esterilizado').checked = Boolean(m.esterilizado);

                    const preview = document.getElementById('mascota-preview');
                    if (m.imagen) {
                        preview.src = `/storage/${m.imagen}`;
                        preview.classList.remove('hidden');
                    } else {
                        preview.classList.add('hidden');
                    }

                    mascotaBox.classList.add('hidden');
                };



                mascotaBox.appendChild(div);
            });
        });


        let medicamentoIndex = 1;

        function agregarMedicamento() {
            const container = document.getElementById('medicamentos-container');

            const div = document.createElement('div');
            div.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 medicamento-item';

            div.innerHTML = `
                <input name="medicamentos[${medicamentoIndex}][medicamento]" class="input" placeholder="Medicamento">
                <input name="medicamentos[${medicamentoIndex}][dosis]" class="input" placeholder="Dosis">
                <input name="medicamentos[${medicamentoIndex}][frecuencia]" class="input" placeholder="Frecuencia">
                <input name="medicamentos[${medicamentoIndex}][periodo]" class="input" placeholder="Periodo">
            `;

            container.appendChild(div);
            medicamentoIndex++;
        }
        </script>


    </div>
</x-app-layout>
