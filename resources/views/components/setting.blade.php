@props(['header','button' => 'without','href' => 'without'])
<section class="px-6 py-8">
    <div class="max-w-4xl mx-auto flex justify-between items-center">
        <h1 class="font-bold text-2xl  text-left mb-2">{{ $header }}</h1>
        @if($button != 'without')
            <a href="{{ $href }}" class="transition-colors duration-300 bg-green-500 hover:bg-green-600 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">{{ $button }}</a>
        @endif
    </div>
    <div {{ $attributes(['class' => 'max-w-4xl mx-auto border border-gray-200  p-6 rounded-xl']) }}>
        {{ $slot }}
    </div>
</section>
