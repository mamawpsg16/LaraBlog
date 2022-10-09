@props(['comment'])
<x-panel class="bg-gray-100">
    <article class="flex space-x-4">
        <div class="flex-shrink-0 mr-2">
            {{-- <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="Profile" width="60" height="60" class="rounded-xl"> --}}
            <img src="{{ isset($comment->author->profile->image) ? asset('storage/'.$comment->author->profile->image) : asset('images/no-profile.png') }}" alt="Lary avatar" width="60" height="60"" class="rounded-full">

        </div>
        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->name }}</h3>
                <p class="text-xs">Posted
                    <time>{{ $comment->created_at->diffForHumans() }}</time>
                </p>
            </header>
            <p>
               {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>