<x-layout>
    <div class="flex flex-col items-center rounded-full">
        <img src="{{ isset($user->profile->image) ? asset('storage/' . $user->profile->image) : asset('images/no-profile.png') }}"
            width="200" height="150" alt="User Profile Picture" class="h-full  border rounded-full border-gray-2 mb-5 block">
        <p>{{ ucwords($user->name) }}</p>
        @if($user->id === auth()->user()->id)
            <a href="{{ route('profile.edit') }}"
                class = "bg-blue-500 text-white uppercase text-xs py-3 px-5 rounded hover:bg-blue-600"
                >
                Edit Profile
            </a>
        @else
            <form action="{{ route('profile.follow') }}" method="POST">
                <input type="hidden" name="profile_id" value="{{ $user->id }}">
                @csrf
                @if(isset(auth()->user()->following) && auth()->user()->following->contains($user->id))
                    <button class="px-3 py-1 border border-blue-300 ml-2 rounded-full text-white bg-blue-500 text-xs uppercase font-semibold">Following</button>
                @else
                    <button class="px-3 py-1 border border-blue-300 ml-2 rounded-full text-white bg-blue-500 text-xs uppercase font-semibold">Follow</button>
                @endif
            </form>
        @endif
    </div>
    <div class="max-w-screen-lg mx-auto flex justify-between ">
        <div id="basic-information">
            <p for="" class="text-lg">Birth Date : {{ $user->date_of_birth ?? 'N/A' }}</p>
            <p for="" class="text-lg">Address : {{ $user->address ?? 'N/A' }}</p>
            <p for="" class="text-lg">Contact Number : {{ $user->contact_number ?? 'N/A' }}</p>
        </div>

        <div class="followers-following">
            {{-- @dd($user->profile->followers)); --}}
            <label for="" class="text-lg">Following : {{ $user->following->count() }}</label> 
            <label for="" class="text-lg">Followers : {{ $user->profile->followers_count }}</label> 
        </div>
    </div>
    @if($user->id === auth()->user()->id)
    <div class="max-w-screen-2xl text-right mt-6">
        <a href="{{ route('posts.create') }}"
            class="transition-colors duration-300 bg-green-500 hover:bg-green-600 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">Create
            New Post</a>
    </div>
    @endif
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if (count($user->posts) > 0)
            <x-post-featured-card :post="$user->posts[0]"></x-post-featured-card>
        @else
            <p class="text-center">No posts yet. Please check back later. </p>
        @endif
        @if (count($user->posts) > 1)
            <div class="lg:grid lg:grid-cols-6">
                @forelse ($user->posts->skip(1) as $post)
                    <x-post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}">
                    </x-post-card>
                @empty
                    <p class="text-center">No posts yet. Please check back later. </p>
                @endforelse
            </div>
        @endif
        {{-- @if (count($user->posts))
        {{ $user->posts->links('pagination::tailwind') }}
        @endif --}}
    </main>
</x-layout>
