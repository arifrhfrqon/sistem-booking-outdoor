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
                <th>Status bayar</th>
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
                    <td class="text-center">
                        @if($booking->status_pembayaran === 'Lunas')
                            <span class="badge bg-success">LUNAS</span>
                        @else
                            <span class="badge bg-danger">BELUM</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada booking</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
    <h5>Total Bayar: Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</h5>

    {{-- Tombol Transfer (rekening manual) --}}
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transferModal">
        Transfer Manual
    </a>

    {{-- Tombol Konfirmasi WA --}}
    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20konfirmasi%20pembayaran%20Booking%20ID%20{{ $booking->id }}%20sebesar%20Rp{{ number_format($booking->total_harga,0,',','.') }}"
       target="_blank" 
       class="btn btn-success">
       Konfirmasi via WhatsApp
    </a>
</div>

{{-- Modal Transfer --}}
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferModalLabel">Transfer Manual</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Silakan transfer sesuai nominal ke rekening berikut:</p>
        <ul>
            <li><b>Bank BCA</b> - 1234567890 a.n PT Rental Outdoor</li>
            <li><b>Bank Mandiri</b> - 9876543210 a.n PT Rental Outdoor</li>
        </ul>
        <p>Setelah transfer, segera lakukan konfirmasi via WhatsApp.</p>
      </div>
      <div class="modal-footer">
        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20telah%20transfer%20untuk%20Booking%20ID%20{{ $booking->id }}%20sebesar%20Rp{{ number_format($booking->total_harga,0,',','.') }}"
           target="_blank" class="btn btn-success">
           Konfirmasi via WhatsApp
        </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

</div>



@endsection
