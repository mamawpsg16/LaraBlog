<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-md mx-auto mt-10">
            <x-panel>
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <h1 class="font-bold text-lg  text-center">Register</h1>
                    <x-form.input name="username" placeholder="Username" required></x-form.input>
                    <x-form.input name="email" placeholder="Email" type="email" required></x-form.input>
                    <x-form.input name="name" placeholder="Full Name" type="text" required></x-form.input>
                    <x-form.input name="password" placeholder="Password" type="password" required></x-form.input>
                    <x-form.button class="mt-2">Submit</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
