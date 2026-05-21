<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                Editar paciente
            </h2>
            <p class="text-gray-500 mt-1">
                Actualiza la información general de la mascota.
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="POST"
                  action="{{ route('mascotas.update', $mascota->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la mascota
                        </label>
                        <input
                            name="mascota_nombre"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $mascota->nombre }}"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto actual
                        </label>

                        @if($mascota->imagen)
                            <div class="mb-4">
                                <img
                                    src="{{ asset('storage/' . $mascota->imagen) }}"
                                    class="w-32 h-32 object-cover rounded-2xl border border-gray-200 shadow-sm"
                                    alt="Foto de la mascota"
                                >
                            </div>
                        @else
                            <div class="mb-4 w-32 h-32 rounded-2xl bg-gray-100 border border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-sm">
                                Sin foto
                            </div>
                        @endif

                        <input
                            type="file"
                            name="mascota_imagen"
                            class="w-full rounded-xl border border-gray-300 bg-white file:bg-teal-50 file:border-0 file:px-4 file:py-2 file:mr-4 file:text-teal-700 hover:file:bg-teal-100"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer">
                            <input
                                type="checkbox"
                                name="mascota_esterilizado"
                                value="1"
                                class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                {{ $mascota->esterilizado ? 'checked' : '' }}
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
                        <input
                            name="mascota_especie"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $mascota->especie }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Raza
                        </label>
                        <input
                            name="mascota_raza"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $mascota->raza }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Edad
                        </label>
                        <input
                            name="mascota_edad"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $mascota->edad }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Peso
                        </label>
                        <input
                            name="mascota_peso"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $mascota->peso }}"
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
                        Actualizar paciente
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>