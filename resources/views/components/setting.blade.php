@props(['header'])
<section class="px-6 py-8">
    <x-panel class="max-w-4xl mx-auto">
        <h1 class="font-bold text-lg  text-center">{{ $header }}</h1>
        {{ $slot }}
    </x-panel>
</section>
