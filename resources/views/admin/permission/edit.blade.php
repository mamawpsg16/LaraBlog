<x-layout>
    <x-setting :header="'Edit  permission : ' . $permission->name" class="max-w-lg">
        <div class="mt-5 mb-5">
            <a href="{{ route('permissions.index') }}"
                class="bg-gray-200  rounded-xl py-3 px-5 hover:bg-gray-300 hover:text-white text-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
            @csrf
            @method('PATCH')
            <x-form.input name="name" placeholder="Name" type="text" :value="old('name', $permission->name)"></x-form.input>
            <x-form.button class="mt-3">Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
