
<div class="container mt-4">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('storage/'.$barang->foto) }}" class="img-fluid rounded">
        </div>
        <div class="col-md-7">
            <h3>{{ $barang->nama_barang }}</h3>
            <p>{{ $barang->deskripsi }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($barang->harga_per_hari) }}/Hari</p>
            <p><strong>Stok:</strong> {{ $barang->stok }}</p>

            <hr>

            <h5>Form Booking</h5>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" max="{{ $barang->stok }}" required>
                </div>

                <button type="submit" class="btn btn-success">Booking Sekarang</button>
            </form>
        </div>
    </div>
</div>

