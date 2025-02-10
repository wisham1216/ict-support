<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900">
        {{ __('Manage User Roles') }}
      </h2>
      <a href="{{ route('users.index') }}" class="flex items-center text-black hover:text-gray-700">
        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back
      </a>
    </div>
  </x-slot>

  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="rounded-lg border bg-white shadow-sm">
        <div class="p-6">
          <div class="mb-10 flex items-center space-x-4">
            <div class="flex-shrink-0">
              <div
                class="flex h-12 w-12 items-center justify-center rounded-md border-2 border-black font-semibold text-black">
                {{ strtoupper(substr($user->name, 0, 1)) }}
              </div>
            </div>
            <div>
              <h3 class="mb-2 text-2xl font-semibold leading-none tracking-tight text-gray-900">Manage Roles for
                {{ $user->name }}</h3>
              <p class="text-sm text-gray-500">Select the roles you want to assign to this user.</p>
            </div>
          </div>

          <form action="{{ route('users.roles.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 py-4 sm:grid-cols-2 lg:grid-cols-3">
              @foreach ($roles as $role)
                <div class="flex items-start rounded-lg border p-4 transition-shadow duration-200 hover:shadow-sm">
                  <div class="flex h-5 items-center">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}"
                      {{ in_array($role->name, $userRoles) ? 'checked' : '' }}
                      class="h-4 w-4 rounded border-gray-300 text-black focus:ring-black">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="role_{{ $role->id }}" class="font-medium text-gray-700">
                      {{ $role->name }}
                    </label>
                    <p class="text-gray-500">{{ $role->description }}</p>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="mt-6 flex items-center gap-2">
              <button type="submit"
                class="rounded-md bg-black px-4 py-2 text-sm font-medium text-white transition duration-200 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update Roles
              </button>
              <a href="{{ route('users.index') }}"
                class="flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition duration-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Cancel
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
