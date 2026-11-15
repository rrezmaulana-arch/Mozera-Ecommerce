<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Customer;
use App\Modules\Crm\Models\CustomerMetric;
use Illuminate\Http\Request;

class CrmSegmentController extends Controller
{
    public function index()
    {
        $segments = [
            'champions' => [
                'name' => 'Champions',
                'description' => 'Pelanggan terbaik: belanja sangat sering, nilai belanja tinggi, dan baru-baru ini berbelanja.',
                'color' => 'emerald',
            ],
            'loyal' => [
                'name' => 'Loyal Customers',
                'description' => 'Pelanggan setia yang responsif terhadap promosi dan drops baru.',
                'color' => 'blue',
            ],
            'potential' => [
                'name' => 'Potential Loyalists',
                'description' => 'Pembeli baru dengan nilai belanja bagus, potensial dijadikan pelanggan setia.',
                'color' => 'indigo',
            ],
            'at_risk' => [
                'name' => 'At Risk (Perlu Perhatian)',
                'description' => 'Pernah belanja besar namun sudah lama tidak kembali. Butuh pendekatan personal.',
                'color' => 'amber',
            ],
            'hibernating' => [
                'name' => 'Hibernating',
                'description' => 'Aktivitas rendah, belanja jarang, berisiko churn total.',
                'color' => 'slate',
            ],
            'lost' => [
                'name' => 'Lost / Churned',
                'description' => 'Tidak aktif dalam jangka panjang.',
                'color' => 'rose',
            ],
            'new' => [
                'name' => 'New Customers',
                'description' => 'Pelanggan terdaftar yang belum memiliki riwayat transaksi selesai.',
                'color' => 'teal',
            ],
        ];

        $counts = CustomerMetric::select('segment', \DB::raw('count(*) as count'), \DB::raw('sum(monetary_total_idr) as total_revenue'))
            ->groupBy('segment')
            ->get()
            ->keyBy('segment');

        return view('admin.crm.segments.index', compact('segments', 'counts'));
    }
}

