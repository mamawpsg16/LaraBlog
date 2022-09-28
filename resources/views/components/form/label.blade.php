@props(['name'])
<label {{ $attributes(['class' => 'block text-sm uppercase font-bold text-gray-700']) }}
    for="{{ $name }}">{{ ucwords($name) }}</label>
