<x-layout>
    <section class="px-6 py-8 ">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl bg-gray-200 p-10 rounded-xl  mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 mb-10">
                    <div class="flex items-center lg:justify-center text-sm">
                        <img src="/images/lary-avatar.svg" width="100" alt="Lary avatar">
                    </div>
                </div>
                <div class="col-span-8 flex justify-between">
                    <div>
                        <label for="username" class="font-bold text-2xl">Username:</label>
                        <h1 class="text-md">
                            {{ $user->username }}
                        </h1>
                        <label for="username" class="font-bold text-2xl">Name:</label>
                        <h1 classboldtext-md">
                            {{ $user->name }}
                        </h1>
                        <label for="username" class="font-bold text-2xl">Email:</label>
                        <h1 class="text-md">
                            {{ $user->email }}
                        </h1>
                     
                    </div>
                    <div>
                        <label for="username" class="font-bold text-2xl">Posts Count:</label>
                        <h1 class="text-md">
                            {{ $user->posts_count }}
                        </h1>
                        <label for="username" class="font-bold text-2xl">Roles:</label>
                        <h1 class="text-md">
                            @foreach($user->roles as $role)
                            {{ ucwords($role->name) }}
                            @endforeach
                        </h1>
                    </div>
                </div>
                <div class="back">
                    <a href="{{ route('users.index') }}">Back</a>
                </div>
            </article>
        </main>
    </section>
</x-layout>
