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

    <form id="formEsterilizacion" action="{{ route('esterilizaciones.store') }}" method="POST" class="p-8 space-y-6">
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
                Los dueños responsables evitan así el nacimiento de mascotas que tienen como destino deambular en la vía pública, además de sufrir hambre y malos tratos, además de representar riesgo a la salud pública por las agresiones que puedan ocasionar y la posible trasmisión de rabia. 
            </p>

            <p class="text-gray-600 text-sm mt-2">
                La esterilización de las hembras (OVH) consiste en retirar los dos ovarios y cuernos uterinos y en los machos se retiran los testículos, con lo cual ya no presentan celo. 
            </p>

            <p class="text-gray-600 text-sm mt-2">  
                El uso de anestesia general y procedimiento quirúrgico implica un riesgo, por lo cual la cirugía de esterilización se realiza a pacientes sanos, en esta campaña no se realizan exámenes preoperatorios, por lo que si su mascota presenta algún signo de enfermedad o sospecha que está embarazada notifíquelo al veterinario responsable del programa. 
            </p>

            <p class="text-gray-600 text-sm mt-2">
                Dando por hecho que se presenta a la mascota sana, se exime de toda responsabilidad a los médicos que realizan la cirugía. Por lo anterior y una vez informado (a) autorizo que mi mascota sea sometida a cirugía de esterilización.
            </p>

            <br>
            <h1>Riesgos de la cirugia</h1>

            <ul>
                <li>1.- En el Quirófano Móvil no se realizan pre anestésico ni médicos, como exámenes sanguíneos, cardiacos, hepáticos, renales, temperatura, etc; por lo cual no podemos tener conocimientos de la salud del paciente. Por ello el uso de anestésicos y demás medicamentos queda bajo autorización del propietario. </li>
                <li>2.- El uso de cualquier anestésico o medicamente implica un riesgo, y no sabemos cómo pueda reaccionar el organismo. </li>
                <li>3.- No se realizará cirugía a pacientes que hayan ingerido agua o alimento dentro de las 10 horas anteriores a la cirugía. </li>
                <li>4.- El no comentar al médico sobre la ingesta queda bajo la responsabilidad del propietario. </li>
                <li>5.- La cirugía es a partir de los 6 meses de edad no antes. </li>
                <li>6.- No se realizará cirugía a hembras gestantes ni lactantes. Ni a hembras ni machos en celo. </li>
                <li>7.- El éxito de la cirugía dependerá de los cuidados postoperatorios (estos corresponden a los propietarios) </li>
            </ul>

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
                        value="Valeria Mingura Gamboa"
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

  
    <input type="hidden" name="consentimiento_firmado" id="firma">

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
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('firmaCanvas');
    const signaturePad = new SignaturePad(canvas);

    const form = document.getElementById('formEsterilizacion');
    const firmaInput = document.getElementById('firma');

    form.addEventListener('submit', function (e) {

        if (signaturePad.isEmpty()) {
            alert('Debes firmar antes de guardar');
            e.preventDefault();
            return;
        }

        const firmaData = signaturePad.toDataURL();

        console.log('FIRMA:', firmaData); // 👈 ahora sí debe aparecer

        firmaInput.value = firmaData;
    });

    document.getElementById('limpiarFirma').addEventListener('click', function () {
        signaturePad.clear();
    });

});
</script>

</x-app-layout>
