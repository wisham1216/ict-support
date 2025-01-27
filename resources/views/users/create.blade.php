<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Create User') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden border border-gray-200 bg-white sm:rounded-lg">
        <div class="bg-white p-6">
          <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input type="text" name="name" id="name" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="email" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" name="password" id="password" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex justify-end">
              <button type="submit" class="rounded-md bg-black px-4 py-2 text-white">Create User</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
