<x-layout>
    <x-setting header="Roles" class="mt-10" button="Create New Role" :href="route('roles.create')">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                                @forelse($roles as $role)
                                <tr>
                                    <td class=" py-4 whitespace-nowrap text-center text-sm font-medium">
                                        {{ ucwords($role->name) }}
                                    </td>

                                    <td class=" py-4 whitespace-nowrap text-center text-sm font-medium">
                                        {{ $role->slug }}
                                    </td>


                                    <td class=" py-4 whitespace-nowrap text-center text-sm font-medium">
                                        @forelse ($role->permissions as $permission)
                                            {{ $permission->name }}
                                        @empty
                                            No Permission
                                        @endforelse
                                    </td>

                                    
                                    <td class="py-4 whitespace-nowrap text-left text-sm font-medium flex items-center justify-center">
                                        <a href="{{ route('roles.show',$role->id) }}" class="p-3">View</a>
                                        <a href="{{ route('roles.edit',$role->id) }}" class="p-3">Edit</a>
                                        <form method="POST" action="{{ route('roles.destroy',$role->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Roles</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(count($roles))
        <div class="mt-5">
            {{ $roles->links('pagination::tailwind') }}
        </div>
        @endif
    </x-setting>
</x-layout>