<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-2xl font-bold leading-tight text-gray-800">
        {{ __('System Access Management') }}
      </h2>
      <a href="{{ route('system-accesses.create') }}"
        class="inline-flex items-center rounded-md bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New Access
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <!-- Search Section -->
      <div class="mb-6 rounded-lg bg-white p-4 shadow-sm">
        <form class="flex items-center gap-4">
          <div class="flex-1">
            <input type="search" name="search" placeholder="Search accesses..."
              class="w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" />
          </div>
          <button type="submit"
            class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
          </button>
        </form>
      </div>

      <!-- Systems Grid -->
      <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-1">
        @forelse ($systems as $system)
          <div class="rounded-lg border border-gray-200 bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900">{{ $system->name }}</h3>
              <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800">
                {{ $system->accesses->count() }} Accesses
              </span>
            </div>

            <div class="grid grid-cols-4 gap-2">
              @forelse ($system->accesses as $access)
                <div
                  class="group relative flex items-center justify-between rounded-md border bg-gray-50 p-3 transition-all hover:bg-gray-100">
                  <div class="">
                    <h4 class="font-medium text-gray-900">{{ $access->access_name }}</h4>
                    <p class="text-sm text-gray-500">{{ $access->description ?? 'No description available' }}</p>
                  </div>

                  <div class="ml-4 flex items-center gap-2 opacity-0 transition-opacity group-hover:opacity-100">
                    <a href="{{ route('system-accesses.edit', $access) }}"
                      class="rounded-full bg-gray-200 p-2 text-gray-600 hover:bg-gray-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path
                          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                    </a>
                    <form action="{{ route('system-accesses.destroy', $access) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="rounded-full bg-gray-200 p-2 text-red-600 hover:bg-red-100"
                        onclick="return confirm('Are you sure you want to delete this access?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              @empty
                <div class="rounded-md bg-gray-50 p-4 text-center text-sm text-gray-500">
                  No accesses defined for this system
                </div>
              @endforelse
            </div>

            <div class="mt-4 border-t pt-4">
              <a href="{{ route('system-accesses.create') }}?system_id={{ $system->id }}"
                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
                </svg>
                Add Access to {{ $system->name }}
              </a>
            </div>
          </div>
        @empty
          <div class="col-span-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No systems or accesses found</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new system access.</p>
            <div class="mt-6">
              <a href="{{ route('system-accesses.create') }}"
                class="inline-flex items-center rounded-md bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Access
              </a>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
