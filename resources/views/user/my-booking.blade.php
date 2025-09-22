@extends('user.layouts.app')

@section('title', 'RentTrail')

@section('content')
<div class="container mt-4">
    <h3>📦 Riwayat Booking Saya</h3>
    <a href="{{ route('booking.printAll') }}" target="_blank" class="btn btn-success">
        <i class="bi bi-printer"></i> Cetak Semua Booking
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-success text-center">
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $i => $booking)
                <tr>
                    <td class="text-center">{{ $i+1 }}</td>
                    <td>{{ $booking->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $booking->tanggal_pinjam }}</td>
                    <td>{{ $booking->tanggal_kembali }}</td>
                    <td class="text-center">{{ $booking->jumlah }}</td>
                    <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada booking</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
