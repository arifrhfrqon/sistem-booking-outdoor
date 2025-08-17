@extends('admin.layouts.app')
@section('title', 'Data User')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <table class="table table-bordered">
        <thead class="table-primary text-center">
        <tr>
            <th class="align-middle">No</th>
            <th class="align-middle">Name</th>
            <th class="align-middle">Email</th>
            <th class="align-middle">Nama Lengkap</th>
            <th class="align-middle">NIK</th>
            <th class="align-middle">No HP</th>
            <th class="align-middle">Pekerjaan</th>
            <th class="align-middle">Foto KTP</th>
            <th class="align-middle">Role</th>
            <th class="align-middle">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $u)
            <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $u->name }}</td>
                <td class="align-middle">{{ $u->email }}</td>
                <td class="align-middle">{{ $u->nama_lengkap }}</td>
                <td class="align-middle">{{ $u->nik }}</td>
                <td class="align-middle">{{ $u->no_hp }}</td>
                <td class="align-middle">{{ $u->pekerjaan }}</td>
                <td class="align-middle">
                    @if($u->foto_ktp)
                        <img src="{{ asset('storage/'.$u->foto_ktp) }}" width="70" alt="Foto KTP">
                    @else
                        -
                    @endif
                </td>
                <td class="align-middle">{{ $u->role }}</td>
                <td class="align-middle">
                    <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
