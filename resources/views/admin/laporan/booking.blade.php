@extends('admin.layouts.app')
@section('title', 'Laporan Booking')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Laporan Booking</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-success text-center">
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status Bayar</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $i => $b)
                <tr>
                    <td class="text-center">{{ $i+1 }}</td>
                    <td>{{ $b->nama ?? $b->user->name }}</td>
                    <td>{{ $b->nik ?? '-' }}</td>
                    <td>{{ $b->alamat ?? '-' }}</td>
                    <td>{{ $b->no_hp ?? '-' }}</td>
                    <td>{{ $b->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $b->tanggal_pinjam }}</td>
                    <td>{{ $b->tanggal_kembali }}</td>
                    <td class="text-center">{{ $b->jumlah }}</td>
                    <td>Rp {{ number_format($b->total_harga,0,',','.') }}</td>
                    <td class="text-center">
                        @if($b->status_pembayaran === 'Lunas')
                        <span class="badge bg-success">Lunas</span>
                        @else
                        <span class="badge bg-danger">Belum</span>
                        @endif
                    </td>
                    <td>{{ $b->keterangan }}</td>
                    <td class="text-center">
                        @if($b->status_pembayaran !== 'Lunas')
                            <!-- Trigger modal -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasiModal{{ $b->id }}">
                                Konfirmasi
                            </button>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>

                <!-- Modal Konfirmasi (letakkan di luar <tr>) -->
                <div class="modal fade" id="konfirmasiModal{{ $b->id }}" tabindex="-1" aria-labelledby="konfirmasiLabel{{ $b->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('booking.konfirmasi', $b->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="konfirmasiLabel{{ $b->id }}">Konfirmasi Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin mengkonfirmasi pembayaran ini sebagai <b>LUNAS</b>?</p>
                                    
                                    <div class="mb-3">
                                        <label for="keterangan{{ $b->id }}" class="form-label">Keterangan (Opsional)</label>
                                        <textarea name="keterangan" id="keterangan{{ $b->id }}" class="form-control" rows="3" placeholder="Contoh: Transfer BCA, sudah diterima oleh admin."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
