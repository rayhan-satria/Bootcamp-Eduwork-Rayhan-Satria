<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container-fluid">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-3">

                    @foreach($data as $item)
                        <div class="p-5 bg-white rounded-lg shadow">

                            {{-- Bagian atas: Nama dan Icon --}}
                            <div class="flex justify-between items-start gap-3">

                                <p class="text-base font-semibold text-gray-700">
                                    {{ $item['name'] }}
                                </p>

                                <div class="w-10 h-10 shrink-0">
                                    {!! $item['icon'] !!}
                                </div>

                            </div>

                            {{-- Bagian bawah: Value --}}
                            <div class="mt-4">
                                <p class="text-3xl font-bold text-gray-800">
                                    {{ $item['value'] }}
                                </p>
                            </div>

                        </div>
                    @endforeach

                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-6">

                    {{-- Order & Revenue Chart --}}
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Orders & Revenue
                        </h3>

                        <div class="relative h-80">
                            <canvas id="orderRevenueChart"></canvas>
                        </div>
                    </div>

                    {{-- Order Status Chart --}}
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Order Status
                        </h3>

                        <div class="relative h-80">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>

                </div>

            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                {{-- Latest Orders --}}
                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <div class="px-6 py-3 border-b bg-yellow-200">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Latest Orders
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Order Number
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Customer
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Total Price
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Date
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse ($latestOrders as $order)

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $order->order_number }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $order->user->name ?? 'User tidak ditemukan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClass = match ($order->status) {
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'processing' => 'bg-blue-100 text-blue-800',
                                                    'completed' => 'bg-green-100 text-green-800',
                                                    'cancelled' => 'bg-red-100 text-red-800',
                                                    default => 'bg-gray-100 text-gray-800',
                                                };
                                            @endphp

                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            Belum ada pesanan.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);

        const ctx = document.getElementById('orderRevenueChart');

        new Chart(ctx, {
            type: 'line',

            data: {
                labels: chartData.labels,

                datasets: [
                    {
                        label: 'Total Orders',
                        data: chartData.orders,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        yAxisID: 'y',
                        tension: 0.3,
                    },
                    {
                        label: 'Revenue (Rp)',
                        data: chartData.revenue,
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        yAxisID: 'y1',
                        tension: 0.3,
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    mode: 'index',
                    intersect: false,
                },

                scales: {
                    y: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Order'
                        }
                    },

                    y1: {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue (Rp)'
                        },
                        grid: {
                            drawOnChartArea: false,
                        }
                    }
                }
            }
        });

        const statusData = @json($chartStatusData);

        const statusCtx = document.getElementById('orderStatusChart');

        new Chart(statusCtx, {
            type: 'doughnut',

            data: {
                labels: statusData.labels,

                datasets: [{
                    data: statusData.data,

                    backgroundColor: [
                        '#facc15', // Pending
                        '#3b82f6', // Processing
                        '#22c55e', // Completed
                        '#ef4444', // Cancelled
                    ],

                    borderWidth: 2,
                    hoverOffset: 8,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom',
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + ' orders';
                            }
                        }
                    }
                }
            }
        });

    </script>
</x-app-layout>