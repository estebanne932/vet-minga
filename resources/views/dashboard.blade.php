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

                  {{-- ESTERILIZACIONES --}}
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-plus-icon lucide-shield-plus"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M9 12h6"/><path d="M12 9v6"/></svg>
                        </div>
                    </div>
                </a>


                 {{-- PACIENTES --}}
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



                   {{-- EUTANASIAS --}}
                <a href="{{ route('eutanasias.index') }}"

                   class="group bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-gray-100">

                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Eutanasia
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Nueva consulta y expediente
                            </p>
                        </div>

                        <div class="bg-teal-100 text-teal-600 p-4 rounded-xl 
                                    group-hover:bg-teal-600 group-hover:text-white 
                                    group-hover:scale-110 transform transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-pulse-icon lucide-heart-pulse"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/><path d="M3.22 13H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27"/></svg>
                        </div>
                    </div>
                </a>

                   {{-- CIRUGIAS --}}
                <a href="{{ route('cirugias.index') }}"

                   class="group bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-gray-100">

                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Cirugia
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Nueva consulta y expediente
                            </p>
                        </div>

                        <div class="bg-teal-100 text-teal-600 p-4 rounded-xl 
                                    group-hover:bg-teal-600 group-hover:text-white 
                                    group-hover:scale-110 transform transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase-medical-icon lucide-briefcase-medical"><path d="M12 11v4"/><path d="M14 13h-4"/><path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><path d="M18 6v14"/><path d="M6 6v14"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
                        </div>
                    </div>
                </a>

           

               

            </div>
        </div>
    </div>
</x-app-layout>
