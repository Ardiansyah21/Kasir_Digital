@extends('layoutsp.app')

@section('title', 'Data Produk')

@section('contents')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama barang</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach ($produks as $item)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $item['nama_produk'] }}</td>
                        <td class=""> <a href="../assets/image/{{$item->foto}}" target="_blank">
                                <img src="{{asset('assets/image/' . $item->foto)}}" style="width: 100px; height: auto;">
                        </td>
                        <td>Rp.{{ number_format($item['harga']) }}</td>
                        <td>{{ $item['stok'] }}</td>
                    </tr>
                </tbody>
                @endforeach

            </table>
        </div>
    </div>
</div>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
@endsection