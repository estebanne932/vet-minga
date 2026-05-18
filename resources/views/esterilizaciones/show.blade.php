<x-app-layout>

<div class="py-8">
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-8">

    {{-- 🧾 TÍTULO --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">
            Carta de Consentimiento de Esterilización
        </h1>
        <p class="text-sm text-gray-500">
            Documento generado
        </p>
    </div>

    {{-- 👤 TEXTO PRINCIPAL --}}
    <div class="text-gray-700 text-justify leading-relaxed space-y-3">

        <p>
            Yo, <strong>{{ $esterilizacion->propietario->nombre }}</strong>,
            propietario(a) de la mascota <strong>{{ $esterilizacion->mascota->nombre }}</strong>,
            especie <strong>{{ $esterilizacion->mascota->especie }}</strong>,
            autorizo que sea sometida a cirugía de esterilización.
        </p>

        <p>
            La esterilización tiene como finalidad evitar nacimientos no deseados y contribuir al bienestar animal y la salud pública.
        </p>

        <p>
            El uso de anestesia general y procedimiento quirúrgico implica un riesgo, por lo cual la cirugía se realiza a pacientes sanos.
        </p>

        <p>
            Por lo anterior y una vez informado(a), autorizo que mi mascota sea sometida a cirugía de esterilización.
        </p>

    </div>

    {{-- ⚠️ RIESGOS --}}
    <div class="mt-6">
        <h2 class="font-semibold mb-2">Riesgos de la cirugía</h2>

        <ul class="list-decimal pl-5 text-gray-700 space-y-1 text-sm">
            <li>El uso de anestesia implica riesgos.</li>
            <li>No se realizan estudios preoperatorios.</li>
            <li>No se opera si ha ingerido alimentos recientes.</li>
            <li>No se operan hembras gestantes o en celo.</li>
            <li>El éxito depende de cuidados postoperatorios.</li>
        </ul>
    </div>

    {{-- 📊 DATOS --}}
    <div class="mt-8 grid grid-cols-2 gap-4 text-sm">

        <div>
            <p class="text-gray-500">Veterinario</p>
            <p class="font-semibold">{{ $esterilizacion->veterinario }}</p>
        </div>

        <div>
            <p class="text-gray-500">Tipo</p>
            <p class="font-semibold">{{ $esterilizacion->tipo }}</p>
        </div>

        <div>
            <p class="text-gray-500">Peso</p>
            <p class="font-semibold">{{ $esterilizacion->peso }} kg</p>
        </div>

        <div>
            <p class="text-gray-500">Fecha</p>
            <p class="font-semibold">
                {{ \Carbon\Carbon::parse($esterilizacion->fecha)->format('d/m/Y') }}
            </p>
        </div>

    </div>

    {{-- ✍ FIRMA --}}
    <div class="mt-10 text-center">

        <p class="text-sm text-gray-500 mb-2">
            Firma del propietario
        </p>

        @if($esterilizacion->consentimiento_firmado)
            <img src="{{ asset('storage/firmas/' . $esterilizacion->consentimiento_firmado) }}" class="mx-auto h-32">
        @endif

        <p class="mt-2 font-semibold">
            {{ $esterilizacion->propietario->nombre }}
        </p>

    </div>

    {{-- 🔘 BOTONES --}}
    <div class="mt-8 flex justify-center gap-3">

        <a href="{{ route('esterilizaciones.pdf', $esterilizacion) }}"
           class="bg-green-600 text-white px-4 py-2 rounded">
            Descargar PDF
        </a>

        <a href="{{ route('esterilizaciones.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Volver
        </a>

    </div>

</div>
</div>

</x-app-layout>