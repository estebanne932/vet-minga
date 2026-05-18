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

                        <div class="bg-teal-100 text-teal-600 p-4 rounded-xl 
                                    group-hover:bg-teal-600 group-hover:text-white 
                                    group-hover:scale-110 transform transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-stethoscope-icon lucide-stethoscope"><path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/></svg>
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

                        <div class="bg-teal-100 text-teal-600 p-4 rounded-xl 
                                    group-hover:bg-teal-600 group-hover:text-white 
                                    group-hover:scale-110 transform transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity-icon lucide-activity"><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/></svg>
                        </div>
                    </div>
                </a>


                 {{-- CONSULTAS --}}
               <a href="{{ route('pacientes.index') }}"
                    class="group bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-gray-100">

                    <div class="flex items-center justify-between">
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Pacientes
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Lista de pacientes y expedientes
                            </p>
                        </div>

                        <div class="bg-teal-100 text-teal-600 p-4 rounded-xl 
                                    group-hover:bg-teal-600 group-hover:text-white 
                                    group-hover:scale-110 transform transition">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cat-icon lucide-cat">
                            <path d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 
                            21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"/><path d="M8 14v.5"/>
                            <path d="M16 14v.5"/><path d="M11.25 16.25h1.5L12 17l-.75-.75Z"/></svg>

                        </div>
                    </div>
                </a>


           

                {{-- MASCOTAS --}}
                <div class="bg-white rounded-xl shadow p-6 opacity-50 cursor-not-allowed">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Eutanasia 
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Próximamente
                    </p>
                </div>

                 {{-- PROPIETARIOS --}}
                <div class="bg-white rounded-xl shadow p-6 opacity-50 cursor-not-allowed">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Cirugias
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Próximamente
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
