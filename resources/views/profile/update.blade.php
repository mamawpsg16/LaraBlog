<x-layout>
    <x-setting header="User Profile">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex flex-col items-center rounded-full">
                <img src="{{ isset(auth()->user()->profile->image) ? asset('storage/'.auth()->user()->profile->image) : asset('images/no-profile.png') }}" width="200" height="150" alt="User Profile Picture" class="h-full  border border-gray-2 mb-5 block">
                <label for="">
                    Select Profile Image: 
                    <input type="file" name="image" value="{{ old('image',auth()->user()->profile->image) }}">
                    <x-form.error name="image" />
                </label>
            </div>
            <x-form.input name="email" placeholder="Email"  type="email" :value="old('email',auth()->user()->email)" required></x-form.input>
            <x-form.input name="name"  placeholder="Name"  type="text" :value="old('name',auth()->user()->name)" required></x-form.input>
            <x-form.input name="username"  placeholder="Username"  type="text" :value="old('username',auth()->user()->username)" required></x-form.input>
            <x-form.input name="date_of_birth" placeholder="Birth Date"  type="date" :value="old('date_of_birth',auth()->user()->profile->date_of_birth)" required></x-form.input>
            <x-form.input name="contact_number" placeholder="Contact Number"  :value="old('contact_number',auth()->user()->profile->contact_number)" required></x-form.input>
            <x-form.text-area name="address" type="text" required>{{ old('body',auth()->user()->profile->address) }}</x-form.text-area>
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>