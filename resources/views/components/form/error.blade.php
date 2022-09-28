@props(['name'])
@error($name)
    <div {{ $attributes(['class' => 'text-red-500']) }}>{{ $message }}</div>
@enderror
