<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Penjualan</title>
    <style>
    #back-wrap {
        margin: 30px auto 0 30px;
        width: 450px;
        display: flex;
        justify-content: flex-end;
    }

    .btn-back {
        width: fit-content;
        padding: 8px 15px;
        color: #fff;
        background: #666;
        border-radius: 5px;
        text-decoration: none;
    }

    #receipt {
        box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
        padding: 20px;
        margin: 30px auto 0 auto;
        width: 500px;
        background: #fff;
    }

    h2 {
        font-size: .9rem;
    }

    p {
        font-size: .8rem;
        color: #666;
        line-height: 1.2rem;
    }

    #top {
        margin-top: 25px;
    }

    #top .info {
        text-align: center;
        margin: 20px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 5px 0 5px 15px;
        border: 1px dolif #eee;
    }

    .tabletitle {
        font-size: .5rem;
        background: #eee;
    }

    .service {
        border-bottom: 1px solid #eee;
    }

    .itemtext {
        font-size: .7rem;
    }

    #legalcopy {
        margin-top: 15px;
    }

    .btn-print {
        float: right;
        color: #333;


    }

    .download-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        /* Warna latar belakang */
        color: #ffffff;
        /* Warna teks */
        text-decoration: none;
        border-radius: 5px;
        /* Bentuk sudut tombol */
        border: 2px solid #007bff;
        /* Warna border */
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        /* Efek transisi */
    }

    .download-button:hover {
        background-color: #0056b3;
        /* Warna latar belakang saat hover */
        border-color: #0056b3;
        /* Warna border saat hover */
    }
    </style>
</head>

<body>
    <div id="back-wrap">
    </div>
    <div id="receipt">
        <center id="top">
            <h2 style="color: darkblue;">Nice Market's</h2>
        </center>
        <a href="/penjualan/export/PDF/{{ $penjualan->id }}" class="">unduh
            bukti</a>
        <div id="mid">
            <div class="info">
                <br>
                Nama Pelanggan : {{ $penjualan->pelanggan->nama_pelanggan }} </br>
                Alamat Pelanggan : {{ $penjualan->pelanggan->alamat }} </br>
                No HP Pelanggan : {{ $penjualan->pelanggan->nomor_telepon }} </br>
                Tanggal Transaksi
                :{{ \Carbon\Carbon::parse($date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s')}}</br>
                <p></p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Product Name</h2>
                        </td>
                        <td class="item">
                            <h2>Quantity</h2>
                        </td>
                        <td class="item">
                            <h2>Price</h2>
                        </td>
                        <td class="item">
                            <h2>Subtotal</h2>
                        </td>
                    </tr>
                    @foreach ($details as $item)
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">{{ $item->produk->nama_produk }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ $item['jumlah_produk'] }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">Rp{{ number_format($item->produk->harga, 0, ',' . '.') }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">Rp{{ number_format($item['subtotal'], 0, ',' . '.') }}</p>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td>
                            <h2>Total :</h2>
                        </td>
                        <td>
                            <h2>Rp. {{ number_format($penjualan->total_harga, 0, ',' . '.') }}</h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="">
                <h2>Total : Rp{{ number_format($penjualan->total_harga, 0, ',' . '.') }}</h2>
                <h2>Pembayaran : Rp{{ number_format($penjualan->payment, 0, ',' . '.') }}</h2>
                <h2>Kembalian : Rp{{ number_format($penjualan->return, 0, ',' . '.') }}</h2>
            </div>
            <div id="legalcopy">
                <center>
                    <p>Hormat Kami | Kasir</p>
                    <p class="legal"><strong>Terima kasih telah membeli produk Kami!</strong></p>
                </center>
            </div>

            <a href="/pembelianA" class="download-button">Kembali</a>

        </div>
    </div>
</body>

</html>