@extends('layouts.app')

@section('title', 'Form Barang')

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
        <form action="/stokupdate/{{$produks->id}}" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">update stok Produk</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="stok">stok</label>
                                <input type="number" class="form-control" id="stok" name="stok"
                                    value="{{$produks->stok}}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endsection