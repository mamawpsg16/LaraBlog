@props(['type' => 'text', 'name', 'placeholder'])
<x-form.field>
<x-form.label name="{{ $name }}"/>
<input
    class="{{ $type != 'checkbox' ? 'w-full' : ''}} border border-gray-400 focus:border-indigo-300 focus:ring rounded focus:ring-indigo-200 focus:ring-opacity-50 p-2 shadow-sm"
    type="{{ $type }}" placeholder="Enter your {{ $placeholder }}" name="{{ $name }}"
    autocomplete="{{ $name }}"  {{ $attributes(['value' => old($name)]) }} />
<x-form.error name="{{ $name }}" />
</x-form.field>
