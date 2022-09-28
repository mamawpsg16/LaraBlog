<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-md mx-auto mt-10">
            <x-panel>

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <h1 class="font-bold text-lg  text-center">Login</h1>
                    {{-- @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-red-500 text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif --}}
                    <x-form.input name="email" placeholder="Email" type="email" required></x-form.input>
                    <x-form.input name="password" placeholder="Password" type="password" required></x-form.input>
                    <x-form.button class="mt-2">Login</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
