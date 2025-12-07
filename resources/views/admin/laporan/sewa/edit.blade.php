@extends('admin.layouts.app')
@section('title', 'Edit Laporan Sewa')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Edit Laporan Sewa</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('sewa.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" class="form-control"
                               value="{{ old('nama_penyewa', $data->nama_penyewa) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control"
                               value="{{ old('nik', $data->nik) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                               value="{{ old('alamat', $data->alamat) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                               value="{{ old('no_hp', $data->no_hp) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control"
                               value="{{ old('nama_barang', $data->nama_barang) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control"
                               value="{{ old('jumlah', $data->jumlah) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control"
                               value="{{ old('tanggal_pinjam', $data->tanggal_pinjam) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control"
                               value="{{ old('tanggal_kembali', $data->tanggal_kembali) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Harga</label>
                        <input type="number" name="total_harga" class="form-control"
                               value="{{ old('total_harga', $data->total_harga) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Denda</label>
                        <input type="number" name="denda" class="form-control"
                               value="{{ old('denda', $data->denda) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Denda</label>
                        <select name="status_denda" class="form-control" required>
                            <option value="Belum" {{ $data->status_denda == 'Belum' ? 'selected' : '' }}>
                                Belum Lunas
                            </option>
                            <option value="Lunas" {{ $data->status_denda == 'Lunas' ? 'selected' : '' }}>
                                Lunas
                            </option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $data->keterangan) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('sewa.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
