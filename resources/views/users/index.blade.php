<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Family Members
            </h2>

            <a href="{{ route('users.create') }}"
               class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Add Member
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">Name</th>
                                <th class="px-4 py-3 text-left">Email</th>
                                <th class="px-4 py-3 text-left">Role</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-center w-72">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($users as $user)

                                <tr>

                                    <td class="px-4 py-3">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-sm text-blue-700 bg-blue-100 rounded">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        @if($user->is_active)
                                            <span class="px-2 py-1 text-sm text-green-700 bg-green-100 rounded">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-sm text-red-700 bg-red-100 rounded">
                                                Disabled
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">

                                        <div class="flex flex-wrap justify-center gap-2">

                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            @if(auth()->id() != $user->id)

                                                <form action="{{ route('users.toggle-status', $user->id) }}"
                                                      method="POST">
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="px-3 py-1 text-white rounded
                                                        {{ $user->is_active
                                                            ? 'bg-red-500 hover:bg-red-600'
                                                            : 'bg-green-500 hover:bg-green-600' }}">
                                                        {{ $user->is_active
                                                            ? 'Disable'
                                                            : 'Enable' }}
                                                    </button>

                                                </form>

                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Delete this member?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="px-3 py-1 text-white bg-gray-700 rounded hover:bg-gray-800">
                                                        Delete
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5"
                                        class="py-6 text-center text-gray-500">
                                        No Members Found
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
