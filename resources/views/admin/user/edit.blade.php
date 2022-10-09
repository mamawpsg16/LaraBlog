<x-layout>
    <x-setting :header="'Edit  User : ' . $user->username" class="max-w-lg">
        <div class="mt-5">
            <a href="{{ route('users.index') }}"
                class="bg-gray-200  rounded-xl py-3 px-5 hover:bg-gray-300 hover:text-white text-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PATCH')
            <x-form.input name="username" placeholder="Username" type="text" :value="old('username', $user->username)"></x-form.input>

            <x-form.input name="name" placeholder="Name" type="text" :value="old('name', $user->name)"></x-form.input>

            <x-form.input name="email" placeholder="Email" type="email" :value="old('email', $user->email)"></x-form.input>
            <x-form.field class="mb-4 space-x-2">
                <label for="username" class="font-bold text-2xl">Roles:</label>
                @forelse($roles as $role)
                    @if ($user->roles)
                        <label class="label">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ ucwords($role->name) }}
                        </label>
                    @endif
                @empty
                    No Permissions Set
                @endforelse
                <x-form.error name="roles"></x-form.error>
            </x-form.field>
            <x-form.button class="mt-3">Update</x-form.button>
        </form>

    </x-setting>
</x-layout>
