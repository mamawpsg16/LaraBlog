@props(['name','label' => 'with'])
<x-form.field>
    @if($label == 'with')
        <x-form.label name="{{ $name }}" />
    @endif
    <textarea name="{{ $name }}" cols="30" rows="3"
        class="w-full border border-gray-400 focus:border-indigo-300 focus:ring rounded focus:ring-indigo-200 focus:ring-opacity-50 p-2 shadow-sm "
        placeholder="Enter {{ ucwords($name) }}">{{ $slot ?? old($name) }}</textarea>
    <x-form.error name="{{ $name }}" />
</x-form.field>
