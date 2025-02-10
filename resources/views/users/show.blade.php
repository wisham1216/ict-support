<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-3xl font-bold tracking-tight">
        {{ __('User Details') }}
      </h2>
      <a href="{{ route('users.index') }}" class="flex items-center text-black hover:text-gray-700">
        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back
      </a>
    </div>
  </x-slot>

  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="rounded-lg border bg-white shadow-sm">
        <div class="p-6">
          <div class="mb-8 flex items-center space-x-4">
            <div class="flex-shrink-0">
              <div
                class="flex h-12 w-12 items-center justify-center rounded-md border-2 border-black font-semibold text-black">
                {{ strtoupper(substr($user->name, 0, 1)) }}
              </div>
            </div>
            <div>
              <h3 class="text-2xl font-semibold leading-none tracking-tight">{{ $user->name }}</h3>
              <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>
          </div>

          <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
              <div class="rounded-lg border p-4">
                <h4 class="mb-2 text-sm font-medium text-gray-500">Account Information</h4>
                <div class="space-y-3">
                  <div>
                    <label class="text-xs text-gray-500">User ID</label>
                    <p class="text-sm font-medium">{{ $user->id }}</p>
                  </div>
                  <div>
                    <label class="text-xs text-gray-500">Created At</label>
                    <p class="text-sm font-medium">{{ $user->created_at->format('d M Y, H:i') }}</p>
                  </div>
                  <div>
                    <label class="text-xs text-gray-500">Last Updated</label>
                    <p class="text-sm font-medium">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="space-y-4">
              <div class="rounded-lg border p-4">
                <h4 class="mb-2 text-sm font-medium text-gray-500">Roles</h4>
                <div class="flex flex-wrap gap-2">
                  @forelse($user->roles as $role)
                    <span
                      class="inline-flex items-center rounded-md border border-gray-400 px-3 py-1 text-xs font-medium text-black">
                      {{ $role->name }}
                    </span>
                  @empty
                    <p class="text-sm text-gray-500">No roles assigned</p>
                  @endforelse
                </div>
              </div>
            </div>
          </div>

          <div class="mt-6 flex items-center gap-2">
            <a href="{{ route('users.edit', $user) }}"
              class="rounded-md bg-gray-800 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
              Edit User
            </a>
            <a href="{{ route('users.roles', $user) }}"
              class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
              Manage Roles
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
