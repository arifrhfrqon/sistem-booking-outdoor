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

    public function konfirmasi($id, Request $request)
    {
        $booking = Booking::findOrFail($id);

        $booking->status_pembayaran = 'Lunas';
        $booking->keterangan = $request->keterangan ?? $booking->keterangan;
        $booking->save();

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function kembalikan($id)
    {
        $booking = Booking::findOrFail($id);

        $today = now();
        $dueDate = \Carbon\Carbon::parse($booking->tanggal_kembali);

        $lateDays = $today->diffInDays($dueDate, false);

        $booking->denda = 0;

        if ($lateDays > 0) {
            $booking->denda = $lateDays * 20000; // contoh denda perhari
            $booking->total_harga += $booking->denda;
            $booking->status_pembayaran = 'Belum Lunas'; // reset status
        }

        $booking->tanggal_pengembalian = $today;
        $booking->status = 'Kembali';
        $booking->save();

        return back()->with('success', 'Barang berhasil dikembalikan!');
    }


}
