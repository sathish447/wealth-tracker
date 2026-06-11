<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Family Members
            </h2>

            <a href="{{ route('users.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Add Member
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Role</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t">

                                <td class="px-4 py-3">
                                    {{ $user->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $user->email }}
                                </td>

                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">

                                    @if($user->is_active)
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded">
                                            Disabled
                                        </span>
                                    @endif

                                </td>

                                <td class="px-4 py-3">

                                    <div class="flex gap-2 justify-center">

                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded">
                                            Edit
                                        </a>

                                        @if(auth()->id() != $user->id)

                                            <form action="{{ route('users.toggle-status', $user->id) }}"
                                                  method="POST">
                                                @csrf

                                                <button
                                                    class="px-3 py-1 rounded text-white
                                                    {{ $user->is_active
                                                        ? 'bg-red-500'
                                                        : 'bg-green-500' }}">
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
                                                    class="bg-gray-700 text-white px-3 py-1 rounded">
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
                                    class="text-center py-5 text-gray-500">
                                    No Members Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
