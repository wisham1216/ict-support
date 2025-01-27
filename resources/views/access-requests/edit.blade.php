<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-semibold leading-tight text-gray-900">
      {{ __('Edit Access Request') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border shadow-sm">
        <div class="p-8">
          <form action="{{ route('access-requests.update', $access->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="name">
                Name
              </label>
              <input type="text" name="name" id="name"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                value="{{ old('name', $access->name) }}" required>
            </div>

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="email">
                Email
              </label>
              <input type="text" name="email" id="email"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                value="{{ old('email', $access->email) }}" required>
            </div>

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="access_type">
                Type of Access Request
              </label>
              <select name="access_type" id="access_type"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                <option value="" disabled>Select access type</option>
                <option value="active_directory"
                  {{ old('access_type', $access->access_type) == 'active_directory' ? 'selected' : '' }}>Active
                  Directory/Domain/Intranet</option>
                <option value="office_mail"
                  {{ old('access_type', $access->access_type) == 'office_mail' ? 'selected' : '' }}>Office Mail</option>
                <option value="file_directory"
                  {{ old('access_type', $access->access_type) == 'file_directory' ? 'selected' : '' }}>File
                  Directory/Warehouse</option>
                <option value="door_access"
                  {{ old('access_type', $access->access_type) == 'door_access' ? 'selected' : '' }}>Door Access</option>
                <option value="hr_attendance"
                  {{ old('access_type', $access->access_type) == 'hr_attendance' ? 'selected' : '' }}>Human Resource
                  Attendance</option>
                <option value="dermalog_passport"
                  {{ old('access_type', $access->access_type) == 'dermalog_passport' ? 'selected' : '' }}>E-Passport and
                  Passport Card System (Dermalog)</option>
                <option value="dermalog_citizen"
                  {{ old('access_type', $access->access_type) == 'dermalog_citizen' ? 'selected' : '' }}>Maldives
                  Citizen Screen System (Dermalog)</option>
                <option value="pisces" {{ old('access_type', $access->access_type) == 'pisces' ? 'selected' : '' }}>
                  PISCES</option>
                <option value="gems" {{ old('access_type', $access->access_type) == 'gems' ? 'selected' : '' }}>
                  GEMS/eGovernment</option>
                <option value="xapt" {{ old('access_type', $access->access_type) == 'xapt' ? 'selected' : '' }}>Xapt
                </option>
                <option value="imuga" {{ old('access_type', $access->access_type) == 'imuga' ? 'selected' : '' }}>
                  IMUGA</option>
                <option value="hiraas" {{ old('access_type', $access->access_type) == 'hiraas' ? 'selected' : '' }}>
                  Hiraas</option>
                <option value="fpps" {{ old('access_type', $access->access_type) == 'fpps' ? 'selected' : '' }}>FPPS
                </option>
                <option value="ecd_portal"
                  {{ old('access_type', $access->access_type) == 'ecd_portal' ? 'selected' : '' }}>ECD Portal</option>
              </select>
              @error('access_type')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="reason">
                Reason
              </label>
              <textarea name="reason" id="reason" rows="4"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex min-h-[100px] w-full rounded-md border px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                required>{{ old('reason', $access->reason) }}</textarea>
            </div>


            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="status">
                Status
              </label>
              <select name="status" id="status"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                <option value="pending" {{ $access->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $access->status === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $access->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
              <a href="{{ route('access-requests.index') }}"
                class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:bg-accent hover:text-accent-foreground inline-flex h-10 items-center justify-center rounded-md border px-4 py-2 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                Cancel
              </a>
              <button type="submit"
                class="ring-offset-background focus-visible:ring-ring bg-primary text-primary-foreground hover:bg-primary/90 inline-flex h-10 items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                Update Access Request
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
