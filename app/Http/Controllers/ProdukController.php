<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function produk()
    {
        $produks = Produk::orderBy('created_at' , 'DESC')->get();
        return view("admin.produk", compact('produks'));  

        
    }
   public function produkA()
    {
        $produks = Produk::orderBy('created_at' , 'DESC')->get();
        return view("petugas.produkA", compact('produks'));  
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
        $request->validate([
                'nama_produk' => 'required',
                'foto' => 'required|image|mimes:jpeg,jpg,png,svg',
                'harga' => 'required',
                'stok' => 'required',

            ]);

            
            $image = $request->file('foto');
            $imgName = rand(). '.' .  $image->extension();
            $path = public_path('assets/image/');
            $image->move($path, $imgName);

            Produk::create([
                'nama_produk' => $request->nama_produk,
                'foto' => $imgName,
                'harga' => $request->harga,
                'stok' => $request->stok,
    
            ]);

            return redirect()->back()->with('sucessAdd', 'Berhasil menambahkan data baru!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $produks = Produk::where('id', '=', $id)->firstOrFail();
        return view('admin.edit', compact('produks'));
    }

    public function updatestok($id)
    {
        $produks = Produk::where('id', '=', $id)->firstOrFail();
        return view('admin.updatestok', compact('produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
     $request->validate([
                'nama_produk' => 'required',
                'harga' => 'required',
                'stok' => 'required',

            ]);

             if(is_null($request->file('foto'))) {
            $imgName = Produk::where('id', '=', $id)->value('foto');
        }else{
            $image = $request->file('foto');
            $imgName = rand(). '.' .  $image->extension();
            $path = public_path('assets/image/');
            $image->move($path, $imgName);
        }

        Produk::where('id', '=', $id)->update([
            'nama_produk' => $request->nama_produk,
            'foto' => $imgName,
            'harga' => $request->harga,
            'stok' => $request->stok,
    
            

            
        ]);
        return redirect()->route('produk')->with('successUpdate', 'Berhasil mengubah data!');
    }

    public function stokupdate(Request $request, $id)
    {
     $request->validate([
                'stok' => 'required',

            ]);

        Produk::where('id', '=', $id)->update([
            'stok' => $request->stok,
    
            

            
        ]);
        return redirect()->route('produk')->with('successUpdateStok', 'Berhasil mengupdate stok!');
    }
    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
    Produk::where('id', '=', $id)->delete();
    return redirect()->back()->with('successDelete', 'Berhasil menghapus data!');
    
    }
}