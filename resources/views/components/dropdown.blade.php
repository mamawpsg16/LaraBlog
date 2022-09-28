@props(['trigger'])
<div x-data="{ show: false }" @click.away="show = false" {{ $attributes(['class' => 'relative']) }}>
    <div @click="show = !show">
        {{ $trigger }}
    </div>
    <div x-show="show" class="py-2 absolute bg-gray-200/90 w-full rounded-xl z-50 " style="display:none">
        {{ $slot }}
    </div>
</div>
