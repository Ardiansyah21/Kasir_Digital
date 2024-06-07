<?php

namespace App\Http\Controllers;
use App\Exports\PenjualanExport;
use App\Models\Penjual;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Detail_produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use PDF;
use Excel;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    
    public function index()
    {
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => "This email doesn't exists"
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin')->with('success', "Login Berhasil admin!");
        }elseIf(Auth::user()->role == 'petugas'){
            return redirect()->route('petugas')->with('ssuccess', "Login Berhasil petugas!");
        }
            return redirect()->route('dashboardA');
        } else {
            return redirect('/')->with('fail', "Gagal login, periksa dan coba lagi!");
        } 
        

    }

    public function inputRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect('/user')->with('successs', 'berhasil membuat akun!');
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    
    public function dashboardA()
    {
        return view('petugas.dashboardA');
    }

 public function pembelian()
    {
        $penjuals = Penjual::all();

    $pelanggans = Pelanggan::all(); 

    return view('admin.pembelian', [
        'penjuals' => $penjuals,
        'pelanggans' => $pelanggans
    ]);
    }

   public function pembelianA()
{
    $penjuals = Penjual::all();
    $pelanggans = Pelanggan::all();
    $detail_produks = Detail_produk::get()->toArray();


    return view('petugas.pembelianA', [
        'penjuals' => $penjuals,
        'pelanggans' => $pelanggans,
        'detail_produks' => $detail_produks
    ]);
}


   public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

     public function logout()
    { 
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $produks = Produk::orderBy('created_at' , 'DESC')->get();
        return view("petugas.create", compact('produks'));  
    }

     public function exportExcel()
    {
        
        $file_name = 'data_keseluruhan_penjulan.xlsx';
        return Excel::download(new PenjualanExport, $file_name);

    }

     public function exportPDF($id)
    {
        $date = Carbon::now();
        $penjualan = Penjual::find($id);
        $detail = Detail_produk::where('penjualan_id', $id)->get();
        $pdf = PDF::loadview('admin.datapembelian-pdf', ['detail' => $detail, 'penjualan' => $penjualan, 'date' => $date]);
        return $pdf->download('data-penjualan.pdf');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data penjualan
        $request->validate([    
        'produk_id' => 'required|array',
        'jumlah_produk' => 'required|array',
        ]);

       // Simpan data penjualan
       $pelanggan = new Pelanggan();
       $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
       $pelanggan->alamat = $request->input('alamat');
       $pelanggan->nomor_telepon = $request->input('nomor_telepon');
       $pelanggan->save();
       
        $totalharga = 0;
        $return = 0;
        $payment = 0;
        $user = User::where('role', 'Kasir')->first();
       
       // Setelah menyimpan pelanggan, Anda dapat menggunakan ID pelanggan untuk menyimpan penjualan
        $penjualan = new Penjual();
        $penjualan->date = now(); // Tanggal penjualan saat ini
        $penjualan->price_amount = 0; // Nilai awal total harga
        $penjualan->pelanggan_id = $pelanggan->id;
        $penjualan->total_harga = $totalharga;
        $penjualan->return = $return;
        $penjualan->payment = $payment; // Atur PelangganID di sini
        $penjualan->user_id = Auth::user()->id;
        $penjualan->save();

        // Simpan id pelanggan ke dalam penjualan
        $penjualan->pelanggan_id = $pelanggan->id;
        
        // Simpan data detail penjualan
        foreach ($request->input('produk_id') as $key => $produkId) {
            $detailPenjualan = new Detail_produk();
            $detailPenjualan->penjual_id = $penjualan->id;
            $detailPenjualan->produk_id = $produkId;
            $detailPenjualan->jumlah_produk = $request->input('jumlah_produk.' . $key);
            // Hitung subtotal berdasarkan harga produk
            $produks = Produk::find($produkId);
            $detailPenjualan->subtotal = $produks->harga * $request->input('jumlah_produk.' . $key);
            $penjualan->total_harga += $detailPenjualan->subtotal;
            $penjualan->price_amount += $detailPenjualan->subtotal;
            $detailPenjualan->penjualan()->associate($penjualan);
            $detailPenjualan->save();
        
            // Kurangi stok produk yang terjual
            $produks->stok -= $detailPenjualan->jumlah_produk;
            $produks->save(); // Simpan perubahan stok produk
        }
           
        $penjualan->total_harga = $penjualan->price_amount;
        $penjualan->save();

        // Redirect or provide response as needed
        return redirect()->route('invoice.penjualan', ['id' =>$penjualan])->with('successPenjualan', 'Penjualan berhasil.');
    }

    public function show($id)
    {
        $date = Carbon::now();
        $penjualan = Penjual::find($id);
        $details = Detail_produk::where('penjualan_id', $id)->get();
        return view('admin.datapembelian', compact('penjualan', 'detail', 'date'));
    }
    
    public function showBon($id)
{
        $date = Carbon::now();
        $pelanggan = Pelanggan::find($id);
        $penjualan = Penjual::find($id);
        $details = Detail_produk::where('penjualan_id', $id)->get();
        return view('petugas.bonpembelian', compact('penjualan', 'details', 'pelanggan', 'date'));
}

public function invoice($id)
    {
        $date = Carbon::now();
        $pelanggan = Pelanggan::find($id);
        $penjualan = Penjual::find($id);
        $details = Detail_produk::where('penjualan_id', $id)->get();
        return view('petugas.invoice', compact('penjualan', 'details', 'pelanggan', 'date'));
    }

    public function invoiceStore(Request $request, $id)
    {
        $request->validate([
            'payment' => 'required',
            'total_harga' => 'required',
        ]);

        $penjualan = Penjual::find($id);

        if ($request->payment >= $request->total_harga) {
            $return = $request->payment - $request->total_harga;
        } else {
             return redirect()->route('pembelianA')->with('error', 'Saldo Anda Kurang!');
        }

        $penjualan->update([
        'payment' => $request->payment,
        'return' => $return,
        'total_harga' => $request->total_harga,
    ]);

    return redirect()->route('bon-pembelian', ['id' =>$penjualan])->with('successPenjualan', 'Penjualan berhasil.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $users = User::where('id', '=', $id)->firstOrFail();
        return view('admin.edituser', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
    
        $user->update([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
        return redirect('/user')->with('successEditUser', 'Berhasil Mengupdate User');
    }

    /**
     * Remove the specified resource from storage.
     */
    
  public function destroy($id)
    {
    User::where('id', '=', $id)->delete();
    return redirect()->back()->with('successDelete', 'Berhasil menghapus data user!');
}
}