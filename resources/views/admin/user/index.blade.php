<x-layout>
    <x-setting header="Users" class="mt-10" button="Create New User" :href="route('users.create')">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                @forelse($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @forelse ($user->roles as $role )
                                            {{ ucwords($role->name) }}
                                        @empty
                                            N/A
                                        @endforelse
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center">
                                        <a href="{{ route('users.show',$user->id) }}" class="p-3">View</a>
                                        <a href="{{ route('users.edit',$user->id) }}" class="p-3">Edit</a>
                                        <form method="POST" action="{{ route('users.destroy',$user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Users</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(count($users))
        <div class="mt-5">
            {{ $users->links('pagination::tailwind') }}
        </div>
        @endif
    </x-setting>
</x-layout>