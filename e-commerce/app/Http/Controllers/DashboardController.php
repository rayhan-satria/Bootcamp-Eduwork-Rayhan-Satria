<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() 
    {
        $data = [
            [
                'name' => 'Products',
                'value' => Product::count(),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#00000" viewBox="0 0 24 24"><path d="m10 9.75 2-1 2 1V5h-4zM7 17v-2h5v2zm-2 4q-.83 0-1.41-.59T3 19V5q0-.83.59-1.41T5 3h14q.83 0 1.41.59T21 5v14q0 .82-.59 1.41T19 21zM5 5v14zm0 14h14V5h-3v8l-4-2-4 2V5H5z"/></svg>',
            ],
            [
                'name' => 'Categories',
                'value' => ProductCategory::count(),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 24 24"><path d="M6.5 11 12 2l5.5 9zm11 11q-1.88 0-3.19-1.31T13 17.5t1.31-3.19T17.5 13t3.19 1.31T22 17.5t-1.31 3.19T17.5 22M3 21.5v-8h8v8zM17.5 20q1.05 0 1.78-.73T20 17.5t-.72-1.78T17.5 15t-1.77.72T15 17.5t.73 1.77 1.77.73M5 19.5h4v-4H5zM10.05 9h3.9L12 5.85zm7.45 8.5"/></svg>',
            ],
            [
                'name' => 'Orders',
                'value' => Order::count(),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 24 24"><path d="M2 12v-2h3v2zm3.4 5.55L4 16.1 6.1 14l1.45 1.4zM6.1 8 4 5.9l1.4-1.45L7.55 6.6zM18 20l-4.75-4.75L12 19 9 9l10 3-3.7 1.3L20 18zM10 6V3h2v3zm5.9 2-1.45-1.4 2.15-2.15 1.4 1.4z"/></svg>',
            ],
            [
                'name' => 'Users',
                'value' => User::count(),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 24 24"><path d="M14 7V5h8v2zm0 4V9h8v2zm0 4v-2h8v2zm-8.12-1.87Q5 12.25 5 11t.88-2.12T8 8t2.13.88T11 11t-.88 2.13T8 14t-2.12-.87M2 20v-1.9q0-.53.25-1t.7-.75q1.13-.68 2.39-1.01T8 15t2.66.34 2.39 1.01q.45.27.7.75t.25 1V20zm2.15-2h7.7q-.87-.5-1.85-.75Q9.03 17 8 17t-2 .25-1.85.75m4.56-6.29Q9 11.43 9 11t-.29-.71T8 10q-.42 0-.71.29T7 11t.29.71T8 12t.71-.29M8 18"/></svg>',
            ],
            [
                'name' => 'Revenue',
                'value' => 'Rp' . number_format(Order::where('status', 'completed')->sum('total_price'), 0, ',', '.'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 24 24"><path d="M5 21q-.83 0-1.41-.59T3 19V3h2v16h16v2zm1-3V9h4v9zm5 0V4h4v14zm5 0v-5h4v5z"/></svg>',
            ]
        ];

        $chartData = $this->chartOrderDiagramData();
        $chartStatusData = $this->chartOrderStatusData();
        $latestOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

            return view('admin.dashboard', compact(
                'data',
                'chartData',
                'chartStatusData',
                'latestOrders'
            ));    
        }

        private function chartOrderDiagramData()
        {
            $labels = collect(range(6, 0))->map(function ($day) {
                return now()->subDays($day)->format('d M');
            });

            $orders = collect(range(6, 0))->map(function ($day) {
                $date = now()->subDays($day)->toDateString();

                return Order::whereDate('created_at', $date)->count();
            });

            $revenue = collect(range(6, 0))->map(function ($day) {
                $date = now()->subDays($day)->toDateString();

                return Order::whereDate('created_at', $date)
                    ->where('status', 'completed')
                    ->sum('total_price');
            });

            return [
                'labels' => $labels,
                'orders' => $orders,
                'revenue' => $revenue,
            ];
        }

        private function chartOrderStatusData()
        {
            return [
                'labels' => [
                    'Pending',
                    'Processing',
                    'Completed',
                    'Cancelled',
                ],

                'data' => [
                    Order::where('status', 'pending')->count(),
                    Order::where('status', 'processing')->count(),
                    Order::where('status', 'completed')->count(),
                    Order::where('status', 'cancelled')->count(),
                ],
            ];

        }

}
