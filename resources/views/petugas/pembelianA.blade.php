@extends('layoutsp.app')

@section('title', 'Data Penjualan')

@section('contents')

<div class="info">
    @if (Session::get('successDeletePenjualan'))
    <div class="alert alert-danger">
        {{ Session::get('successDeletePenjualan') }}
    </div>
    @endif
    @if (Session::get('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('export.Excel') }}" class="btn btn-primary mb-3">Export Penjualan xls</a>
            <a href="/create/pembelian" class="btn btn-success mb-3" style="">Tambah Penjualan</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama pelanggan</th>
                            <th>Tanggal Penjualan</th>
                            <th>Total Harga</th>
                            <th>dibuat oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($penjuals as $penjual)



                        <tr>
                            <th>{{ $no++ }}</th>
                            <td> {{$penjual->pelanggan['nama_pelanggan']}}
                            </td>
                            <td>
                                <p>{{ \Carbon\Carbon::parse($penjual['created_at'])->setTimezone('Asia/Jakarta')->format('j F Y H:i:s') }}
                                </p>
                            </td>


                            <td>
                                <p>Rp.{{ number_format($penjual['total_harga']) }}</p>
                            </td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $penjual->id }}">
                                    Lihat
                                </button>
                                <div class="modal fade" id="modal{{ $penjual->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby=" modal{{ $penjual->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal{{ $penjual->id }}Label">data penjualan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nama: {{ $penjual->pelanggan->nama_pelanggan }}</p>
                                                <p>Alamat: {{ $penjual->pelanggan->alamat }}</p>
                                                <p>Nomor telepon: {{ $penjual->pelanggan->nomor_telepon }}</p>
                                                <p>Subtotal: Rp.{{ number_format($penjual['total_harga']) }}</p>
                                                <p>Tanggal:
                                                    {{ \Carbon\Carbon::parse($penjual['created_at'])->setTimezone('Asia/Jakarta')->format('j F Y H:i:s') }}
                                                </p>
                                                <p>Dibuat oleh: {{ Auth::user()->name }}</p>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> <a href="/penjualan/export/PDF/{{ $penjual->id }}" class="btn btn-primary">unduh
                                    bukti</a>

                                <form action="{{ route('penjualan.destroy', $penjual->id) }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class=" btn btn-danger">Delete</button>
                                </form>
                            </td>

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