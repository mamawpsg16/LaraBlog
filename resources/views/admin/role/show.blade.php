<x-layout>
    
    <section class="px-6 py-8 ">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-xl bg-gray-200 p-10 rounded-xl  mx-auto lg:grid lg:grid-cols-12 gap-x-10 ">
                <div class="col-span-4 mb-10">
                    <div>
                        <label for="username" class="font-bold text-2xl">Role:</label>
                        <h1 class="text-md">
                            {{ ucwords($role->name) }}
                        </h1>
                    </div>
                </div>
                <div class="col-span-8">

                    <div>
                        <label for="username" class="font-bold text-2xl mt-5">Permissions:</label>
                        <h1 classboldtext-md">
                        @forelse ($role->permissions as $permission)
                            {{ $permission->name }}
                        @empty
                            No Permission
                        @endforelse
                        </h1>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{ route('roles.index') }}">Back</a>
                </div>
            </article>
        </main>
    </section>
</x-layout>
