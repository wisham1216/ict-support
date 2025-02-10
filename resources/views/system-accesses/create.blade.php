    <x-app-layout>
      <x-slot name="header">
        <div class="flex items-center justify-between">
          <h2 class="text-3xl font-bold tracking-tight">
            {{ __('Create New System Access') }}
          </h2>
          <a href="{{ route('system-accesses.index') }}" class="flex items-center text-black hover:text-gray-700">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
          </a>
        </div>
      </x-slot>

      <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="bg-card text-card-foreground rounded-lg border shadow-sm">
            <div class="p-6">
              <form action="{{ route('system-accesses.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                  <label for="system_id" class="block text-sm font-medium text-gray-700">System:</label>
                  <select name="system_id" id="system_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach ($systems as $system)
                      <option value="{{ $system->id }}">{{ $system->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-4">
                  <label for="access_name" class="block text-sm font-medium text-gray-700">Access Name:</label>
                  <input type="text" name="access_name" id="access_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                  <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                  <textarea name="description" id="description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="flex justify-end">
                  <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create
                    System Access</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </x-app-layout>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const systemSelect = document.getElementById('system_id');
        const accessNameInput = document.getElementById('access_name');
        const descriptionTextarea = document.getElementById('description');

        systemSelect.addEventListener('change', function() {
          const systemId = this.value;

          fetch(`/api/systems/${systemId}`)
            .then(response => response.json())
            .then(data => {
              accessNameInput.value = data.access_name || '';
              descriptionTextarea.value = data.description || '';
            })
            .catch(error => console.error('Error fetching system data:', error));
        });
      });
    </script>
