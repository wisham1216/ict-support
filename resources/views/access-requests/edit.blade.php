<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-semibold leading-tight text-gray-900">
      {{ __('Edit Access Request') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border shadow-sm">
        <div class="p-8">
          <form action="{{ route('access-requests.update', $access->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Personal Information -->
            <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6">
              <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>

              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                  <label for="name" class="text-sm font-medium leading-none">Name</label>
                  <input type="text" name="name" id="name" value="{{ old('name', $access->name) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="space-y-2">
                  <label for="nation_id" class="text-sm font-medium leading-none">Nation ID</label>
                  <input type="text" name="nation_id" id="nation_id" value="{{ old('nation_id', $access->nation_id) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="space-y-2">
                  <label for="gender" class="text-sm font-medium leading-none">Gender</label>
                  <select name="gender" id="gender" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="male" {{ old('gender', $access->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $access->gender) === 'female' ? 'selected' : '' }}>Female</option>
                  </select>
                </div>

                <div class="space-y-2">
                  <label for="dob" class="text-sm font-medium leading-none">Date of Birth</label>
                  <input type="date" name="dob" id="dob" value="{{ old('dob', $access->dob?->format('Y-m-d')) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
              </div>
            </div>

            <!-- Work Information -->
            <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6">
              <h3 class="text-lg font-medium text-gray-900">Work Information</h3>

              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                  <label for="record_card_number" class="text-sm font-medium leading-none">Record Card Number</label>
                  <input type="text" name="record_card_number" id="record_card_number"
                    value="{{ old('record_card_number', $access->record_card_number) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="space-y-2">
                  <label for="designation" class="text-sm font-medium leading-none">Designation</label>
                  <input type="text" name="designation" id="designation"
                    value="{{ old('designation', $access->designation) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="space-y-2">
                  <label for="section" class="text-sm font-medium leading-none">Section</label>
                  <input type="text" name="section" id="section"
                    value="{{ old('section', $access->section) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
              </div>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6">
              <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>

              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                  <label for="mobile" class="text-sm font-medium leading-none">Mobile</label>
                  <input type="text" name="mobile" id="mobile"
                    value="{{ old('mobile', $access->mobile) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="space-y-2">
                  <label for="email" class="text-sm font-medium leading-none">Email</label>
                  <input type="email" name="email" id="email"
                    value="{{ old('email', $access->email) }}" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
              </div>
            </div>

            <!-- Access Request Details -->
            <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6">
              <h3 class="text-lg font-medium text-gray-900">Access Request Details</h3>

              <div class="space-y-6">
                <div class="space-y-2">
                  <label for="access_type" class="text-sm font-medium leading-none">System</label>
                  <select name="access_type" id="access_type" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select a system</option>
                    @foreach($systems as $system)
                      <option value="{{ $system->id }}"
                        {{ old('access_type', $access->access_type) == $system->id ? 'selected' : '' }}>
                        {{ $system->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="space-y-2">
                  <label for="request_type" class="text-sm font-medium leading-none">Request Type</label>
                  <select name="request_type" id="request_type" required
                    class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach(App\Models\Access::REQUEST_TYPES as $value => $label)
                      <option value="{{ $value }}"
                        {{ old('request_type', $access->request_type) === $value ? 'selected' : '' }}>
                        {{ $label }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="space-y-2">
                  <label for="reason" class="text-sm font-medium leading-none">Reason for Access</label>
                  <textarea name="reason" id="reason" rows="4" required
                    class="flex w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('reason', $access->reason) }}</textarea>
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none">Access Permissions</label>
                  <div id="accesses-container" class="mt-2 space-y-2">
                    @foreach($access->systemAccesses as $systemAccess)
                      <div class="flex items-center">
                        <input type="checkbox" name="accesses[]" value="{{ $systemAccess->id }}"
                          class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                          checked>
                        <label class="ml-2 text-sm text-gray-700">{{ $systemAccess->access_name }}</label>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end space-x-4">
              <a href="{{ route('access-requests.index') }}"
                class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Cancel
              </a>
              <button type="submit"
                class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update Access Request
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    document.getElementById('access_type').addEventListener('change', function() {
      const systemId = this.value;
      if (systemId) {
        fetch(`/api/systems/${systemId}/accesses`)
          .then(response => response.json())
          .then(data => {
            const container = document.getElementById('accesses-container');
            container.innerHTML = '';
            data.forEach(access => {
              const div = document.createElement('div');
              div.className = 'flex items-center';
              div.innerHTML = `
                <input type="checkbox" name="accesses[]" value="${access.id}"
                  class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label class="ml-2 text-sm text-gray-700">${access.access_name}</label>
              `;
              container.appendChild(div);
            });
          });
      }
    });
  </script>
  @endpush
</x-app-layout>
