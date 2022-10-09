<x-layout>
    <x-setting header="Create  User" class="max-w-lg">
        <div class="mt-5">
            <a href="{{ route('users.index') }}" class="bg-gray-200  rounded-xl py-3 px-5 hover:bg-gray-300 hover:text-white text-sm">Back</a>
        </div>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <x-form.input name="username" placeholder="Username"  :value="old('username')" required></x-form.input>

            <x-form.input name="name" placeholder="Name"  :value="old('name')" required></x-form.input>

            <x-form.input name="email" placeholder="Email" type="email" :value="old('email')" required></x-form.input>

            <x-form.input name="password" placeholder="Password" type="password" required minlength="7"></x-form.input>
            
            <x-form.input name="password_confirmation" placeholder="Password Confirmation" type="password" required></x-form.input>

              <x-form.field class="mb-4 space-x-2">
                <label for="" class="block text-sm uppercase font-bold text-gray-700 mb-2">Roles</label>
                <div class="grid grid-cols-3 gap-4">
                    @forelse($roles as $role)
                    <label class="label"> 
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" checked> {{ ucwords($role->name) }}
                    </label>
                    @empty
                        No Roles Set
                    @endforelse
                </div>
            </x-form.field>
            <x-form.button class="mt-3">Create</x-form.button>
        </form>
      
    </x-setting>
</x-layout>
