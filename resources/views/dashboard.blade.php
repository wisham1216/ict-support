<x-app-layout>
  <x-slot name="header">
    <h2 class="text-3xl font-bold tracking-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      @can('dashboard.analytics')
        <!-- Analytics Section -->
        <div class="mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <!-- ... analytics content ... -->
        </div>
      @endcan

      <!-- Basic Dashboard Content -->
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <!-- Grid Layout -->
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($statusCounts as $statusCount)
              <!-- Status Card -->
              <div
                class="@if ($statusCount->status === 'open') text-green-800
                            @elseif($statusCount->status === 'closed')  text-red-800
                            @elseif($statusCount->status === 'in_progress') text-yellow-800
                            @else  text-gray-800 @endif rounded-lg border p-4">
                <div class="flex items-center space-x-3">
                  <!-- Icon -->
                  <div
                    class="@if ($statusCount->status === 'open') bg-green-300
                                @elseif($statusCount->status === 'closed') bg-red-300
                                @elseif($statusCount->status === 'in_progress') bg-yellow-300
                                @else bg-gray-300 @endif rounded-full p-2">
                    @if ($statusCount->status === 'open')
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                      </svg>
                    @elseif($statusCount->status === 'closed')
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    @elseif($statusCount->status === 'in_progress')
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                      </svg>
                    @else
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                      </svg>
                    @endif
                  </div>

                  <!-- Status Info -->
                  <div>
                    <div class="text-sm font-medium">{{ ucfirst($statusCount->status) }}</div>
                    <div class="mt-1 text-3xl font-semibold">{{ $statusCount->count }}</div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="mt-6 overflow-hidden border bg-white sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div>
            <h3 class="mb-4 mt-10 text-lg font-medium">Daily Ticket Trends</h3>
            <canvas id="ticketTrendsChart" height="100"></canvas>

          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('ticketTrendsChart').getContext('2d');
    const ticketTrendsChart = new Chart(ctx, {
      type: 'bar', // Use 'bar', 'pie', etc. for different chart types
      data: {
        labels: {!! json_encode($dates) !!}, // X-axis labels
        datasets: [{
          label: 'Tickets Created',
          data: {!! json_encode($counts) !!}, // Y-axis data
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderWidth: 2,
          tension: 0.4, // Smooth lines
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
          },
          tooltip: {
            mode: 'index',
            intersect: false,
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Date',
            }
          },
          y: {
            title: {
              display: true,
              text: 'Tickets',
            },
            beginAtZero: true,
          }
        }
      }
    });
  </script>
</x-app-layout>
