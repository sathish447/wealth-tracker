<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Family Member
            </h2>

```
        <a href="{{ route('users.index') }}"
           class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">
            Back
        </a>
    </div>
</x-slot>

<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="p-6 bg-white rounded-lg shadow">

            <form action="{{ route('users.update', $user->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">
                        Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-200">

                    @error('name')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-200">

                    @error('email')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">
                        Role
                    </label>

                    <input type="text"
                           value="{{ ucfirst($user->role) }}"
                           readonly
                           class="w-full px-3 py-2 bg-gray-100 border rounded">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium text-gray-700">
                        Status
                    </label>

                    <input type="text"
                           value="{{ $user->is_active ? 'Active' : 'Disabled' }}"
                           readonly
                           class="w-full px-3 py-2 bg-gray-100 border rounded">
                </div>

                <div class="flex gap-3">

                    <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Update Member
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>
```

</x-app-layout>
