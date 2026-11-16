<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Sku;
use App\Modules\Store\Models\Drop;
use App\Modules\Store\Models\DropItem;
use App\Modules\Store\Models\WaitlistEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDropController extends Controller
{
    public function index()
    {
        $drops = Drop::with(['items.sku.product'])->latest()->paginate(10);
        $waitlists = WaitlistEntry::with(['drop', 'sku.product'])->latest()->paginate(15);
        $skus = Sku::with('product')->where('is_active', true)->get();

        return view('admin.store.drops.index', compact('drops', 'waitlists', 'skus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:drops,code|max:50',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'drop_time' => 'required|date',
            'sku_id' => 'required|exists:skus,id',
            'drop_quota' => 'required|integer|between:1,100000',
        ]);

        $drop = Drop::create([
            'ulid' => (string) Str::ulid(),
            'code' => strtoupper(trim($request->code)),
            'title' => $request->title,
            'description' => $request->description,
            'drop_time' => $request->drop_time,
            'is_active' => true,
        ]);

        DropItem::create([
            'drop_id' => $drop->id,
            'sku_id' => $request->sku_id,
            'drop_quota' => $request->drop_quota,
        ]);

        return redirect()->route('admin.store.drops.index')->with('success', "Drop {$drop->title} berhasil dijadwalkan.");
    }
}

