<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Panel de control
        </h2>
        <p class="text-sm text-gray-500">
            Bienvenido al sistema de la clínica
        </p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- CONSULTAS --}}
                <a href="{{ route('consultas.index') }}"

                   class="group bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-gray-100">

                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Consultas
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Nueva consulta y expediente
                            </p>
                        </div>

                        <div class="bg-teal-100 text-teal-600 p-3 rounded-full group-hover:bg-teal-600 group-hover:text-white transition">
                            🩺
                        </div>
                    </div>
                </a>

                  {{-- CONSULTAS --}}
                <a href="{{ route('esterilizaciones.index') }}"

                   class="group bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-gray-100">

                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Esterilizaciones
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Nueva consulta y expediente
                            </p>
                        </div>

                        <div class="bg-teal-100 text-teal-600 p-3 rounded-full group-hover:bg-teal-600 group-hover:text-white transition">
                            🩺
                        </div>
                    </div>
                </a>



                {{-- MASCOTAS --}}
                <a href="{{ route('esterilizaciones.index') }}">
                <div class="bg-white rounded-xl shadow p-6 opacity-50 cursor-not-allowed">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Pacientes
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Próximamente
                    </p>
                </div>
                </a>

                {{-- MASCOTAS --}}
                <div class="bg-white rounded-xl shadow p-6 opacity-50 cursor-not-allowed">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Esterilizaciones
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Próximamente
                    </p>
                </div>

                {{-- PROPIETARIOS --}}
                <div class="bg-white rounded-xl shadow p-6 opacity-50 cursor-not-allowed">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Diagnosticos
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Próximamente
                    </p>
                </div>

                 {{-- PROPIETARIOS --}}
                <div class="bg-white rounded-xl shadow p-6 opacity-50 cursor-not-allowed">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Cirujias
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Próximamente
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
