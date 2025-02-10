<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">System Details</h2>
        <p class="mt-1 text-sm text-gray-600">{{ $system->name }}</p>
      </div>
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <a href="{{ route('systems.edit', $system->id) }}"
          class="inline-flex items-center justify-center gap-2 rounded-md bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
          </svg>
          Edit System
        </a>
        <a href="{{ route('systems.index') }}"
          class="inline-flex items-center justify-center gap-2 rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-600 shadow-sm ring-1 ring-inset ring-gray-300 transition-colors hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
          </svg>
          Back to List
        </a>
      </div>
    </div>
  </x-slot>

  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- System Information -->
        <div class="col-span-1 lg:col-span-2 space-y-6">
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">System Information</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                  <dt class="text-sm font-medium text-gray-500">System Name</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $system->name }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">Created At</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $system->created_at->format('M j, Y H:i') }}</dd>
                </div>
                <div class="sm:col-span-2">
                  <dt class="text-sm font-medium text-gray-500">Description</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $system->description ?? 'No description provided' }}</dd>
                </div>
              </dl>
            </div>
          </div>

          <!-- System Accesses -->
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Available Access Types</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              @if($system->accesses->count() > 0)
                <div class="flex flex-wrap gap-2">
                  @foreach($system->accesses as $access)
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                      {{ $access->access_name }}
                    </span>
                  @endforeach
                </div>
              @else
                <p class="text-sm text-gray-500">No access types defined for this system.</p>
              @endif
            </div>
          </div>
        </div>

        <!-- Statistics -->
        <div class="col-span-1 space-y-6">
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Statistics</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              <dl class="grid grid-cols-1 gap-4">
                <div class="rounded-lg bg-gray-50 p-4">
                  <dt class="text-sm font-medium text-gray-500">Total Access Types</dt>
                  <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ $system->accesses->count() }}</dd>
                </div>
                <!-- Add more statistics as needed -->
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
