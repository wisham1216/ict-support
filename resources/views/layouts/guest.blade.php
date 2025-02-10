<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
  <!-- Background Pattern Container -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-700"></div>
    <div class="absolute inset-0">
      <svg class="h-full w-full opacity-[0.02]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <pattern id="support-icon" x="0" y="0" width="24" height="24" patternUnits="userSpaceOnUse">
          <path
            d="M9 3.5V2M5.06066 5.06066L4 4M5.06066 13L4 14.0607M13 5.06066L14.0607 4M3.5 9H2M8.5 8.5L12.6111 21.2778L15.5 18.3889L19.1111 22L22 19.1111L18.3889 15.5L21.2778 12.6111L8.5 8.5Z"
            stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
        </pattern>
        <rect width="100%" height="100%" fill="url(#support-icon)" />
      </svg>
    </div>
  </div>

  <div class="min-h-screen">
    {{ $slot }}
  </div>
</body>

</html>
