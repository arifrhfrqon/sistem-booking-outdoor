<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>RentTrail - Sistem Booking Alat Outdoor</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">RentTrail</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/userdashboard">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Barang</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('barang.index') }}">Semua Barang</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><h9 class="nav-link">Kategori:</h9></li>
                                <li><a class="dropdown-item" href="{{ route('barang.kategori', 'Tenda') }}">Tenda</a></li>
                                <li><a class="dropdown-item" href="{{ route('barang.kategori', 'Tas') }}">Tas</a></li>
                                <li><a class="dropdown-item" href="{{ route('barang.kategori', 'Sepatu') }}">Sepatu</a></li>
                                <li><a class="dropdown-item" href="{{ route('barang.kategori', 'Pakaian') }}">Pakaian</a></li>
                                <li><a class="dropdown-item" href="{{ route('barang.kategori', 'Perlengkapan Tidur') }}">Perlengkapan Tidur</a></li>
                                <li><a class="dropdown-item" href="{{ route('barang.kategori', 'Peralatan Masak') }}">Peralatan Masak</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-body p-0">
                                <div class="row">
                                <!-- foto sisi kiri -->
                                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('img/login.jpg'); background-size: cover;"></div>
                                <!-- Form sisi kanan -->
                                <div class="col-lg-12">
                                    <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="/login" method="POST">
                                        @csrf
                                        <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                                name="email" placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group mt-2">
                                        <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
                                        Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/register">Create an Account!</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2 mx-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('eror'))
        <div class="alert alert-danger alert-dismissible fade show mt-2 mx-4" role="alert">
            {{ session('eror') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Rental Barang Outdoor</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Alam Pasti Akan Menunggu Kedatanganmu</p>
                </div>
            </div>
        </header>
        <!-- Section-->
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
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; RentTrail - Sistem Booking Alat Outdoor</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>