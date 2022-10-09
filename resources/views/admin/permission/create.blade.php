<x-layout>
    <x-setting header="Create new permission" class="max-w-lg">
        <div class="mt-5 mb-5">
            <a href="{{ route('permissions.index') }}"
                class="bg-gray-200  rounded-xl py-3 px-5 hover:bg-gray-300 hover:text-white text-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('permissions.store') }}">
            @csrf
            <x-form.input name="name" placeholder="Name" type="text" :value="old('name')" required></x-form.input>
            <x-form.button class="mt-3">Create</x-form.button>
        </form>
    </x-setting>
</x-layout>
