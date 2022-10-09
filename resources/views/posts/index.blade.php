<x-layout>
    @include('partials._post-header')
    <div class="max-w-screen-2xl text-right mt-6">
        <a href="{{ route('posts.create') }}" class="transition-colors duration-300 bg-green-500 hover:bg-green-600 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">Create New Post</a>
    </div>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">    
        @if(count($posts) > 0)
            <x-post-featured-card :post="$posts[0]"></x-post-featured-card>
        @else
            <p class="text-center">No posts yet. Please check back later. </p>
        @endif
        @if(count($posts) > 1)
        <div class="lg:grid lg:grid-cols-6">
            @forelse ($posts->skip(1) as $post)
                <x-post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"></x-post-card>
            @empty
                <p class="text-center">No posts yet. Please check back later. </p>
            @endforelse
        </div>
        @endif
        @if(count($posts))
        {{ $posts->links('pagination::tailwind') }}
        @endif
    </main>
</x-layout>
