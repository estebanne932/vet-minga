<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">

                {{-- ENCABEZADO --}}
                <div class="bg-gradient-to-r from-cyan-600 to-teal-600 px-8 py-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-white/20 text-white flex items-center justify-center">
                            <i class="bi bi-file-earmark-text-fill text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">
                                Carta de Consentimiento de Esterilización
                            </h1>
                            <p class="text-sm text-cyan-100 mt-1">
                                Documento generado
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-8 space-y-8">

                    {{-- TEXTO PRINCIPAL --}}
                    <section class="bg-cyan-50 border border-cyan-100 rounded-2xl p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-full bg-cyan-600 text-white flex items-center justify-center">
                                <i class="bi bi-person-fill text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Información del consentimiento
                            </h2>
                        </div>

                        <div class="text-gray-700 text-justify leading-7 space-y-4">
                            <p>
                                Yo, <strong>{{ $esterilizacion->propietario->nombre }}</strong>,
                                propietario(a) de la mascota <strong>{{ $esterilizacion->mascota->nombre }}</strong>,
                                especie <strong>{{ $esterilizacion->mascota->especie }}</strong>,
                                autorizo que sea sometida a cirugía de esterilización.
                            </p>

                            <p>
                                La esterilización tiene como finalidad evitar nacimientos no deseados y contribuir al bienestar animal y la salud pública.
                            </p>

                            <p>
                                El uso de anestesia general y procedimiento quirúrgico implica un riesgo, por lo cual la cirugía se realiza a pacientes sanos.
                            </p>

                            <p>
                                Por lo anterior y una vez informado(a), autorizo que mi mascota sea sometida a cirugía de esterilización.
                            </p>
                        </div>
                    </section>

                    {{-- RIESGOS --}}
                    <section class="bg-white border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center">
                                <i class="bi bi-exclamation-triangle-fill text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Riesgos de la cirugía
                            </h2>
                        </div>

                        <ul class="list-decimal pl-5 text-gray-700 space-y-2 text-sm leading-6">
                            <li>El uso de anestesia implica riesgos.</li>
                            <li>No se realizan estudios preoperatorios.</li>
                            <li>No se opera si ha ingerido alimentos recientes.</li>
                            <li>No se operan hembras gestantes o en celo.</li>
                            <li>El éxito depende de cuidados postoperatorios.</li>
                        </ul>
                    </section>

                    {{-- DATOS --}}
                    <section class="bg-gray-50 border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center">
                                <i class="bi bi-clipboard2-pulse-fill text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Datos de la cirugía
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-500 mb-1">Veterinario</p>
                                <p class="font-semibold text-gray-800">{{ $esterilizacion->veterinario }}</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-500 mb-1">Tipo</p>
                                <p class="font-semibold text-gray-800">{{ $esterilizacion->tipo }}</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-500 mb-1">Peso</p>
                                <p class="font-semibold text-gray-800">{{ $esterilizacion->peso }} kg</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-500 mb-1">Fecha</p>
                                <p class="font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($esterilizacion->fecha)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- FIRMA --}}
                    <section class="pt-2">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                                <i class="bi bi-pen-fill text-lg"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Firma del propietario
                            </h2>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex flex-col items-center">
                                @if($esterilizacion->consentimiento_firmado)
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                                        <img
                                            src="{{ asset('storage/firmas/' . $esterilizacion->consentimiento_firmado) }}"
                                            class="mx-auto h-32 object-contain"
                                            alt="Firma del propietario"
                                        >
                                    </div>
                                @endif

                                <p class="mt-4 font-semibold text-gray-800">
                                    {{ $esterilizacion->propietario->nombre }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Firma registrada en el consentimiento
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- BOTONES --}}
                    <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2">
                        <a
                            href="{{ route('esterilizaciones.pdf', $esterilizacion) }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-emerald-600 text-white shadow-lg hover:bg-emerald-700 hover:scale-105 transition-all duration-200"
                        >
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            Descargar PDF
                        </a>

                        <a
                            href="{{ route('esterilizaciones.index') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-gray-600 text-white shadow-lg hover:bg-gray-700 hover:scale-105 transition-all duration-200"
                        >
                            <i class="bi bi-arrow-left-circle-fill"></i>
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>