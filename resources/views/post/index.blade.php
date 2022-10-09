<x-layout footer="without">
    <x-setting header="Manage Posts" class="mt-10" button="Create New Post" :href="route('posts.create')">
        <div class="relative flex lg:inline-flex items-center rounded-xl">
            <x-dropdown>
                <x-slot name="trigger">
                    <button
                        class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left lg:flex border border-gray-300 rounded-lg mb-2">{{ !empty((request('published'))) ? ucwords(request('published')) : 'All'  }}
                        <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"></x-icon>
                    </button>
                </x-slot>
                <x-dropdown-item href="/posts" active="{{ empty(request('published')) }}" >
                    All </x-dropdown-item>
                <x-dropdown-item href="/posts?published=approved" active="{{ !empty(request('published')) && request('published') == 'approved'}}" >
                    Approved </x-dropdown-item>
                <x-dropdown-item href="/posts?published=pending" active="{{ !empty(request('published')) && request('published') == 'pending'}}">
                    Pending </x-dropdown-item>
            </x-dropdown>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($posts as $post)
                                    <tr>
                                        @can('admin')
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->author->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        @endcan
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="bg-blue-500 text-white uppercase text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Edit</a>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-form.button class="bg-red-500 hover:bg-red-600">Delete
                                                </x-form.button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">No Posts</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if (count($posts))
            <div class="mt-5">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif
    </x-setting>
</x-layout>
