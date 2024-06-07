@extends('layouts.app')

@section('title', 'Form edit Produk')

@section('contents')
<div class="info">
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
    @endif
    <div>
        <form action="/ubah/{{$produks->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit data Produk</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                    value="{{$produks->nama_produk}}">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <td> <img src="{{asset('assets/image/' . $produks->foto)}}" width="80"> </td>
                                <input type="file" class="form-control" id="foto" name="foto" value="foto">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Barang</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    value="{{$produks->harga}}">
                            </div>
                            <div class="form-group">
                                <label for="stok">stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" readonly
                                    value="{{$produks->stok}}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/produk" class="btn btn-danger">Kembali</a>
                            <button type=" submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> @endsection