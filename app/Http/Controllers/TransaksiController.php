<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Penerbangan;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //passing data transaksi ke views
        $penerbangan = Penerbangan::all(); //select * from penerbangan
        $transaksi = Transaksi::all(); //select * from transaksi
        return view('transaksi.index', compact('transaksi', 'penerbangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //passing data transaksi ke views
        // $data['penerbangan'] = Penerbangan::all(); //select * from penerbangan
        $data['transaksi'] = Transaksi::all(); //select * from transaksi
        return view('transaksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi  
        $request->validate([
            'penerbangan_id' => 'required',
            'qty' => 'required',
           
        ]);
       
        // $input = $request->all();
        //menetapkan harga jika qty lebih dari 1
        $penerbangan = Penerbangan::find($request->penerbangan_id);
        
        $total = $penerbangan->price * $request->qty;
        //menyimpan data ke dalam tabel transaksi
        // $trx = Transaksi::create([
        //     'penerbangan_id' => $request->penerbangan_id,
        //     'user_id' => Auth::user()->id,
        //     'status' => 'unpaid',
        //     'qty' => $request->qty,
        //     'adm_conf' => 'Process',
        //     'total' => $total,
        // ]);
        $trx = new Transaksi(); 
        $trx->penerbangan_id = $request->penerbangan_id;
        $trx->user_id = Auth::user()->id; 
        $trx->qty = $request->qty; 
        $trx->status = 'unpaid'; 
        $trx->adm_conf = 'Process'; 
        $trx->total = $total;
        $trx->save(); 
        
        $transaksi = Transaksi::all();
        // dd($trx);
        return view('transaksi.create',compact('transaksi', 'total'));

    }

    /**
     * Display the specified resource.
     */
    public function riwayati()
    {
        $riwayat = User::all();
        $riwayat = Penerbangan::all();
        $riwayat = Checkout::all();
        return view('transaksi.riwayat', compact('riwayat'));
    }

    public function checkout()
    {   
        //menampilkan data transaksi
        $transaksi = Transaksi::all(); //select * from transaksi where id = $id
        return view('transaksi.checkout', compact('transaksi'));
    }

    public function checkout_store(Request $request){
             
             //jika bayar kurang dari total
         if($request->bayar < $request->total){
            return redirect()->back()->with('errors', 'Pembayaran kurang');
        }
        
        //menyimpan data ke dalam tabel checkout
        $checkout = [
            'penerbangan_id' => $request->penerbangan_id,
            'transaksi_id' => $request->transaksi_id,
            'user_id' => Auth::user()->id,
            'total' => $request->subtotal,
        ];
        Checkout::create($checkout);
        // jika ada uang kembalian
        if ($request->bayar > $request->subtotal){
            $kembalian = $request->bayar - $request->subtotal;
            return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil, kembalian : Rp. '.$kembalian);
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $transaksi = Transaksi::find($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $input=$request->all();
        $transaksi = Transaksi::find($id);
        $transaksi->status = $input['status'];
        if($input['status'] == 'paid'){
            $transaksi->adm_conf = 'Confirmed';
        }
        $transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //delete transaksi sesuai id
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
