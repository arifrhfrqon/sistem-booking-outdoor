<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kerusakan;

class LaporanController extends Controller
{
    // laporan booking
    public function booking()
    {
        $bookings = Booking::with('barang','user')->latest()->get();
        return view('admin.laporan.booking', compact('bookings'));
    }

    // laporan kerusakan
    public function kerusakan()
    {
        $kerusakan = Kerusakan::with('barang','user')->latest()->get();
        return view('admin.laporan.kerusakan', compact('kerusakan'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status_pembayaran = 'Lunas';
        $booking->keterangan = $request->keterangan;
        $booking->save();

        return redirect()->route('laporan.booking')
            ->with('success', 'Pembayaran berhasil dikonfirmasi sebagai Lunas.');
    }

}
