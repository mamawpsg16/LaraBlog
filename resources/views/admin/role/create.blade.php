<x-layout>
    <x-setting header="Create new Role" class="max-w-lg">
        <div class="mt-5 mb-5">
            <a href="{{ route('roles.index') }}"
                class="bg-gray-200  rounded-xl py-3 px-5 hover:bg-gray-300 hover:text-white text-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <x-form.input name="name" placeholder="Name" type="text" :value="old('name')" required></x-form.input>
            <x-form.field class="mb-4 space-x-2">
                <label for="" class="block text-sm uppercase font-bold text-gray-700 mb-2">Permissions</label>
                @forelse($permissions as $permission)
                <label class="label"> 
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked> {{ ucwords($permission->name) }}
                </label>
                @empty
                    No Permissions Set
                @endforelse
                <x-form.error name="permissions"></x-form.error>
            </x-form.field>
            <x-form.button class="mt-3">Create</x-form.button>
        </form>
    </x-setting>
</x-layout>
