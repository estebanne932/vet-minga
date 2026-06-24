<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="fixed bottom-6 right-6 z-50">
            <a
                href="{{ route('pacientes.create') }}"
                class="w-16 h-16 flex items-center justify-center rounded-full bg-teal-600 text-white shadow-xl hover:bg-teal-700 hover:scale-110 transition-all duration-200"
                title="Nuevo paciente"
            >
                <i class="bi bi-plus-lg text-2xl"></i>
            </a>
        </div>

        {{-- 👤 PROPIETARIOS --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

    {{-- PROPIETARIOS --}}
    <div class="lg:col-span-4">

        <div class="bg-white rounded-2xl shadow-lg p-5">

            <h3 class="text-xl font-bold mb-4">
                Propietarios
            </h3>

            <div class="mb-4">
                <input
                    id="buscarPropietario"
                    type="text"
                    placeholder="Buscar propietario..."
                    class="w-full rounded-xl border-gray-300 focus:ring-teal-500 focus:border-teal-500"
                >
            </div>

            <div class="space-y-3 max-h-[700px] overflow-y-auto">

                @foreach($propietarios as $propietario)

                    <div class="propietario-card border rounded-xl p-4 hover:bg-teal-50 cursor-pointer transition" data-nombre="{{ strtolower($propietario->nombre) }}">

                       <div class="flex justify-between items-start">

    <div>

        <h4 class="font-semibold text-gray-800">
            {{ $propietario->nombre }}
        </h4>

        <p class="text-sm text-gray-500">
            {{ $propietario->telefono }}
        </p>

        <div class="flex gap-2 mt-3">

            {{-- EDITAR PROPIETARIO --}}
            <a
                href="{{ route('propietarios.edit', $propietario->id) }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition"
                title="Editar propietario"
            >
                <i class="bi bi-pencil-fill"></i>
            </a>

            {{-- AGREGAR MASCOTA --}}
            <a
                href="{{ route('propietarios.mascotas.create', $propietario->id) }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 hover:bg-emerald-600 hover:text-white transition"
                title="Agregar mascota"
            >
                <i class="bi bi-plus-lg"></i>
            </a>

        </div>

    </div>

    <span class="bg-teal-100 text-teal-700 text-xs px-3 py-1 rounded-full">
        {{ $propietario->mascotas->count() }}
    </span>

</div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    {{-- MASCOTAS --}}
    <div class="lg:col-span-8">

        <div class="bg-white rounded-2xl shadow-lg p-5">

            <div class="flex justify-between items-center mb-4">

                <div>
                    <h3 class="text-xl font-bold">
                        Mascotas
                    </h3>

                    <p class="text-sm text-gray-500">
                        Pacientes registrados
                    </p>
                </div>

                <div class="w-72">
                    <input
                            id="buscarMascota"
                            type="text"
                            placeholder="Buscar mascota..."
                            class="w-full rounded-xl border-gray-300"
                        >
                </div>

            </div>

            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">

                @foreach($mascotas as $mascota)

                    <div class="mascota-card border rounded-2xl p-4 hover:shadow-lg transition" data-nombre="{{ strtolower($mascota->nombre) }}">

                        <div class="flex items-center gap-3">

                            @if($mascota->imagen)
                                <img
                                    src="{{ asset('storage/'.$mascota->imagen) }}"
                                    class="w-16 h-16 rounded-full object-cover"
                                >
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                                    {{ strtoupper(substr($mascota->nombre,0,1)) }}
                                </div>
                            @endif

                            <div>
                                <h4 class="font-semibold">
                                    {{ $mascota->nombre }}
                                </h4>

                                <p class="text-sm text-gray-500">
                                    {{ $mascota->especie }}
                                </p>
                            </div>

                        </div>

                        <div class="mt-4 space-y-1 text-sm">

                            <p>
                                <strong>Edad:</strong>
                                {{ $mascota->edad }}
                            </p>

                            <p>
                                <strong>Propietario:</strong>
                                {{ $mascota->propietario->nombre }}
                            </p>

                            <p>
                                <strong>Teléfono:</strong>
                                {{ $mascota->propietario->telefono }}
                            </p>

                        </div>

                        <div class="flex gap-2 mt-4">

                            <a
                                href="{{ route('pacientes.show',$mascota) }}"
                                class="flex-1 text-center bg-teal-600 text-white rounded-xl py-2"
                            >
                                Ver
                            </a>

                            <a
                                href="{{ route('mascotas.edit',$mascota) }}"
                                class="flex-1 text-center bg-blue-600 text-white rounded-xl py-2"
                            >
                                Editar
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>
        

    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    // PROPIETARIOS
    const buscarPropietario = document.getElementById('buscarPropietario');

    if (buscarPropietario) {
        buscarPropietario.addEventListener('keyup', function () {

            let texto = this.value.toLowerCase();

            document.querySelectorAll('.propietario-card').forEach(card => {

                let nombre = card.dataset.nombre ?? '';

                card.style.display =
                    nombre.includes(texto)
                        ? ''
                        : 'none';
            });

        });
    }

    // MASCOTAS
    const buscarMascota = document.getElementById('buscarMascota');

    if (buscarMascota) {
        buscarMascota.addEventListener('keyup', function () {

            let texto = this.value.toLowerCase();

            document.querySelectorAll('.mascota-card').forEach(card => {

                let nombre = card.dataset.nombre ?? '';

                card.style.display =
                    nombre.includes(texto)
                        ? ''
                        : 'none';
            });

        });
    }

});
</script>
</x-app-layout>