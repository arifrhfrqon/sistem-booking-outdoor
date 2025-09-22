<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

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
            'kategori_barang' => 'required',
            'nama_barang'     => 'required',
            'deskripsi'       => 'nullable',
            'stok'            => 'required|integer',
            'harga_per_hari'  => 'required|numeric',
            'foto'            => 'nullable|image',
        ]);

        // upload foto jika ada
        $namaFile = null;
        if ($request->hasFile('foto')) {
            $namaFile = $request->file('foto')->store('foto_barang', 'public');
        }

        Barang::create([
            'kategori_barang'  => $request->kategori_barang,
            'nama_barang'      => $request->nama_barang,
            'deskripsi'        => $request->deskripsi,
            'stok'             => $request->stok,
            'harga_per_hari'   => $request->harga_per_hari,
            'foto'             => $namaFile
        ]);

        // langsung panggil ulang data setelah insert
        $barangs = Barang::all();

        return view('admin.barang.index', compact('barangs'))
            ->with('success', 'Data berhasil ditambahkan.');
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

        // upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_barang', 'public');
        }

        // update data
        $barang->update($data);

        // arahkan kembali ke halaman index
        return redirect()->route('barang.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')
                        ->with('success', 'Data berhasil dihapus.');
    }


}
