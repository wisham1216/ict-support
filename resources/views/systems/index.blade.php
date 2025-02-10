<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-2xl font-bold leading-tight text-gray-800">
        {{ __('Systems Management') }}
      </h2>
      <a href="{{ route('systems.create') }}"
        class="inline-flex items-center rounded-md bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New System
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <!-- Search and Filter Section -->
      <div class="mb-6 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <form class="flex items-center gap-4">
          <div class="flex-1">
            <input type="search" name="search" placeholder="Search systems..."
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
      <div class="grid grid-cols-1 gap-6">
        @forelse ($systems as $system)
          <div
            class="group relative overflow-hidden rounded-lg border border-gray-200 bg-white transition-all hover:shadow-md">
            <div class="absolute right-2 top-2 opacity-0 transition-opacity group-hover:opacity-100">
              <div class="flex items-center gap-2">
                <a href="{{ route('systems.edit', $system) }}"
                  class="rounded-full bg-gray-100 p-2 text-gray-600 hover:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
                <form action="{{ route('systems.destroy', $system) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="rounded-full bg-gray-100 p-2 text-red-600 hover:bg-red-50"
                    onclick="return confirm('Are you sure you want to delete this system?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </form>
              </div>
            </div>

            <div class="p-6">
              <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ $system->name }}</h3>
              <p class="mb-4 text-sm text-gray-600">{{ $system->description }}</p>

              <!-- Access List -->
              <div class="mt-4">
                <h4 class="mb-2 text-sm font-medium text-gray-700">Available Accesses:</h4>
                <div class="flex flex-wrap gap-2">
                  @forelse ($system->accesses as $access)
                    <span
                      class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800">
                      {{ $access->access_name }}
                    </span>
                  @empty
                    <span class="text-sm text-gray-500">No accesses defined</span>
                  @endforelse
                </div>
              </div>
            </div>

            <div class="border-t bg-gray-50 px-6 py-3">
              <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500">Last updated: {{ $system->updated_at->diffForHumans() }}</span>
                <a href="{{ route('systems.show', $system) }}"
                  class="text-sm font-medium text-gray-600 hover:text-gray-900">
                  View Details →
                </a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No systems found</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new system.</p>
            <div class="mt-6">
              <a href="{{ route('systems.create') }}"
                class="inline-flex items-center rounded-md bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New System
              </a>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
