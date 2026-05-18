
<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-6">Nueva Consulta</h2>

        <form id="consulta-form" method="POST" action="{{ route('consultas.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- PROPIETARIO --}}
            <h3 class="font-semibold mb-2">Propietario</h3>

            <div class="relative grid grid-cols-2 gap-4 mb-4">
                <div class="col-span-2">
                    <label class="text-sm text-gray-700">Propietario</label>

                    <select
                        name="propietario_id"
                        id="propietario_select"
                        class="input w-full"
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

                <div class="col-span-2">
                    <label for="telefono" class="text-sm text-gray-700">Teléfono</label>
                    <input id="telefono" name="propietario_telefono" class="input w-full" type="text">

                    <label for="correo" class="text-sm text-gray-700 mt-2 block">Correo</label>
                    <input id="correo" name="propietario_correo" class="input w-full" type="text">

                    <label for="direccion" class="text-sm text-gray-700 mt-2 block">Dirección</label>
                    <input id="direccion" name="propietario_direccion" class="input w-full" type="text">
                </div>
            </div>



           {{-- MASCOTA --}}
            <h3 class="font-semibold mb-2">Mascota</h3>

            <div class="relative grid grid-cols-2 gap-4 mb-4">
                <div class="col-span-2 relative">
                    <label class="text-sm text-gray-700">Mascota</label>

                    <select
                        id="mascota_select"
                        name="mascota_id"
                        class="input w-full"
                    >
                        <option value="">Selecciona una mascota</option>
                    </select>
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
             @endforeach

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            @foreach ($checks as $key => $label)
            <div class="flex items-center justify-between bg-gray-50 border rounded-lg px-4 py-3">

                <span class="text-sm text-gray-700">
                    {{ $label }}
                </span>

                <div class="flex bg-gray-200 rounded-lg p-1">

                    <!-- NO -->
                    <button type="button"
                        onclick="setCheck('{{ $key }}', 0)"
                        id="btn-no-{{ $key }}"
                        class="px-3 py-1 text-sm rounded-md text-gray-600">
                        No
                    </button>

                    <!-- SI -->
                    <button type="button"
                        onclick="setCheck('{{ $key }}', 1)"
                        id="btn-si-{{ $key }}"
                        class="px-3 py-1 text-sm rounded-md text-gray-600">
                        Sí
                    </button>

                </div>

                <input type="hidden" name="examen_fisico_check[{{ $key }}]" id="input-{{ $key }}">

            </div>
            @endforeach

        </div>


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

                <button type="button" onclick="clearSignature()" class="mt-2 text-sm text-gray-600 underline">
                    Limpiar firma
                </button>
            </div>


            <button class="bg-teal-600 text-white px-6 py-2 rounded">
                Guardar consulta
            </button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const propietarioSelect = document.getElementById('propietario_select');

            if (propietarioSelect) {
                propietarioSelect.addEventListener('change', function () {
                    const option = this.options[this.selectedIndex];
                    document.getElementById('telefono').value = option?.dataset.telefono || '';
                    document.getElementById('correo').value = option?.dataset.correo || '';
                    document.getElementById('direccion').value = option?.dataset.direccion || '';
                });
            }

            const canvas = document.getElementById('signature-pad');
            let signaturePad = null;

            if (canvas && typeof SignaturePad !== 'undefined') {
                signaturePad = new SignaturePad(canvas);

                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext('2d').scale(ratio, ratio);
                }

                window.addEventListener('resize', resizeCanvas);
                resizeCanvas();

                window.clearSignature = function () {
                    signaturePad.clear();
                };
            }

            const form = document.getElementById('consulta-form');
            if (form && signaturePad) {
                form.addEventListener('submit', function () {
                    if (!signaturePad.isEmpty()) {
                        document.getElementById('firma').value = signaturePad.toDataURL('image/png');
                    }
                });
            }

            let medicamentoIndex = 1;

            window.agregarMedicamento = function () {
                const container = document.getElementById('medicamentos-container');
                if (!container) return;

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
            };
        });
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

        document.addEventListener('DOMContentLoaded', function () {

    const propietarioSelect = document.getElementById('propietario_select');
    const mascotaSelect = document.getElementById('mascota_select');

    // =========================================
    // CARGAR MASCOTAS DEL PROPIETARIO
    // =========================================
    if (propietarioSelect && mascotaSelect) {

        propietarioSelect.addEventListener('change', async function () {

            const option = this.options[this.selectedIndex];

            // DATOS DEL PROPIETARIO
            document.getElementById('telefono').value =
                option?.dataset.telefono || '';

            document.getElementById('correo').value =
                option?.dataset.correo || '';

            document.getElementById('direccion').value =
                option?.dataset.direccion || '';

            // LIMPIAR SELECT
            mascotaSelect.innerHTML =
                '<option value="">Cargando mascotas...</option>';

            // SI NO HAY PROPIETARIO
            if (!this.value) {

                mascotaSelect.innerHTML =
                    '<option value="">Selecciona una mascota</option>';

                limpiarDatosMascota();

                return;
            }

            try {

                const res =
                    await fetch(`/propietarios/${this.value}/mascotas`);

                const mascotas = await res.json();

                mascotaSelect.innerHTML =
                    '<option value="">Selecciona una mascota</option>';

                mascotas.forEach(mascota => {

                    const opt = document.createElement('option');

                    opt.value = mascota.id;
                    opt.textContent = mascota.nombre;

                    opt.dataset.especie =
                        mascota.especie || '';

                    opt.dataset.raza =
                        mascota.raza || '';

                    opt.dataset.edad =
                        mascota.edad || '';

                    opt.dataset.peso =
                        mascota.peso || '';

                    opt.dataset.esterilizado =
                        mascota.esterilizado ? 1 : 0;

                    opt.dataset.imagen =
                        mascota.imagen || '';

                    mascotaSelect.appendChild(opt);
                });

            } catch (error) {

                console.error(error);

                mascotaSelect.innerHTML =
                    '<option value="">Error al cargar mascotas</option>';
            }
        });
    }

    // =========================================
    // AUTOLLENAR DATOS DE MASCOTA
    // =========================================
    if (mascotaSelect) {

        mascotaSelect.addEventListener('change', function () {

            const option = this.options[this.selectedIndex];

            document.querySelector('[name=mascota_especie]').value =
                option?.dataset.especie || '';

            document.querySelector('[name=mascota_raza]').value =
                option?.dataset.raza || '';

            document.querySelector('[name=mascota_edad]').value =
                option?.dataset.edad || '';

            document.querySelector('[name=mascota_peso]').value =
                option?.dataset.peso || '';

            document.getElementById('mascota_esterilizado').checked =
                option?.dataset.esterilizado == 1;

            const preview =
                document.getElementById('mascota-preview');

            if (option?.dataset.imagen) {

                preview.src =
                    `/storage/${option.dataset.imagen}`;

                preview.classList.remove('hidden');

            } else {

                preview.src = '';

                preview.classList.add('hidden');
            }
        });
    }

    // =========================================
    // LIMPIAR DATOS
    // =========================================
    function limpiarDatosMascota() {

        document.querySelector('[name=mascota_especie]').value = '';

        document.querySelector('[name=mascota_raza]').value = '';

        document.querySelector('[name=mascota_edad]').value = '';

        document.querySelector('[name=mascota_peso]').value = '';

        document.getElementById('mascota_esterilizado').checked = false;

        const preview =
            document.getElementById('mascota-preview');

        preview.src = '';

        preview.classList.add('hidden');
    }

});
        </script>

    </div>
</x-app-layout>
