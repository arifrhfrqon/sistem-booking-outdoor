@extends('admin.layouts.app')
@section('title','Tambah Sewa Selesai')

@section('content')
<div class="container">
    <h4 class="mb-3">Tambah Laporan Sewa (Auto dari Booking)</h4>

    <form method="POST" action="{{ route('sewa.store') }}">
        @csrf

        {{-- PILIH BOOKING --}}
        <div class="mb-3">
            <label class="form-label">Pilih Data Booking</label>
            <select id="booking_id" class="form-control">
                <option value="">-- Pilih Booking --</option>
                @foreach($bookings as $b)
                    <option value="{{ $b->id }}">
                        {{ $b->nama ?? $b->user->name }} - {{ $b->barang->nama_barang ?? '-' }}
                    </option>
                @endforeach
            </select>
        </div>

        <hr>

        {{-- FIELD AUTO --}}
        <input type="hidden" name="booking_id" id="booking_id_hidden">

        <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control mb-2" placeholder="Nama Penyewa" required>
        <input type="text" id="nik" name="nik" class="form-control mb-2" placeholder="NIK">
        <input type="text" id="alamat" name="alamat" class="form-control mb-2" placeholder="Alamat">
        <input type="text" id="no_hp" name="no_hp" class="form-control mb-2" placeholder="No HP">

        <input type="text" id="nama_barang" name="nama_barang" class="form-control mb-2" placeholder="Nama Barang" required>

        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control mb-2" required>
        <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control mb-2" required>

        <input type="number" id="jumlah" name="jumlah" class="form-control mb-2" placeholder="Jumlah" required>
        <input type="number" id="total_harga" name="total_harga" class="form-control mb-2" placeholder="Total Harga" required>

        <input type="number" name="denda" class="form-control mb-2" placeholder="Denda (opsional)">

        <select name="status_denda" class="form-control mb-3">
            <option value="Belum">Belum Lunas</option>
            <option value="Lunas">Lunas</option>
        </select>

        <textarea name="keterangan" class="form-control mb-3" placeholder="Keterangan"></textarea>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('sewa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.getElementById('booking_id').addEventListener('change', function() {
    let id = this.value;

    if(!id) return;

    fetch("{{ url('/admin/laporan-sewa/get-booking') }}/" + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('booking_id_hidden').value = id;
            document.getElementById('nama_penyewa').value   = data.nama_penyewa;
            document.getElementById('nik').value            = data.nik;
            document.getElementById('alamat').value         = data.alamat;
            document.getElementById('no_hp').value          = data.no_hp;
            document.getElementById('nama_barang').value    = data.nama_barang;
            document.getElementById('tanggal_pinjam').value = data.tanggal_pinjam;
            document.getElementById('tanggal_kembali').value= data.tanggal_kembali;
            document.getElementById('jumlah').value         = data.jumlah;
            document.getElementById('total_harga').value    = data.total_harga;
        });
});
</script>
@endsection
