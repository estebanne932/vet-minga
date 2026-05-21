<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                Agregar mascota
            </h2>
            <p class="text-gray-500 mt-1">
                Registra una nueva mascota para
                <span class="font-semibold text-teal-600">
                    {{ $propietario->nombre }}
                </span>
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="POST"
                  action="{{ route('propietarios.mascotas.store', $propietario->id) }}"
                  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="propietario_id" value="{{ $propietario->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la mascota
                        </label>
                        <input
                            type="text"
                            name="mascota_nombre"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ old('mascota_nombre') }}"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto
                        </label>
                        <input
                            type="file"
                            name="mascota_imagen"
                            class="w-full rounded-xl border border-gray-300 bg-white
                                   file:bg-teal-50 file:border-0 file:px-4 file:py-2
                                   file:mr-4 file:text-teal-700 hover:file:bg-teal-100"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer">
                            <input
                                type="checkbox"
                                name="mascota_esterilizado"
                                value="1"
                                class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                {{ old('mascota_esterilizado') ? 'checked' : '' }}
                            >
                            <span class="text-sm font-medium text-gray-700">
                                Esterilizado
                            </span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Especie
                        </label>
                         <select
                            name="mascota_especie"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700
                                focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition"
                        >
                            <option value="">Selecciona una especie</option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Raza
                        </label>
                        <input
                            type="text"
                            name="mascota_raza"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ old('mascota_raza') }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Edad
                        </label>
                        <input
                            type="number"
                            name="mascota_edad"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ old('mascota_edad') }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Peso
                        </label>
                        <input
                            type="text"
                            name="mascota_peso"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ old('mascota_peso') }}"
                        >
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a
                        href="{{ route('pacientes.index') }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-xl bg-teal-600 text-white font-medium hover:bg-teal-700 shadow-sm transition"
                    >
                        Guardar mascota
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>