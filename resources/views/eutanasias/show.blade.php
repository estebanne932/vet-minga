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
                                Carta de Consentimiento de Eutanasia
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

                            <p class="text-sm text-gray-600">
                                La eutanasia es el acto de permitir la muerte mediante la supresión de medidas médicas extremas y/o aplicar la muerte indolora a un animal que sufre una situación penosa o una enfermedad agónica o incurable o de difícil recuperación utilizando metodos para causar el mínimo dolor y estrés.
                            </p>

                            <p class="text-sm text-gray-600">
                                Asimismo, deja constancia y acepta en forma irrevocable, que le han sido explicados los procesos y conoce la derivación del mismo.
                            </p>

                            <p class="text-sm text-gray-600">
                                Certifica con su firma que ha leído y comprendido la presente autorización, prestando su consentimiento.
                            </p>

                        </div>
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
                                <p class="font-semibold text-gray-800">{{ $eutanasia->veterinario }}</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-500 mb-1">Peso</p>
                                <p class="font-semibold text-gray-800">{{ $eutanasia->peso }} kg</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-500 mb-1">Fecha</p>
                                <p class="font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($eutanasia->fecha)->format('d/m/Y') }}
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
                                @if($eutanasia->consentimiento_firmado)
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                                        <img
                                            src="{{ asset('storage/firmas/' . $eutanasia->consentimiento_firmado) }}"
                                            class="mx-auto h-32 object-contain"
                                            alt="Firma del propietario"
                                        >
                                    </div>
                                @endif

                                <p>Propietario ID: {{ $eutanasia->propietario_id }}</p>
                                <p class="text-sm text-gray-500">
                                    Firma registrada en el consentimiento
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- BOTONES --}}
                    <div class="flex flex-col sm:flex-row justify-center gap-3 pt-2">
                        

                        <a
                            href="{{ route('eutanasias.index') }}"
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