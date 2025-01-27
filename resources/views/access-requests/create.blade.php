<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-semibold leading-tight text-gray-900">
      {{ __('Create Access Request') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border">
        <div class="p-8">
          <form action="{{ route('access-requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Personal Information Section -->
            <div class="mb-8 rounded-lg border bg-gray-50/50 p-6">
              <h3 class="mb-4 text-lg font-semibold">Personal Information</h3>
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="name">Full Name</label>
                  <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                  @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="nation_id">Nation ID</label>
                  <input type="text" name="nation_id" id="nation_id" value="{{ old('nation_id') }}"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                  @error('nation_id')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="gender">Gender</label>
                  <select name="gender" id="gender"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                    <option value="" disabled selected>Select your gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                  </select>
                  @error('gender')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="dob">Date of Birth</label>
                  <input type="date" name="dob" id="dob" value="{{ old('dob') }}"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                  @error('dob')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>
                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="mobile">Mobile Number</label>
                  <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                  @error('mobile')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>
                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="email">Email</label>
                  <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                  @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Work Information Section -->
            <div class="mb-8 rounded-lg border bg-gray-50/50 p-6">
              <h3 class="mb-4 text-lg font-semibold">Work Information</h3>
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="record_card_number">Record Card Number</label>
                  <input type="text" name="record_card_number" id="record_card_number"
                    value="{{ old('record_card_number') }}"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                  @error('record_card_number')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="designation">Designation</label>
                  <select name="designation" id="designation"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                    <option value="" disabled selected>Select your designation</option>
                    <option value="manager" {{ old('designation') == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="developer" {{ old('designation') == 'developer' ? 'selected' : '' }}>Developer
                    </option>
                    <option value="designer" {{ old('designation') == 'designer' ? 'selected' : '' }}>Designer</option>
                    <option value="analyst" {{ old('designation') == 'analyst' ? 'selected' : '' }}>Analyst</option>
                  </select>
                  @error('designation')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="section">Section</label>
                  <select name="section" id="section"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                    <option value="" disabled selected>Select your section</option>
                    <option value="hr" {{ old('section') == 'hr' ? 'selected' : '' }}>HR</option>
                    <option value="it" {{ old('section') == 'it' ? 'selected' : '' }}>IT</option>
                    <option value="finance" {{ old('section') == 'finance' ? 'selected' : '' }}>Finance</option>
                    <option value="marketing" {{ old('section') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                  </select>
                  @error('section')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Access Information Section -->
            <div class="mb-8 rounded-lg border bg-gray-50/50 p-6">
              <h3 class="mb-4 text-lg font-semibold">Access Information</h3>
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="access_type">Type of Access Request</label>
                  <select name="access_type" id="access_type"
                    class="border-input ring-offset-background focus-visible:ring-ring flex h-10 w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                    <option value="" disabled selected>Select access type</option>
                    <option value="active_directory" {{ old('access_type') == 'active_directory' ? 'selected' : '' }}>
                      Active Directory/Domain/Intranet</option>
                    <option value="office_mail" {{ old('access_type') == 'office_mail' ? 'selected' : '' }}>Office
                      Mail
                    </option>
                    <option value="file_directory" {{ old('access_type') == 'file_directory' ? 'selected' : '' }}>File
                      Directory/Warehouse</option>
                    <option value="door_access" {{ old('access_type') == 'door_access' ? 'selected' : '' }}>Door
                      Access
                    </option>
                    <option value="hr_attendance" {{ old('access_type') == 'hr_attendance' ? 'selected' : '' }}>Human
                      Resource Attendance</option>
                    <option value="dermalog_passport"
                      {{ old('access_type') == 'dermalog_passport' ? 'selected' : '' }}>
                      E-Passport and Passport Card System (Dermalog)</option>
                    <option value="dermalog_citizen" {{ old('access_type') == 'dermalog_citizen' ? 'selected' : '' }}>
                      Maldives Citizen Screen System (Dermalog)</option>
                    <option value="pisces" {{ old('access_type') == 'pisces' ? 'selected' : '' }}>PISCES</option>
                    <option value="gems" {{ old('access_type') == 'gems' ? 'selected' : '' }}>GEMS/eGovernment
                    </option>
                    <option value="xapt" {{ old('access_type') == 'xapt' ? 'selected' : '' }}>Xapt</option>
                    <option value="imuga" {{ old('access_type') == 'imuga' ? 'selected' : '' }}>IMUGA</option>
                    <option value="hiraas" {{ old('access_type') == 'hiraas' ? 'selected' : '' }}>Hiraas</option>
                    <option value="fpps" {{ old('access_type') == 'fpps' ? 'selected' : '' }}>FPPS</option>
                    <option value="ecd_portal" {{ old('access_type') == 'ecd_portal' ? 'selected' : '' }}>ECD Portal
                    </option>
                  </select>
                  @error('access_type')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>
                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="request_type">Request type</label>
                  <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                      <input type="radio" name="request_type" value="grant permission"
                        {{ old('request_type') == 'grant permission' ? 'checked' : '' }}
                        class="border-input ring-offset-background focus-visible:ring-ring h-4 w-4 rounded border bg-white text-black focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                      <span class="ml-2">Grant Permission</span>
                    </label>
                    <label class="inline-flex items-center">
                      <input type="radio" name="request_type" value="modify permission"
                        {{ old('request_type') == 'modify permission' ? 'checked' : '' }}
                        class="border-input ring-offset-background focus-visible:ring-ring h-4 w-4 rounded border bg-white text-black focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                      <span class="ml-2">Modify Permission</span>
                    </label>
                    <label class="inline-flex items-center">
                      <input type="radio" name="request_type" value="revoke permission"
                        {{ old('request_type') == 'revoke permission' ? 'checked' : '' }}
                        class="border-input ring-offset-background focus-visible:ring-ring h-4 w-4 rounded border bg-white text-black focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
                      <span class="ml-2">Revoke Permission</span>
                    </label>
                  </div>
                  @error('request_type')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>

                <div class="space-y-2">
                  <label class="text-sm font-medium leading-none" for="reason">Reason for Access</label>
                  <textarea name="reason" id="reason" rows="4"
                    class="border-input ring-offset-background focus-visible:ring-ring flex min-h-[100px] w-full rounded-md border bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">{{ old('reason') }}</textarea>
                  @error('reason')
                    <span class="text-red-500">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>


            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4">
              <a href="{{ route('access-requests.index') }}"
                class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:bg-accent hover:text-accent-foreground inline-flex h-10 items-center justify-center rounded-md border px-4 py-2 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                Cancel
              </a>
              <button type="submit"
                class="rounded-lg bg-black px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300">
                Create Access Request
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
