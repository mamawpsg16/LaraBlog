<x-layout>
    <x-setting header="Permissions" class="mt-10" button="Create New permission" :href="route('permissions.create')">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                                @forelse($permissions as $permission)
                                <tr>
                                    <td class=" py-4 whitespace-nowrap text-center text-sm font-medium">
                                        {{ ucwords($permission->name) }}
                                    </td>

                                    <td class=" py-4 whitespace-nowrap text-center text-sm font-medium">
                                        {{ $permission->slug }}
                                    </td>

                                    <td class="py-4 whitespace-nowrap text-left text-sm font-medium flex items-center justify-center">
                                        <a href="{{ route('permissions.show',$permission->id) }}" class="p-3">View</a>
                                        <a href="{{ route('permissions.edit',$permission->id) }}" class="p-3">Edit</a>
                                        <form method="POST" action="{{ route('permissions.destroy',$permission->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No permissions</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(count($permissions))
        <div class="mt-5">
            {{ $permissions->links('pagination::tailwind') }}
        </div>
        @endif
    </x-setting>
</x-layout>