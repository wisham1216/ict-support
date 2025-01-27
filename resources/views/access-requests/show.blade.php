<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold tracking-tight">
      {{ __('View Access Request') }}
    </h2>
  </x-slot>

  <div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="rounded-lg border bg-card text-card-foreground ">
        <div class="p-6">
          <div class="flex items-center justify-between mb-6">
            <div class="space-y-1">
              <h3 class="text-2xl font-semibold leading-none tracking-tight">Access Request #{{ $access->id }}</h3>
              <p class="text-sm text-muted-foreground">View access request details and updates.</p>
            </div>
            <div class="flex items-center gap-2">
              <a href="{{ route('access-requests.edit', $access->id) }}"
                 class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none ring-offset-background bg-primary text-primary-foreground hover:bg-primary/90 h-10 py-2 px-4">
                Edit Ticket
              </a>
              <a href="{{ route('access-requests.index') }}"
                 class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4">
                Back to List
              </a>
            </div>
          </div>

          <div class="grid gap-6">
            <div class="rounded-lg border bg-card">
              <div class="p-6">
                <h4 class="text-lg font-semibold mb-4">Access Request Information</h4>
                <dl class="grid gap-4">
                  <div class="grid grid-cols-3 gap-4">
                    <dt class="font-medium">Name</dt>
                    <dd class="col-span-2">{{ $access->name }}</dd>http://ict-support.test/access-requests
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <dt class="font-medium">Email</dt>
                    <dd class="col-span-2">{{ $access->email }}</dd>
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <dt class="font-medium">Reason</dt>
                    <dd class="col-span-2 whitespace-pre-wrap">{{ $access->reason }}</dd>
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <dt class="font-medium">Status</dt>
                    <dd class="col-span-2">
                      <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                        {{ $access->status === 'pending' ? 'bg-green-50 text-green-700 border border-green-300' : '' }}
                        {{ $access->status === 'approved' ? 'bg-yellow-50 text-yellow-700 border border-yellow-300' : '' }}
                        {{ $access->status === 'rejected' ? 'bg-red-50 text-red-700 border border-red-300' : '' }}">
                        {{ ucfirst(str_replace('_', ' ', $access->status)) }}
                      </span>
                    </dd>
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <dt class="font-medium">Created</dt>
                    <dd class="col-span-2">{{ $access->created_at->format('F j, Y g:i A') }}</dd>
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <dt class="font-medium">Last Updated</dt>
                    <dd class="col-span-2">{{ $access->updated_at->format('F j, Y g:i A') }}</dd>
                  </div>
                </dl>

              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
