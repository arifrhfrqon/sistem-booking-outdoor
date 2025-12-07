@extends('admin.layouts.app')
@section('title','Laporan Sewa Selesai')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Laporan Sewa (Barang Sudah Kembali)</h4>

    <a href="{{ route('sewa.create') }}" class="btn btn-success mb-3">
        + Tambah Laporan
    </a>

    <div class="alert alert-info">
        <b>Total Pendapatan:</b> Rp {{ number_format($totalPendapatan,0,',','.') }} |
        <b>Total Denda:</b> Rp {{ number_format($totalDenda,0,',','.') }}
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-success text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Barang</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Denda</th>
                <th>Status Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($data as $row)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $row->nama_penyewa }}</td>
                <td>{{ $row->nama_barang }}</td>
                <td>{{ $row->tanggal_pinjam }}</td>
                <td>{{ $row->tanggal_kembali }}</td>
                <td class="text-center">{{ $row->jumlah }}</td>
                <td>Rp {{ number_format($row->total_harga,0,',','.') }}</td>
                <td>
                    @if($row->denda > 0)
                        Rp {{ number_format($row->denda,0,',','.') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    @if($row->denda > 0)
                        @if($row->status_denda == 'Lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum</span>
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('sewa.edit',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('sewa.delete',$row->id) }}" 
                          method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus data ini?')" 
                                class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center text-muted">
                    Belum ada data sewa selesai
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
