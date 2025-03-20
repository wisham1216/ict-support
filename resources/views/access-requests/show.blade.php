<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Access Request Details</h2>
        <p class="mt-1 text-sm text-gray-600">Request #{{ $access->id }}</p>
      </div>
      <div class="flex flex-col items-stretch gap-3 sm:flex-row sm:items-center">
        <a href="{{ route('access-requests.edit', $access->id) }}"
          class="inline-flex items-center justify-center gap-2 rounded-md bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
          </svg>
          Edit Request
        </a>
        <a href="{{ route('access-requests.index') }}"
          class="inline-flex items-center justify-center gap-2 rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-600 shadow-sm ring-1 ring-inset ring-gray-300 transition-colors hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
          </svg>
          Back to List
        </a>
      </div>
    </div>
  </x-slot>

  <div class="py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <!-- Status Bar - Update the status colors -->
      <div class="mb-6 overflow-hidden rounded-lg border border-gray-200 bg-white">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
            <div class="flex flex-wrap items-center gap-4">
              <!-- Status Badge -->
              <div class="flex items-center gap-2">
                <span
                  class="{{ $access->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border border-yellow-300' : '' }} {{ $access->status === 'granted' ? 'bg-green-50 text-green-700 border border-green-300' : '' }} {{ $access->status === 'rejected' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} {{ $access->status === 'revoked' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold">
                  {{ ucfirst($access->status) }}
                </span>
                <!-- Timestamp -->
                {{-- <span
                  class="{{ $access->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border border-yellow-300' : '' }} {{ $access->status === 'granted' ? 'bg-green-50 text-green-700 border border-green-300' : '' }} {{ $access->status === 'rejected' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} {{ $access->status === 'revoked' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} text-xs">
                  @if ($access->status === 'pending')
                    {{ $access->created_at->format('d-M-Y - H:i') }}
                  @else
                    {{ $access->updated_at->format('d-M-Y - H:i') }}
                  @endif
                </span> --}}
              </div>

              <!-- Request Type Badge -->
              <span
                class="{{ $access->request_type === 'new' ? 'bg-blue-50 text-blue-700 border border-blue-300' : '' }} {{ $access->request_type === 'modify' ? 'bg-purple-50 text-purple-700 border border-purple-300' : '' }} {{ $access->request_type === 'extend' ? 'bg-indigo-50 text-indigo-700 border border-indigo-300' : '' }} {{ $access->request_type === 'revoke' ? 'bg-red-50 text-red-700 border border-red-300' : '' }} {{ $access->request_type === 'temporary' ? 'bg-orange-50 text-orange-700 border border-orange-300' : '' }} items-centery inline-flex rounded-lg px-2.5 py-0.5 text-xs font-semibold">
                {{ App\Models\Access::REQUEST_TYPES[$access->request_type] ?? 'Unknown' }}
              </span>
            </div>

            <!-- Status Change Dropdown with matching focus colors -->
            <form action="{{ route('access-requests.updateStatus', $access->id) }}" method="POST"
              class="w-full sm:w-auto">
              @csrf
              <select name="status" onchange="this.form.submit()"
                class="{{ $access->status === 'pending' ? 'focus:border-yellow-500 focus:ring-yellow-500' : '' }} {{ $access->status === 'granted' ? 'focus:border-green-500 focus:ring-green-500' : '' }} {{ $access->status === 'rejected' ? 'focus:border-red-500 focus:ring-red-500' : '' }} {{ $access->status === 'revoked' ? 'focus:border-red-500 focus:ring-red-500' : '' }} w-full rounded-md border-gray-300 text-sm text-gray-600 shadow-sm transition-colors focus:ring-2 focus:ring-offset-2 sm:w-auto">
                <option value="" disabled>Change Status</option>
                <option value="pending" {{ $access->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="granted" {{ $access->status === 'granted' ? 'selected' : '' }}>Granted</option>
                <option value="rejected" {{ $access->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="revoked" {{ $access->status === 'revoked' ? 'selected' : '' }}>Revoked</option>
              </select>
            </form>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Left Column -->
        <div class="col-span-1 space-y-6 lg:col-span-2">
          <!-- Basic Information - Updated design -->
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Basic Information</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                <div>
                  <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->name }}</dd>
                </div>

                <div>
                  <dt class="text-sm font-medium text-gray-500">Nation ID</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->nation_id }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">Gender</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($access->gender) }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ $access->dob ? $access->dob->format('F j, Y') : 'Not provided' }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">Record Card Number</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->record_card_number }}</dd>
                </div>

                <div>
                  <dt class="text-sm font-medium text-gray-500">Email</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->email }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">Mobile</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->mobile }}</dd>
                </div>

                <div>
                  <dt class="text-sm font-medium text-gray-500">Section</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->section }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">Designation</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->designation }}</dd>
                </div>

              </dl>
            </div>
          </div>

          <!-- Access Request Information - Updated design -->
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Access Request Information</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">


                <div class="">
                  <dt class="text-sm font-medium text-gray-500">Requested Access</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ optional($access->system)->name ?? 'Not assigned' }}</dd>
                </div>
                <div class="">
                  <dt class="text-sm font-medium text-gray-500">Reason for Access</dt>
                  <dd class="mt-1 whitespace-pre-wrap text-sm text-gray-900">{{ $access->reason }}</dd>
                </div>
                <div>
                  <dt class="text-sm font-medium text-gray-500">System Name</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $access->system->name }}</dd>
                </div>

              </dl>
              @if ($access->system->accesses->count() > 0)
                <div class="mt-6 border-t border-gray-100 pt-6">
                  <dt class="text-sm font-medium text-gray-900">Available Access</dt>
                  <dd class="mt-2">
                    <div class="flex flex-wrap gap-2">
                      @foreach ($access->system->accesses as $systemAccess)
                        <span
                          class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                          {{ $systemAccess->access_name }}
                        </span>
                      @endforeach
                    </div>
                  </dd>
                </div>
              @endif

              @if ($access->systemAccesses->count() > 0)
                <div class="mt-6 border-t border-gray-100 pt-6">
                  <dt class="text-sm font-medium text-gray-900">Selected Access</dt>
                  <dd class="mt-2">
                    <div class="flex flex-wrap gap-2">
                      @foreach ($access->systemAccesses as $systemAccess)
                        <span
                          class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-700/10">
                          {{ $systemAccess->access_name }}
                        </span>
                      @endforeach
                    </div>
                  </dd>
                </div>
              @endif
            </div>

          </div>
        </div>

        <!-- Right Column -->
        <div class="col-span-1 space-y-6">
          <!-- Timeline - Updated design -->
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Request Timeline</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              <div class="flow-root">
                <ul role="list" class="-mb-8">
                  <!-- Created/Pending -->
                  <li>
                    <div class="relative pb-6">
                      <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                      <div class="relative flex space-x-3">
                        <div>
                          <span
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-yellow-50 ring-1 ring-yellow-300">
                            <svg class="h-5 w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                          </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                          <div>
                            <p class="text-sm text-gray-500">Request Created</p>
                          </div>
                          <div class="whitespace-nowrap text-right text-sm text-gray-500">
                            {{ $access->created_at->format('M j, Y') }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                  <!-- Granted -->
                  @if ($access->granted_at)
                    <li>
                      <div class="relative pb-6">
                        <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                        <div class="relative flex space-x-3">
                          <div>
                            <span
                              class="flex h-8 w-8 items-center justify-center rounded-full bg-green-50 ring-1 ring-green-300">
                              <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                            </span>
                          </div>
                          <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                            <div>
                              <p class="text-sm text-gray-500">Granted by
                                {{ optional($access->grantedBy)->name ?? 'System' }}</p>
                              @if ($access->grantedBy)
                                <p class="text-xs text-gray-400">Role:
                                  {{ optional($access->grantedBy)->roles->first()->name ?? 'No Role' }}</p>
                              @endif
                            </div>
                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                              {{ $access->granted_at->format('M j, Y') }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  @endif

                  <!-- Modified -->
                  @if ($access->modified_at)
                    <li>
                      <div class="relative pb-6">
                        <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                        <div class="relative flex space-x-3">
                          <div>
                            <span
                              class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 ring-1 ring-blue-300">
                              <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>
                            </span>
                          </div>
                          <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                            <div>
                              <p class="text-sm text-gray-500">Modified by
                                {{ optional($access->modifiedBy)->name ?? 'System' }}</p>
                            </div>
                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                              {{ $access->modified_at->format('M j, Y') }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  @endif

                  <!-- Rejected/Revoked -->
                  @if ($access->revoked_at || $access->status === 'rejected')
                    <li>
                      <div class="relative pb-4">
                        <div class="relative flex space-x-3">
                          <div>
                            <span
                              class="flex h-8 w-8 items-center justify-center rounded-full bg-red-50 ring-1 ring-red-300">
                              <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                              </svg>
                            </span>
                          </div>
                          <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                            <div>
                              <p class="text-sm text-gray-500">Revoked by
                                {{ optional($access->revokedBy)->name ?? 'System' }}</p>
                            </div>
                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                              {{ $access->revoked_at ? $access->revoked_at->format('M j, Y') : 'N/A' }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>

          <!-- Comments - Updated design -->
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
              <h3 class="text-base font-semibold leading-6 text-gray-900">Comments</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
              <!-- Comment Form -->
              <form action="{{ route('access-requests.comments.store', $access->id) }}" method="POST"
                class="mb-6">
                @csrf
                <div class="space-y-2">
                  <textarea name="comment" id="comment" rows="3" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    placeholder="Add your comment..."></textarea>
                  <button type="submit"
                    class="inline-flex items-center rounded-md bg-black px-3.5 py-2 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Post Comment
                  </button>
                </div>
              </form>

              <!-- Comments List -->
              <div class="space-y-4">
                @forelse($access->comments as $comment)
                  <div class="rounded-lg bg-gray-50 p-4">
                    <div class="flex space-x-3">
                      <div class="flex-1 space-y-1">
                        <div class="flex items-center justify-between">
                          <h3 class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</h3>
                          <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="whitespace-pre-wrap text-sm text-gray-700">{{ $comment->comment }}</p>
                      </div>
                    </div>
                  </div>
                @empty
                  <p class="text-center text-sm text-gray-500">No comments yet</p>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

{{-- @can('access-request.grant')
    <button type="submit" class="btn btn-success">Grant Access</button>
@endcan

@can('access-request.reject')
    <button type="submit" class="btn btn-danger">Reject Access</button>
@endcan

@can('access-request.modify')
    <button type="submit" class="btn btn-warning">Modify Access</button>
@endcan

@can('access-request.revoke')
    <button type="submit" class="btn btn-danger">Revoke Access</button>
@endcan

<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Access Request Details</h2>

        <div class="mb-4">
            <p class="text-gray-600">Section Type: {{ ucfirst($access->section_type) }}</p>
            <p class="text-gray-600">Status: {{ ucfirst($access->status) }}</p>

            @if($access->requiresSectionHeadApproval())
                @if($sectionHead = $access->sectionHead())
                    <p class="text-gray-600">Requires approval from: {{ $sectionHead->user->name }}</p>
                @else
                    <p class="text-red-600">No section head assigned for this section</p>
                @endif
            @endif
        </div>

        @if(auth()->user()->can('access-request.grant') &&
            (!$access->requiresSectionHeadApproval() ||
            ($access->sectionHead() && $access->sectionHead()->user_id === auth()->id())))
            <form action="{{ route('access-requests.grant', $access) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                    Grant Access
                </button>
            </form>
        @endif
    </div>
</div> --}}
