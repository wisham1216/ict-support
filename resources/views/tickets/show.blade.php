<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold tracking-tight">
      {{ __('View Ticket') }}
    </h2>
  </x-slot>

  <div class="bg-white py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border">
        <div class="p-6">
          <div class="mb-6 flex items-center justify-between">
            <div class="space-y-1">
              <h3 class="text-2xl font-semibold leading-none tracking-tight">Ticket #{{ $ticket->id }}</h3>
              <p class="text-muted-foreground text-sm">View ticket details and updates.</p>
            </div>
            <div class="flex items-center gap-2">
              <a href="{{ route('tickets.edit', $ticket) }}"
                class="focus-visible:ring-ring ring-offset-background bg-primary text-primary-foreground hover:bg-primary/90 inline-flex h-10 items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                Edit Ticket
              </a>
              <a href="{{ route('tickets.index') }}"
                class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:bg-accent hover:text-accent-foreground inline-flex h-10 items-center justify-center rounded-md border px-4 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                Back to List
              </a>
            </div>
          </div>

          <div class="grid gap-6">
            <div class="bg-card rounded-lg border">
              <div class="p-6">
                <div class="mb-6 flex items-center justify-between">
                  <h4 class="text-lg font-semibold">Ticket Information</h4>
                  <div class="flex items-center gap-4">
                    <span
                      class="{{ $ticket->status === 'open' ? 'bg-green-50 text-green-700 border border-green-300' : '' }} {{ $ticket->status === 'in_progress' ? 'bg-yellow-50 text-yellow-700 border border-yellow-300' : '' }} {{ $ticket->status === 'closed' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                      {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>

                    <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" class="inline">
                      @csrf
                      <select name="status" onchange="this.form.submit()"
                        class="h-9 rounded-md border px-3 text-sm text-gray-600">
                        <option value="" disabled>Change Status</option>
                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In
                          Progress</option>
                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                      </select>
                    </form>
                  </div>
                </div>

                <!-- Main Info -->
                <div class="mb-8 rounded-lg border border-gray-100 bg-gray-50/50 p-6">
                  <h3 class="mb-2 text-xl font-medium">{{ $ticket->summary }}</h3>
                  <div class="mb-4 flex items-center gap-4 text-sm text-gray-500">
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                      </svg>
                      {{ $ticket->contact_person }}
                    </span>
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                      </svg>
                      {{ $ticket->department_name }}
                    </span>
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                      </svg>
                      {{ $ticket->created_at->format('F j, Y g:i A') }}
                    </span>
                  </div>
                  <p class="whitespace-pre-wrap text-gray-600">{{ $ticket->description }}</p>
                </div>

                <!-- Assignment Section -->
                <div class="mb-8 grid grid-cols-2 gap-6">
                  <div class="rounded-lg border p-4">
                    <h4 class="mb-3 text-sm font-medium text-gray-500">Assignment</h4>
                    <div class="flex items-center justify-between">
                      <div class="flex items-center gap-2">
                        @if ($ticket->assignedTo)
                          <span
                            class="inline-flex items-center rounded-full border border-blue-300 bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                            {{ $ticket->assignedTo->name }}
                          </span>
                        @else
                          <span
                            class="inline-flex items-center rounded-full border border-gray-300 bg-gray-50 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                            Unassigned
                          </span>
                        @endif
                      </div>
                      <form action="{{ route('tickets.assign', $ticket) }}" method="POST" class="inline">
                        @csrf
                        <select name="assigned_to" onchange="this.form.submit()"
                          class="h-9 rounded-md border px-3 text-sm text-gray-600">
                          <option value="">Reassign...</option>
                          @foreach ($users ?? [] as $user)
                            <option value="{{ $user->id }}"
                              {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
                              {{ $user->name }}
                            </option>
                          @endforeach
                        </select>
                      </form>
                    </div>
                  </div>

                  <!-- Attachment Section -->
                  <div class="rounded-lg border p-4">
                    <h4 class="mb-3 text-sm font-medium text-gray-500">Attachment</h4>
                    @if ($ticket->attachment)
                      <a href="{{ Storage::url($ticket->attachment) }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-md bg-gray-800 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round">
                          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                          <polyline points="7 10 12 15 17 10"></polyline>
                          <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Download Attachment
                      </a>
                    @else
                      <span class="text-sm text-gray-500">No attachment available</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            @if ($ticket->comments && $ticket->comments->count() > 0)
              <div class="bg-card rounded-lg border">
                <div class="p-6">
                  <h4 class="mb-6 text-lg font-semibold">Timeline</h4>
                  <div class="relative">
                    <!-- Timeline line -->
                    <div class="absolute left-4 top-0 h-full w-0.5 bg-gray-200"></div>

                    <div class="space-y-8">
                      @foreach ($ticket->comments as $comment)
                        <div class="relative flex gap-6">
                          <!-- Timeline dot -->
                          <div
                            class="relative mt-1 flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                          </div>

                          <div class="flex-1">
                            <div class="mb-1 flex items-center gap-2">
                              <span class="font-semibold">{{ $comment->user->name }}</span>
                              <span class="text-muted-foreground text-sm">
                                {{ $comment->created_at->format('F j, Y g:i A') }}
                              </span>
                            </div>
                            <div class="rounded-lg border bg-gray-50 p-4">
                              <p class="text-sm">{{ $comment->content }}</p>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            @endif

            <!-- Add Comment Form -->
            <div class="bg-card rounded-lg border">
              <div class="p-6">
                <h4 class="mb-4 text-lg font-semibold">Add Comment</h4>
                <form action="{{ route('comments.store', $ticket->id) }}" method="POST" class="space-y-4">
                  @csrf
                  <div>
                    <textarea name="content" rows="3" required
                      class="w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:outline-none"
                      placeholder="Type your comment here..."></textarea>
                  </div>
                  <div class="flex justify-end">
                    <button type="submit"
                      class="flex items-center justify-center rounded-md bg-gray-800 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="mr-2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                      </svg>
                      Post Comment
                    </button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
