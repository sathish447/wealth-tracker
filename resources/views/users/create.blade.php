<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Add Family Member
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="p-6 bg-white rounded-lg shadow">

                <form action="{{ route('users.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-3 py-2 border rounded"
                        >

                        @error('name')
                            <p class="text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full px-3 py-2 border rounded"
                        >

                        @error('email')
                            <p class="text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full px-3 py-2 border rounded"
                        >

                        @error('password')
                            <p class="text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full px-3 py-2 border rounded"
                        >
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded"
                        >
                            Save Member
                        </button>

                        <a
                            href="{{ route('users.index') }}"
                            class="px-4 py-2 text-white bg-gray-500 rounded"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
