<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'       => 'required|exists:barangs,id',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah'          => 'required|integer|min:1',
        ]);

        // Ambil barang
        $barang = Barang::findOrFail($request->barang_id);

        // Cek stok cukup
        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Buat data booking baru
        Booking::create([
            'barang_id'       => $barang->id,
            'user_id'         => Auth::user(),
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $barang->harga_per_hari * $request->jumlah, 
            'status'          => 'pending',
        ]);

        $barang->decrement('stok', $request->jumlah);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil! Stok berkurang otomatis.');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $barang = $booking->barang;

        $barang->increment('stok', $booking->jumlah);

        $booking->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Booking dibatalkan dan stok dikembalikan.');
    }


    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {

        $request->validate([
            'kategori_barang' => 'required',
            'nama_barang'     => 'required',
            'deskripsi'       => 'nullable',
            'stok'            => 'required|integer',
            'harga_per_hari'  => 'required|numeric',
            'foto'            => 'nullable|image',
        ]);

        // data dasar
        $data = [
            'kategori_barang' => $request->kategori_barang,
            'nama_barang'     => $request->nama_barang,
            'deskripsi'       => $request->deskripsi,
            'stok'            => $request->stok,
            'harga_per_hari'  => $request->harga_per_hari,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')
                        ->with('success', 'Data berhasil dihapus.');
    }
}
