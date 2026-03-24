<x-app-layout>

<div class="py-8">

<div class="max-w-5xl mx-auto bg-white shadow rounded-lg">

    <div class="border-b px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Carta de Consentimiento de Esterilización
        </h1>
        <p class="text-sm text-gray-500">
            Complete los datos para registrar el consentimiento quirúrgico.
        </p>
    </div>

    <form action="{{ route('esterilizaciones.store') }}" method="POST" class="p-8 space-y-6">
        @csrf

        <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">
        <input type="hidden" name="propietario_id" value="{{ $propietario->id }}">

        <!-- INFORMACIÓN DEL PROPIETARIO -->
        <div class="bg-gray-50 p-5 rounded border">
            <h3 class="font-semibold text-gray-700 mb-3">
                Información del Propietario
            </h3>

            <p class="text-gray-700">
                Yo, <strong>{{ $propietario->nombre }}</strong>, propietario(a) de la mascota
                <strong>{{ $mascota->nombre }}</strong>,
                especie <strong>{{ $mascota->especie }}</strong>,
                autorizo que sea sometida a cirugía de esterilización.
            </p>

            <p class="text-gray-600 text-sm mt-3">
                La esterilización tiene como finalidad evitar nacimientos no deseados y contribuir al bienestar animal y la salud pública.
            </p>

            <p class="text-gray-600 text-sm mt-2">
                Declaro que mi mascota se encuentra en aparente buen estado de salud y que he sido informado(a) de los riesgos asociados al uso de anestesia general y procedimiento quirúrgico.
            </p>
        </div>

        <!-- DATOS DE LA CIRUGÍA -->
        <div>
            <h2 class="font-semibold text-gray-800 mb-4">
                Datos de la Cirugía
            </h2>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Veterinario
                    </label>
                    <input type="text" name="veterinario"
                        value="{{ old('veterinario') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Tipo de cirugía
                    </label>
                    <select name="tipo"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="OVH">OVH (Hembra)</option>
                        <option value="Orquiectomia">Orquiectomía (Macho)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Peso (kg)
                    </label>
                    <input type="number" step="0.01" name="peso"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Fecha
                    </label>
                    <input type="date" name="fecha"
                        value="{{ now()->format('Y-m-d') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

            </div>
        </div>

        <!-- OBSERVACIONES -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Observaciones
            </label>
            <textarea name="observaciones"
                rows="3"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <!-- FIRMA -->
        <div class="pt-6 text-center">

    <label class="block text-sm font-medium text-gray-600 mb-2">
        Firma del propietario
    </label>

    <div class="border rounded bg-gray-50 inline-block">
        <canvas id="firmaCanvas" width="500" height="200"></canvas>
    </div>

    <input type="hidden" name="firma" id="firma">

    <div class="mt-3">
        <button type="button"
            id="limpiarFirma"
            class="px-3 py-1 bg-gray-500 text-white rounded">
            Limpiar firma
        </button>
    </div>

</div>

        <!-- BOTÓN -->
        <div class="text-center pt-4">
            <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                Guardar y Generar PDF
            </button>
        </div>

    </form>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>

const canvas = document.getElementById('firmaCanvas');
const signaturePad = new SignaturePad(canvas);

const form = document.querySelector('form');
const firmaInput = document.getElementById('firma');

form.addEventListener('submit', function () {

    if (!signaturePad.isEmpty()) {
        firmaInput.value = signaturePad.toDataURL();
    }

});

document.getElementById('limpiarFirma').addEventListener('click', function () {
    signaturePad.clear();
});

</script>

</x-app-layout>
