<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-semibold leading-tight text-gray-900">
      {{ __('Create Ticket') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-card text-card-foreground rounded-lg border">
        <div class="p-8">
          <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            @csrf

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="department_name">
                Department Name
              </label>
              <select name="department_name" id="department_name"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                <option value="" disabled selected>Select department</option>
                <option value="Information Technology"
                  {{ old('department_name') == 'Information Technology' ? 'selected' : '' }}>Information Technology
                </option>
                <option value="Human Resources" {{ old('department_name') == 'Human Resources' ? 'selected' : '' }}>
                  Human Resources</option>
                <option value="Finance" {{ old('department_name') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="Marketing" {{ old('department_name') == 'Marketing' ? 'selected' : '' }}>Marketing
                </option>
                <option value="Operations" {{ old('department_name') == 'Operations' ? 'selected' : '' }}>Operations
                </option>
                <option value="Sales" {{ old('department_name') == 'Sales' ? 'selected' : '' }}>Sales</option>
                <option value="Customer Service" {{ old('department_name') == 'Customer Service' ? 'selected' : '' }}>
                  Customer Service</option>
              </select>
              @error('department_name')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="contact_person">
                Contact Person
              </label>
              <input type="text" name="contact_person" id="contact_person"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                value="{{ old('contact_person') }}">
              @error('contact_person')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="category">
                Category
              </label>
              <select name="category" id="category"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                <option value="" disabled selected>Select category</option>
                <option value="hardware" {{ old('category') == 'hardware' ? 'selected' : '' }}>Hardware</option>
                <option value="software" {{ old('category') == 'software' ? 'selected' : '' }}>Software</option>
                <option value="network" {{ old('category') == 'network' ? 'selected' : '' }}>Network</option>
                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('category')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="summary">
                Summary
              </label>
              <input type="text" name="summary" id="summary"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex h-10 w-full rounded-md border px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                value="{{ old('summary') }}">
              @error('summary')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-span-2 space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="description">
                Description
              </label>
              <textarea name="description" id="description" rows="4"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex min-h-[100px] w-full rounded-md border px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('description') }}</textarea>
              @error('description')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-span-2 space-y-2">
              <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="attachment">
                Attachment
              </label>
              <input type="file" name="attachment" id="attachment"
                class="border-input bg-background ring-offset-background placeholder:text-muted-foreground focus-visible:ring-ring flex w-full rounded-md border px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
              @error('attachment')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-span-2 flex items-center justify-end space-x-4 pt-4">
              <a href="{{ route('tickets.index') }}"
                class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:bg-accent hover:text-accent-foreground inline-flex h-10 items-center justify-center rounded-md border px-4 py-2 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                Cancel
              </a>
              <button type="submit"
                class="rounded-lg bg-black px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300">
                Create Ticket
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
