@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('export.Excel') }}" class="btn btn-primary mb-3">Export Penjualan xls</a>


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
                        <td>{{$penjual->pelanggan['nama_pelanggan']}}</td>
                        <td>
                            <p>{{\Carbon\Carbon::parse($penjual['created-at'])->format('j-F-y')}}</p>
                        </td>
                        <td>
                            <p>Rp.{{ number_format($penjual['total_harga']) }}</p>
                        </td>
                        <td>{{ Auth::user()->name }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $penjual->id }}">
                                Lihat </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $penjual->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby=" modal{{ $penjual->id }}Label"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal{{ $penjual->id }}Label">data penjualan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nama: {{$penjual->pelanggan['nama_pelanggan']}}</p>
                                            <p>Alamat: {{$penjual->pelanggan['alamat']}}</p>
                                            <p>Nomor telepon: {{$penjual->pelanggan['nomor_telepon']}}</p>

                                            </p>
                                            <p>Subtotal: Rp.{{ number_format($penjual['total_harga']) }}</p>
                                            <p>Tanggal:
                                                {{\Carbon\Carbon::parse($penjual['created-at'])->format('j-F-y')}}
                                            </p>
                                            <p>Dibuat oleh: {{ Auth::user()->name }}</p>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="/penjualan/export/PDF/{{ $penjual->id }}" class="btn btn-primary">unduh bukti</a>
                        </td>
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