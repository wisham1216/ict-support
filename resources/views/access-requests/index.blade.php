<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold tracking-tight">
      {{ __('Access Requests') }}
    </h2>
  </x-slot>
  <div class="bg-white py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border shadow-sm">
        <div class="p-6">
          <div class="mb-6 flex items-center justify-between">
            <div class="space-y-1">
              <h3 class="text-2xl font-semibold leading-none tracking-tight">All Access Requests</h3>
              <p class="text-muted-foreground text-sm">Manage your access requests here.</p>
            </div>
            <a href="{{ route('access-requests.create') }}"
              class="flex items-center justify-center rounded-md border bg-gray-800 px-4 py-2 font-medium text-white hover:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="mr-2 text-white">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Create Access Request
            </a>
          </div>
          <!--add filtration of the data-->
          <div class="rounded-md border border-gray-200 px-4 py-6 pb-4">
            <div class="mb-6 flex flex-wrap gap-4">
              <form action="{{ route('access-requests.index') }}" method="GET" class="flex w-full flex-wrap gap-4">
                <div class="flex-grow">
                  <input type="text" name="search" placeholder="Search by name, email, or reason"
                    value="{{ request('search') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="flex-grow">
                  <select name="status" id="status"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                  </select>
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
            <div class="mb-4 grid gap-4 md:grid-cols-2">
              <select name="status" id="status-filter" class="w-full rounded border p-2 px-8">
                <option value="all">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
              <select name="section" id="section-filter" class="w-full rounded border p-2 px-8">
                <option value="all">All Sections</option>
                @foreach ($sections as $section)
                  <option value="{{ $section }}" {{ request('section') === $section ? 'selected' : '' }}>
                    {{ ucfirst($section) }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <script>
            document.getElementById('status-filter').addEventListener('change', function() {
              updateFilters();
            });
            document.getElementById('section-filter').addEventListener('change', function() {
              updateFilters();
            });

            function updateFilters() {
              const status = document.getElementById('status-filter').value;
              const section = document.getElementById('section-filter').value;
              const searchParams = new URLSearchParams(window.location.search);
              if (status !== 'all') {
                searchParams.set('status', status);
              } else {
                searchParams.delete('status');
              }
              if (section !== 'all') {
                searchParams.set('section', section);
              } else {
                searchParams.delete('section');
              }
              window.location.search = searchParams.toString();
            }
          </script>
          <div class="relative w-full overflow-auto">
            <table class="w-full caption-bottom text-sm">
              <thead class="[&_tr]:border-b">
                <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">ID</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Name</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Section</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Email</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Status</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Created At</th>
                  <th class="text-muted-foreground h-12 px-4 text-left align-middle font-medium">Actions</th>
                </tr>
              </thead>
              <tbody class="[&_tr:last-child]:border-0">
                @foreach ($accessRequests as $accessRequest)
                  <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                    <td class="p-4 align-middle">{{ $accessRequest->id }}</td>
                    <td class="p-4 align-middle">{{ $accessRequest->name }}</td>
                    <td class="p-4 align-middle uppercase">{{ $accessRequest->section }}</td>
                    <td class="p-4 align-middle">{{ $accessRequest->email }}</td>
                    <td class="p-4 align-middle">
                      <span
                        class="{{ $accessRequest->status === 'pending' ? 'bg-green-50 text-green-700 border border-green-300' : '' }} {{ $accessRequest->status === 'approved' ? 'bg-yellow-50 text-yellow-700 border border-yellow-300' : '' }} {{ $accessRequest->status === 'rejected' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold">
                        {{ ucfirst(str_replace('_', ' ', $accessRequest->status)) }}
                      </span>
                    </td>
                    <td class="p-4 align-middle">{{ $accessRequest->created_at->format('d-M-Y - H:i') }}</td>
                    <td class="p-4 align-middle">
                      <div class="flex items-center gap-2">
                        <a href="{{ route('access-requests.show', $accessRequest) }}"
                          class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:bg-gree hover:text-accent-foreground inline-flex h-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                          </svg>
                        </a>
                        <a href="{{ route('access-requests.edit', $accessRequest) }}"
                          class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:text-accent-foreground inline-flex h-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors hover:bg-orange-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                          </svg>
                        </a>
                        <form action="{{ route('access-requests.destroy', $accessRequest) }}" method="POST"
                          class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" onclick="return confirm('Are you sure?')"
                            class="ring-offset-background focus-visible:ring-ring border-input hover:text-destructive-foreground inline-flex h-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors hover:bg-rose-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round">
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
            {{ $accessRequests->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
