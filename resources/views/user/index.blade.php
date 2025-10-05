@extends('user.layouts.app')

@section('title', 'RentTrail')

@section('content')
@if(session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($barang as $item)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image -->
                        <img class="card-img-top" src="{{ asset('storage/' . $item->foto) }}" alt="">
                        
                        <!-- Product details -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name -->
                                <h5 class="fw-bolder">{{ $item->nama_barang }}</h5>
                                <!-- Product price -->
                                <p class="mb-1">Rp. {{ number_format($item->harga_per_hari) }}/Hari</p>
                                <!-- Product stock -->
                                <p class="text-muted">Stok: {{ $item->stok }}</p>
                            </div>
                        </div>

                        <!-- Product actions -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">

                            <!-- Tombol Booking Cepat -->
                            <!-- Tombol Booking Cepat -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $item->id }}">
                                <i class="bi bi-cart-plus"></i> Booking Cepat
                            </button>

                            <div class="modal fade" id="bookingModal{{ $item->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $item->id }}">Booking {{ $item->nama_barang }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('booking.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="barang_id" value="{{ $item->id }}">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="tanggal_pinjam{{ $item->id }}" class="form-label">Tanggal Pinjam</label>
                                                <input type="date" 
                                                    name="tanggal_pinjam" 
                                                    id="tanggal_pinjam{{ $item->id }}" 
                                                    class="form-control" 
                                                    required 
                                                    min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_kembali{{ $item->id }}" class="form-label">Tanggal Kembali</label>
                                                <input type="date" 
                                                    name="tanggal_kembali" 
                                                    id="tanggal_kembali{{ $item->id }}" 
                                                    class="form-control" 
                                                    required 
                                                    min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah{{ $item->id }}" class="form-label">Jumlah</label>
                                                <input type="number" name="jumlah" id="jumlah{{ $item->id }}" class="form-control" min="1" max="{{ $item->stok }}" value="1" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success">Booking</button>
                                        </div>
                                    </form>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection