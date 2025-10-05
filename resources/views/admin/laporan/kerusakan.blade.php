@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Laporan Kerusakan Barang</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-danger text-center">
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Barang</th>
                <th>Tanggal Laporan</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kerusakan as $i => $k)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $k->user->name }}</td>
                    <td>{{ $k->barang->nama_barang }}</td>
                    <td>{{ $k->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $k->keterangan }}</td>
                    <td>
                        @if($k->status == 'Selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-warning">Proses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada laporan kerusakan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
