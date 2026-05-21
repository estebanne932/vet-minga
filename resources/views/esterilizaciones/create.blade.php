<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                
                {{-- ENCABEZADO --}}
                <div class="bg-gradient-to-r from-cyan-600 to-teal-600 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white">
                        Carta de Consentimiento de Esterilización
                    </h1>
                    <p class="text-sm text-cyan-100 mt-1">
                        Complete los datos para registrar el consentimiento quirúrgico.
                    </p>
                </div>

                <form id="formEsterilizacion" action="{{ route('esterilizaciones.store') }}" method="POST" class="p-8 space-y-8">
                    @csrf

                    <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">
                    <input type="hidden" name="propietario_id" value="{{ $propietario->id }}">

                    {{-- INFORMACIÓN DEL PROPIETARIO --}}
                    <div class="bg-cyan-50 rounded-2xl p-6 border border-cyan-100">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-full bg-cyan-600 text-white flex items-center justify-center">
                                <i class="bi bi-person-fill text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Información del Propietario
                            </h3>
                        </div>

                        <div class="space-y-4 text-gray-700 leading-relaxed">
                            <p>
                                Yo, <strong>{{ $propietario->nombre }}</strong>, propietario(a) de la mascota
                                <strong>{{ $mascota->nombre }}</strong>,
                                especie <strong>{{ $mascota->especie }}</strong>,
                                autorizo que sea sometida a cirugía de esterilización.
                            </p>

                            <p class="text-sm text-gray-600">
                                La esterilización tiene como finalidad evitar nacimientos no deseados y contribuir al bienestar animal y la salud pública.
                            </p>

                            <p class="text-sm text-gray-600">
                                Los dueños responsables evitan así el nacimiento de mascotas que tienen como destino deambular en la vía pública, además de sufrir hambre y malos tratos, además de representar riesgo a la salud pública por las agresiones que puedan ocasionar y la posible trasmisión de rabia.
                            </p>

                            <p class="text-sm text-gray-600">
                                La esterilización de las hembras (OVH) consiste en retirar los dos ovarios y cuernos uterinos y en los machos se retiran los testículos, con lo cual ya no presentan celo.
                            </p>

                            <p class="text-sm text-gray-600">
                                El uso de anestesia general y procedimiento quirúrgico implica un riesgo, por lo cual la cirugía de esterilización se realiza a pacientes sanos, en esta campaña no se realizan exámenes preoperatorios, por lo que si su mascota presenta algún signo de enfermedad o sospecha que está embarazada notifíquelo al veterinario responsable del programa.
                            </p>

                            <p class="text-sm text-gray-600">
                                Dando por hecho que se presenta a la mascota sana, se exime de toda responsabilidad a los médicos que realizan la cirugía. Por lo anterior y una vez informado (a) autorizo que mi mascota sea sometida a cirugía de esterilización.
                            </p>
                        </div>

                        <div class="mt-6 bg-white rounded-xl p-5 border border-cyan-100">
                            <h4 class="font-semibold text-gray-800 mb-3">
                                Riesgos de la cirugía
                            </h4>

                            <ul class="space-y-2 text-sm text-gray-600 list-disc pl-5">
                                <li>En el Quirófano Móvil no se realizan pre anestésico ni médicos, como exámenes sanguíneos, cardiacos, hepáticos, renales, temperatura, etc; por lo cual no podemos tener conocimientos de la salud del paciente. Por ello el uso de anestésicos y demás medicamentos queda bajo autorización del propietario.</li>
                                <li>El uso de cualquier anestésico o medicamente implica un riesgo, y no sabemos cómo pueda reaccionar el organismo.</li>
                                <li>No se realizará cirugía a pacientes que hayan ingerido agua o alimento dentro de las 10 horas anteriores a la cirugía.</li>
                                <li>El no comentar al médico sobre la ingesta queda bajo la responsabilidad del propietario.</li>
                                <li>La cirugía es a partir de los 6 meses de edad no antes.</li>
                                <li>No se realizará cirugía a hembras gestantes ni lactantes. Ni a hembras ni machos en celo.</li>
                                <li>El éxito de la cirugía dependerá de los cuidados postoperatorios (estos corresponden a los propietarios).</li>
                            </ul>
                        </div>
                    </div>

                    {{-- DATOS DE LA CIRUGÍA --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center">
                                <i class="bi bi-clipboard2-pulse-fill text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Datos de la Cirugía
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Veterinario
                                </label>
                                <input type="text" name="veterinario"
                                    value="Valeria Mingura Gamboa"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-cyan-500 focus:border-cyan-500 bg-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipo de cirugía
                                </label>
                                <select name="tipo"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-cyan-500 focus:border-cyan-500 bg-white">
                                    <option value="OVH">OVH (Hembra)</option>
                                    <option value="Orquiectomia">Orquiectomía (Macho)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Peso (kg)
                                </label>
                                <input type="number" step="0.01" name="peso"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-cyan-500 focus:border-cyan-500 bg-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha
                                </label>
                                <input type="date" name="fecha"
                                    value="{{ now()->format('Y-m-d') }}"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-cyan-500 focus:border-cyan-500 bg-white">
                            </div>
                        </div>
                    </div>

                    {{-- OBSERVACIONES --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Observaciones
                        </label>
                        <textarea name="observaciones"
                            rows="4"
                            class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-cyan-500 focus:border-cyan-500 bg-white resize-none"></textarea>
                    </div>

                    {{-- FIRMA --}}
                    <div class="pt-2">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center">
                                <i class="bi bi-pen-fill text-lg"></i>
                            </div>
                            <label class="block text-sm font-semibold text-gray-700">
                                Firma del propietario
                            </label>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4">
                            <div class="flex justify-center">
                                <div class="border border-gray-300 rounded-xl bg-white shadow-sm overflow-hidden">
                                    <canvas id="firmaCanvas" width="500" height="200" class="block"></canvas>
                                </div>
                            </div>

                            <input type="hidden" name="consentimiento_firmado" id="firma">

                            <div class="mt-4 flex justify-center">
                                <button type="button"
                                    id="limpiarFirma"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-full shadow-sm hover:bg-gray-700 transition">
                                    <i class="bi bi-eraser-fill"></i>
                                    Limpiar firma
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- BOTÓN --}}
                    <div class="pt-4 flex justify-center">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-cyan-600 text-white rounded-full shadow-lg hover:bg-cyan-700 hover:scale-105 transition-all duration-200">
                            <i class="bi bi-file-earmark-pdf-fill text-lg"></i>
                            Guardar y Generar PDF
                        </button>
                    </div>
                </form>
            </div>
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
