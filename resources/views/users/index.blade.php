<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold tracking-tight">
      {{ __('Users Management') }}
    </h2>
  </x-slot>

  <div class="bg-white py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border shadow-sm">
        <div class="p-6">
          <div class="mb-6 flex items-center justify-between">
            <div class="space-y-1">
              <h3 class="text-2xl font-semibold leading-none tracking-tight">All Users</h3>
              <p class="text-muted-foreground text-sm">Manage system users here.</p>
            </div>
            <a href="{{ route('users.create') }}"
              class="flex items-center justify-center rounded-md border bg-gray-800 px-4 py-2 font-medium text-white hover:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="mr-2 text-white">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Add New User
            </a>
          </div>

          <div class="rounded-md border border-gray-200 px-4 py-6 pb-4">
            <div class="mb-6 flex flex-wrap gap-4">
              <form action="{{ route('users.index') }}" method="GET" class="flex w-full flex-wrap gap-4">
                <div class="flex-grow">
                  <input type="text" name="search" placeholder="Search by name or email"
                    value="{{ request('search') }}"
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
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">ID</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Name</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Email</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Created At</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Actions</th>
                </tr>
              </thead>
              <tbody class="[&_tr:last-child]:border-0">
                @foreach ($users as $user)
                  <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                    <td class="p-4 align-middle">{{ $user->id }}</td>
                    <td class="p-4 align-middle">{{ $user->name }}</td>
                    <td class="p-4 align-middle">{{ $user->email }}</td>
                    <td class="p-4 align-middle">{{ $user->created_at->format('d-M-Y - H:i') }}</td>
                    <td class="p-4 align-middle">
                      <div class="flex items-center gap-2">
                        <a href="{{ route('users.edit', $user->id) }}"
                          class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:text-accent-foreground inline-flex h-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors hover:bg-orange-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                          </svg>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')"
                            class="ring-offset-background focus-visible:ring-ring border-input hover:text-destructive-foreground inline-flex h-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors hover:bg-rose-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round">
                              <path d="M3 6h18" />
                              <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                              <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            </svg>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4">
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
