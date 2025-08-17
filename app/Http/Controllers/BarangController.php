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
            'nama_barang'   => 'required',
            'deskripsi'     => 'nullable',
            'stok'          => 'required|integer',
            'harga_per_hari'=> 'required|numeric',
            'foto'          => 'nullable|image', // jika upload file
        ]);

        // upload foto jika ada
        $namaFile = null;
        if ($request->hasFile('foto')) {
            $namaFile = $request->file('foto')->store('foto_barang', 'public');
        }

        Barang::create([
            'kategori_barang'  => $request->kategori_barang,
            'nama_barang'    => $request->nama_barang,
            'deskripsi'      => $request->deskripsi,
            'stok'           => $request->stok,
            'harga_per_hari' => $request->harga_per_hari,
            'foto'           => $namaFile
        ]);

        return redirect()->route('admin.barang.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kategori_barang' => 'required',
            'nama_barang'   => 'required',
            'deskripsi'     => 'nullable',
            'stok'          => 'required|integer',
            'harga_per_hari'=> 'required|numeric',
            'foto'          => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $namaFile = $request->file('foto')->store('foto_barang', 'public');
            $barang->foto = $namaFile;
        }

        $barang->update([
            'kategori_barang' => $request->kategori_barang,
            'nama_barang'    => $request->nama_barang,
            'deskripsi'      => $request->deskripsi,
            'stok'           => $request->stok,
            'harga_per_hari' => $request->harga_per_hari,
            'foto'           => $barang->foto
        ]);

        return redirect()->route('barangs.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Data berhasil dihapus.');
    }
}
