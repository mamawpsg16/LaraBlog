@auth
    <x-panel class="bg-gray-100">
        <form action="{{ route('comment.store', $post->slug) }}" method="POST">
            @csrf
            <header class="flex items-center">
                <img src="{{ isset(auth()->user()->profile->image) ? asset('storage/'.auth()->user()->profile->image) : asset('images/no-profile.png') }}" alt="Lary avatar" width="60" height="60"" class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <x-form.field>
                <x-form.text-area name="body" label="without"></x-form.text-area>
                <x-form.error name="body"></x-form.error>
            </x-form.field>
            <div class="flex justify-end mt-2 border-t border-gray-200 pt-6">
               <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="{{ route('register') }}" class="hover:underline">Register</a> Or
        <a href="{{ route('login') }}" class="hover:underline">Log in</a> to leave a comment.
    </p>
@endauth
