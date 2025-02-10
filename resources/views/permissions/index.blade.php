<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold tracking-tight">
      {{ __('Permissions Management') }}
    </h2>
  </x-slot>

  <div class="bg-white py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border shadow-sm">
        <div class="p-6">
          <div class="mb-6 flex items-center justify-between">
            <div class="space-y-1">
              <h3 class="text-2xl font-semibold leading-none tracking-tight">All Permissions</h3>
              <p class="text-muted-foreground text-sm">Manage system permissions here.</p>
            </div>
            <a href="{{ route('permissions.create') }}"
              class="flex items-center justify-center rounded-md border bg-gray-800 px-4 py-2 font-medium text-white hover:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="mr-2 text-white">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Add New Permission
            </a>
          </div>

          <div class="rounded-md border border-gray-200 px-4 py-6 pb-4">
            <div class="mb-6 flex flex-wrap gap-4">
              <form action="{{ route('permissions.index') }}" method="GET" class="flex w-full flex-wrap gap-4">
                <div class="flex-grow">
                  <input type="text" name="search" placeholder="Search permissions" value="{{ request('search') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="flex items-center">
                  <button type="submit"
                    class="flex items-center justify-center rounded-md border bg-gray-800 px-4 py-2 font-medium text-white hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="mr-2">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Search
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="relative w-full overflow-auto">
            <table class="w-full caption-bottom text-sm">
              <thead class="[&_tr]:border-b">
                <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Name</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Description</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Actions</th>
                </tr>
              </thead>
              <tbody class="[&_tr:last-child]:border-0">
                @foreach ($permissions as $permission)
                  <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                    <td class="p-4 align-middle">{{ $permission->name }}</td>
                    <td class="p-4 align-middle"> {{ $permission->description ?? 'No description available' }}</td>
                    <td class="p-4 align-middle">
                      <div class="flex items-center gap-2">
                        <a href="{{ route('permissions.edit', $permission) }}"
                          class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:text-accent-foreground inline-flex h-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors hover:bg-orange-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                          </svg>
                        </a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
