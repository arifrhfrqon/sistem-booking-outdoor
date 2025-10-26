<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kerusakan;

class LaporanController extends Controller
{
    public function booking(Request $request)
    {
        $query = $request->get('query');

        $bookings = Booking::with(['user', 'barang'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('user', function ($u) use ($query) {
                    $u->where('name', 'like', "%{$query}%")
                    ->orWhere('nama_lengkap', 'like', "%{$query}%")
                    ->orWhere('nik', 'like', "%{$query}%")
                    ->orWhere('no_hp', 'like', "%{$query}%");
                })
                ->orWhereHas('barang', function ($b) use ($query) {
                    $b->where('nama_barang', 'like', "%{$query}%");
                })
                ->orWhere('status_pembayaran', 'like', "%{$query}%")
                ->orWhere('keterangan', 'like', "%{$query}%");
            })
            ->get();

        return view('admin.laporan.booking', compact('bookings', 'query'));
    }

}
