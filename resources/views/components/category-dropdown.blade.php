<x-dropdown>
    <x-slot name="trigger">
        <button
            class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left lg:flex border border-gray-300 rounded-lg mb-2">{{ !empty($selected_category) ? ucwords($selected_category->name) : 'Categories' }}
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"></x-icon>
        </button>
    </x-slot>
    {{-- :active="request()->routeIs('posts.index') --}}
    <x-dropdown-item href="/?{{ http_build_query(request()->except('category','page')) }}" >All</x-dropdown-item>
    @foreach ($categories as $category)
        {{-- {{ !empty($selected_category) && $selected_category == $category->name ? 'bg-blue-500 text-white' : '' }} --}}
        <x-dropdown-item href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category','page')) }}" :active="!empty($selected_category) && $selected_category->name == $category->name">
            {{ ucwords($category->name) }}</x-dropdown-item>
    @endforeach
</x-dropdown>