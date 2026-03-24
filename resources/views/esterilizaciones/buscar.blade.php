<x-app-layout>

<div class="max-w-3xl mx-auto p-6">

<h2 class="text-xl font-bold mb-4">
Buscar propietario
</h2>

<form method="GET" action="{{ route('esterilizaciones.buscar') }}" class="flex gap-2">

<input
type="text"
name="buscar"
placeholder="Nombre o teléfono"
class="border p-2 w-full rounded">

<button class="bg-teal-600 text-white px-4 py-2 rounded">
Buscar
</button>

</form>


@if(isset($propietarios))

<div class="mt-6 space-y-4">

@forelse($propietarios as $propietario)

<div class="border p-4 rounded">

<div class="mb-3">
<strong>{{ $propietario->nombre }}</strong><br>
<span class="text-sm text-gray-600">{{ $propietario->telefono }}</span>
</div>

<h3 class="text-sm font-semibold mb-2">
Mascotas
</h3>

@forelse($propietario->mascotas as $mascota)

<div class="flex justify-between border p-2 rounded mb-2">

<div>
{{ $mascota->nombre }}
<span class="text-gray-500 text-sm">
({{ $mascota->especie }})
</span>
</div>

<a
href="{{ route('esterilizaciones.form',$mascota) }}"
class="text-teal-600 hover:underline"
>
Seleccionar
</a>


</div>

@empty

<p class="text-sm text-gray-500">
Este propietario no tiene mascotas registradas.
</p>

@endforelse

</div>

@empty

<p class="text-gray-500 mt-4">
No se encontró el propietario.
</p>

<a href="{{ route('propietarios.create') }}" class="text-teal-600">
Registrar propietario
</a>

@endforelse

</div>

@endif

</div>

</x-app-layout>
