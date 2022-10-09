<x-layout>
    
    <section class="px-6 py-8 ">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-xl bg-gray-200 p-10 rounded-xl  mx-auto lg:grid lg:grid-cols-12 gap-x-10 ">
                <div class="col-span-4 mb-10">
                    <div>
                        <label for="username" class="font-bold text-2xl">Name:</label>
                        <h1 class="text-md">
                            {{ $permission->name }}
                        </h1>
                    </div>
                </div>
                <div class="col-span-8">

                    <div>
                        <label for="username" class="font-bold text-2xl mt-5">Slug:</label>
                        <h1 classboldtext-md">
                            {{ $permission->slug }}
                        </h1>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{ route('permissions.index') }}">Back</a>
                </div>
            </article>
        </main>
    </section>
</x-layout>
