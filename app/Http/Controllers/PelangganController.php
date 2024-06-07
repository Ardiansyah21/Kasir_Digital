<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjual;
use App\Models\Detail_produk;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // $request->validate([
        //         'nama_pelanggan' => 'required',
        //         'alamat' => 'required',
        //         'nomor_telepon' => 'required',

        //     ]);
        //     Pelanggan::create([
        //         'nama_pelanggan' => $request->nama_pelanggan,
        //         'alamat' => $request->alamat,
        //         'nomor_telepon' => $request->nomor_telepon,
    
        //     ]);

        //     return redirect()->back()->with('sucessAddpelanggan', 'Berhasil menambahkan data baru!');

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $Pelanggans = Pelanggan::find($id);

    // Periksa apakah produk ditemukan
    if (!$Pelanggans) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan!');
    }

    return view('admin.pembelian', compact('pelanggan'));
    }

    public function showbon($id)
    {
        $Pelanggans = Pelanggan::find($id);
    return view('petugas.bonpembelian', compact('pelanggans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjual::find($id);
        $pelanggan = Pelanggan::find($id);
        $detailpenjualan = Detail_produk::find($id);

        
        if (!$penjualan) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan.');
        }
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan.');
        }
        if (!$detailpenjualan) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan.');
        }
        

        $penjualan->delete();
        $pelanggan->delete();
        $detailpenjualan->delete();



        return redirect()->back()->with('successDeletePenjualan', 'Data penjualan berhasil dihapus.');
    }
}