<x-guest-layout>

  <div class="relative flex min-h-screen items-center justify-center p-4">
    <div class="w-full max-w-[1000px]">


      <!-- Main Card -->
      <div class="rounded-3xl px-12 py-12 shadow-sm sm:px-24" style="background: #ffffff;">
        <div class="flex flex-col items-center space-y-4 text-center">
          <svg class="mb-4 h-20 w-20" width="100%" height="100%" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9 3.5V2M5.06066 5.06066L4 4M5.06066 13L4 14.0607M13 5.06066L14.0607 4M3.5 9H2M15.8645 16.1896L13.3727 20.817C13.0881 21.3457 12.9457 21.61 12.7745 21.6769C12.6259 21.7349 12.4585 21.7185 12.324 21.6328C12.1689 21.534 12.0806 21.2471 11.9038 20.6733L8.44519 9.44525C8.3008 8.97651 8.2286 8.74213 8.28669 8.58383C8.33729 8.44595 8.44595 8.33729 8.58383 8.2867C8.74213 8.22861 8.9765 8.3008 9.44525 8.44519L20.6732 11.9038C21.247 12.0806 21.5339 12.169 21.6327 12.324C21.7185 12.4586 21.7348 12.6259 21.6768 12.7745C21.61 12.9458 21.3456 13.0881 20.817 13.3728L16.1896 15.8645C16.111 15.9068 16.0717 15.9279 16.0374 15.9551C16.0068 15.9792 15.9792 16.0068 15.9551 16.0374C15.9279 16.0717 15.9068 16.111 15.8645 16.1896Z"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <h1 class="mb-2 text-4xl font-semibold tracking-normal text-gray-900">Sign in</h1>
          <p class="text-base text-gray-600">to continue to ICT Support</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="mt-8">
          @csrf

          <!-- Email Address -->
          <div class="mb-6">
            <div class="group relative">
              <x-text-input id="email"
                class="peer h-14 w-full rounded-lg border border-gray-300 px-4 text-base transition duration-200 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                type="email" name="email" :value="old('email')" required placeholder=" " autofocus />
              <label for="email"
                class="absolute left-4 top-4 z-10 origin-[0] -translate-y-3 scale-75 transform text-gray-500 duration-200 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:text-blue-600">
                Email</label>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mb-6">
            <div class="group relative">
              <x-text-input id="password"
                class="peer h-14 w-full rounded-lg border border-gray-300 px-4 text-base transition duration-200 focus:border-2 focus:border-blue-600 focus:outline-none focus:ring-0"
                type="password" name="password" required placeholder=" " autocomplete="current-password" />
              <label for="password"
                class="absolute left-4 top-4 z-10 origin-[0] -translate-y-3 scale-75 transform text-gray-500 duration-200 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:text-blue-600">
                Enter your password</label>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Options -->
          <div class="mb-8">
            <label class="inline-flex items-center">
              <input type="checkbox" class="h-4 w-4 rounded-sm border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="ms-3 text-sm text-gray-600">Show password</span>
            </label>
          </div>

          <!-- Bottom Section -->
          <div class="flex flex-col space-y-8">
            <div class="flex items-center justify-between text-sm">
              @if (Route::has('password.request'))
                <a class="text-[#1a73e8] hover:text-blue-700" href="{{ route('password.request') }}">
                  Forgot password?
                </a>
              @endif

              <x-primary-button
                class="h-12 rounded-lg bg-slate-700 px-6 font-medium text-white hover:bg-slate-600 focus:outline-none focus:ring-4 focus:ring-blue-100">
                {{ __('Login') }}
              </x-primary-button>
            </div>
          </div>
        </form>

        <!-- Create Account Link -->
        <div class="mt-16 text-sm">
          <span class="text-gray-600">Not your computer? Use Guest mode to sign in privately.</span>
          <a href="#" class="ml-1 text-[#1a73e8] hover:text-blue-700">Learn more</a>
        </div>
      </div>

      <!-- Footer -->

    </div>
  </div>
</x-guest-layout>
