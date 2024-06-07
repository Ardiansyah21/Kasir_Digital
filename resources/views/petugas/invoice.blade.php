@extends('layoutsp.app')

@section('title', 'Data User')

@section('contents')
<section class="section produk">
    <div class="row">

        @if ($message = Session::get('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($message = Session::get('Success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <ul style="width: 100%; background: red; padding: 10px">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Invoice data Penjualan</h5>
                        <div id="mid">
                            <h5 class="text-danger">Data Pelanggan</h5>
                            Nama Pelanggan : {{ $penjualan->pelanggan->nama_pelanggan }}
                            <br>
                            Alamat Pelanggan : {{ $penjualan->pelanggan->alamat }}
                            <br>
                            No HP Pelanggan : {{ $penjualan->pelanggan->nomor_telepon }}
                            <br>
                            Tanggal Transaksi
                            :{{ \Carbon\Carbon::parse($date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s')}}
                            <br>
                            <hr>
                            <br>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Harag</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $dt)
                                <tr>
                                    <td>{{ $dt->produk->nama_produk }}</td>
                                    <td>{{ $dt->jumlah_produk }}</td>
                                    <td>Rp. {{ number_format($dt->produk->harga, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($dt->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <form class="row g-3" action="{{ route('invoice.store', $penjualan->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="col-6">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" name="total_harga" id="total_harga"
                                    value="{{ $penjualan->total_harga }}" required hidden>
                                <p>
                                    <strong>Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Pembayaran <span style="color: red;">*</span></label>
                                <input type="numbert" class="form-control" name="payment" id="payment" required>
                                <div class="mt-3" id="kembalian">Kembalian: Rp
                                    {{ number_format($penjualan->return, 0, ',', '.') }}</div>

                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Bayar</button>
                                <a href="" class="btn btn-secondary float-end">Kembali</a>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var total_harga = parseFloat("{{ $penjualan->total_harga }}");

    document.getElementById('payment').addEventListener('input', function() {
        var payment = parseFloat(this.value);
        var kembalian = payment - total_harga;

        // Format kembalian sebagai mata uang Indonesia tanpa digit desimal
        var formatter = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0
        });
        var formattedKembalian = formatter.format(kembalian);

        // Menetapkan nilai yang diformat ke dalam elemen HTML
        if (!isNaN(kembalian) && kembalian >= 0) {
            document.getElementById('kembalian').innerText = 'Kembalian: ' + formattedKembalian;
        } else {
            document.getElementById('kembalian').innerText = 'Pembayaran kurang';
        }
    });
});
</script>

@endsection