<x-layout>
    <x-setting :header="'Edit  Role : ' . $role->name" class="max-w-lg">
        <div class="mt-5 mb-5">
            <a href="{{ route('roles.index') }}"
                class="bg-gray-200  rounded-xl py-3 px-5 hover:bg-gray-300 hover:text-white text-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PATCH')
            <x-form.input name="name" placeholder="Name" type="text" :value="old('name', $role->name)"></x-form.input>
            <x-form.field class="mb-4 space-x-2">
                <label for="" class="block text-sm uppercase font-bold text-gray-700 mb-2">Permissions</label>
                @forelse($permissions as $permission)
                    @if($role->permissions)
                        <label class="label"> 
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"  {{ in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'checked' : ''}}> {{ ucwords($permission->name) }}
                        </label>
                    @endif
                @empty
                    No Permissions Set
                @endforelse
                <x-form.error name="permissions"></x-form.error>
            </x-form.field>

            <x-form.button class="mt-3">Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
