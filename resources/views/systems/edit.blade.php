<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-3xl font-bold tracking-tight">
        {{ __('Edit Role') }}
      </h2>
      <a href="{{ route('roles.index') }}" class="flex items-center text-black hover:text-gray-700">
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
          <div class="mb-8">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Edit Role Details</h3>
            <p class="mt-2 text-sm text-gray-500">Update role information and manage permissions.</p>
          </div>

          <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                  class="@error('name') border-red-500 @enderror mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description"
                  class="@error('description') border-red-500 @enderror mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                  rows="3">{{ old('description', $role->description) }}</textarea>
                @error('description')
                  <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Permissions</label>
                <div class="grid grid-cols-1 gap-4 rounded-lg border p-4 md:grid-cols-2">
                  @foreach ($permissions as $permission)
                    <div class="flex flex-col space-y-1">
                      <label class="flex items-center space-x-2">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                          {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                          class="rounded border-gray-300 text-gray-800 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        <span class="text-sm font-medium text-gray-700">{{ $permission->name }}</span>
                      </label>
                      @if ($permission->description)
                        <p class="ml-6 text-xs text-gray-500">{{ $permission->description }}</p>
                      @endif
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="flex items-center gap-2">
                <button type="submit"
                  class="rounded-md bg-gray-800 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                  Update Role
                </button>
                <a href="{{ route('roles.index') }}"
                  class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                  Cancel
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
