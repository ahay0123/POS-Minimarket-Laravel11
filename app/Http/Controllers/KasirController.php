<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    //

    public function index()
    {
        $data['result'] = \App\Models\Product::all();
        return view('kasir/index')->with($data);
    }

    public function store(Request $request)
    {
        $produk = Product::findOrFail($request->id_product);

    $keranjang = session()->get('keranjang', []);

    if (isset($keranjang[$produk->id_product])) {
        $keranjang[$produk->id_product]['jumlah'] += 1;
    } else {
        $keranjang[$produk->id_product] = [
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->price,
            'stok' => $produk->stok,
            'jumlah' => 1
        ];
    }

    session(['keranjang' => $keranjang]);

    return redirect()->back();
    }

    public function tambah($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += 1;
        }

        session(['keranjang' => $keranjang]);
        return redirect()->back();
    }

    public function kurang($id)
    {
        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] -= 1;

            if($keranjang[$id]['jumlah'] <= 0) {
                unset($keranjang[$id]);
            } 

            session(['keranjang' => $keranjang]);
        }

        return redirect()->back();
    }

    public function hapusSemua()
    {
        session()->forget('keranjang');
        return redirect()->back();
    }
}
