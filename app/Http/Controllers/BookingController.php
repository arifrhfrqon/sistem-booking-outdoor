<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // hitung lama hari
        $lamaHari = (new \DateTime($request->tanggal_pinjam))
            ->diff(new \DateTime($request->tanggal_kembali))
            ->days;

        // hitung total harga
        $total = $barang->harga_per_hari * $request->jumlah * $lamaHari;

        Booking::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'total_harga' => $total,
        ]);

        return redirect()->back()->with('success', 'Booking berhasil! Silakan cek di menu Booking.');
    }

    public function show($id)
    {
        $booking = Booking::with('barang')->findOrFail($id);
        return view('user.show', compact('booking'));
    }

    public function printAll()
    {
        $bookings = Booking::with('barang')->get();

        if ($bookings->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data booking untuk dicetak.');
        }

        // Ambil status terakhir (misalnya dari booking terakhir)
        $status = $bookings->last()->status_pembayaran ?? 'Belum Dibayar';

        $pdf = Pdf::loadView('user.print', compact('bookings', 'status'))
                    ->setPaper([0,0,226.77,600], 'portrait'); 
                    // 80mm x panjang dinamis (cocok untuk struk)

        return $pdf->stream('struk-booking.pdf');
    }

}
