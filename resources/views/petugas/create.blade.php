@extends('layoutsp.app')

@section('title', 'Data Penjualan')

@section('contents')

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-5" style="height:50vh">
                                <div class="card-body">
                                    <form action="{{ route('store-pembelian') }}" method="POST">
                                        @csrf
                                        <div class="form-group col-md-6 col-12">
                                            <label for="nama_pelanggan">Nama Pelanggan</label>
                                            <input type="text" class="form-control" name="nama_pelanggan"
                                                id="nama_pelanggan" required>
                                            <div class="invalid-feedback">
                                                Please fill in your name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="nomor_telepon">Nomor Telepon pelanggan</label>
                                            <input type="number" class="form-control" name="nomor_telepon"
                                                id="nomor_telepon" required>
                                            <div class="invalid-feedback">
                                                Please fill in your phone
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="alamat">Alamat Pelanggan</label>
                                            <textarea type="text" class="form-control" name="alamat" id="alamat"
                                                required></textarea>
                                        </div>
                                </div>
                            </div>
                            <div class="chart-area d-flex flex-row flex-wrap">
                                @foreach ($produks as $item)
                                <div class="card text-center mb-3 mr-3" style="width: 22rem;">
                                    <img src="{{asset('assets/image/'.$item->foto)}}" style="height: 220px;" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-dark">
                                            {{ $item->nama_produk }}</h5>
                                        <p class="card-text">Stok {{ $item->stok }}</p>
                                        <p class="font-weight-bold text-dark"><?php echo ' RP. ' . $item->harga; ?></p>
                                        <div class="produk-quantity mb-3">
                                            <button class="minus-btn mr-2" type="button">-</button>
                                            <input class="quantity mr-2" type="text" name="jumlah_produk[]" value="0">
                                            <button class="plus-btn " type="button">+</button>
                                        </div>
                                        <p class="subtotal">Subtotal: Rp. 0</p> <input type="hidden" name="produk_id[]"
                                            value="{{ $item->id }}"> <input type="hidden" class="harga" name="harga[]"
                                            value="{{ $item->harga }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Tombol "Selanjutnya" di bawah div "chart-area" -->
                            <div class="chart-area text-center" style="margin-top:15vh">
                                {{-- <input type="hidden" name="penjualan_id" value=""> --}}
                                <button type="submit" class="btn btn-primary m-3">Pesan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/sb-admin-2.min.js"></script>


    <script>
    document.querySelectorAll('.plus-btn').forEach(btn => {
        btn.addEventListener('click', function(event) {
            let quantityInput = event.target.parentElement.querySelector('.quantity');
            let currentValue = parseInt(quantityInput.value);
            let price = parseFloat(event.target.closest('.card').querySelector('.harga').value);
            quantityInput.value = currentValue + 1;

            let subtotal = (currentValue + 1) * price; // Perhatikan disini perubahan currentValue + 1
            event.target.closest('.card').querySelector('.subtotal').innerText = "Subtotal: Rp. " +
                subtotal.toFixed(2);
        });
    });

    document.querySelectorAll('.minus-btn').forEach(btn => {
        btn.addEventListener('click', function(event) {
            let quantityInput = event.target.parentElement.querySelector('.quantity');
            let currentValue = parseInt(quantityInput.value);
            let harga = parseFloat(event.target.closest('.card').querySelector('.harga').value);
            if (currentValue > 0) {
                quantityInput.value = currentValue - 1;

                let subtotal = (currentValue - 1) *
                    harga; // Perhatikan disini perubahan currentValue - 1
                event.target.closest('.card').querySelector('.subtotal').innerText = "Subtotal: Rp. " +
                    subtotal.toFixed(2);
            }
        });
    });
    </script>
</body>
@endsection