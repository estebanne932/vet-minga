<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                Editar propietario
            </h2>
            <p class="text-gray-500 mt-1">
                Actualiza los datos del dueño de la mascota.
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
            <form method="POST" action="{{ route('propietarios.update', $propietario->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre
                        </label>
                        <input
                            name="nombre"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $propietario->nombre }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Teléfono
                        </label>
                        <input
                            name="telefono"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $propietario->telefono }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Correo
                        </label>
                        <input
                            name="correo"
                            type="email"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $propietario->correo }}"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Dirección
                        </label>
                        <input
                            name="direccion"
                            type="text"
                            class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 transition"
                            value="{{ $propietario->direccion }}"
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
                        Actualizar propietario
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>