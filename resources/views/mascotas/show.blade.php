<x-app-layout>
    <h1 class="text-xl font-bold">
        {{ $mascota->nombre }}
    </h1>

    <p>Especie: {{ $mascota->especie }}</p>
    <p>Raza: {{ $mascota->raza }}</p>
    <p>Edad: {{ $mascota->edad }} años</p>
</x-app-layout>
