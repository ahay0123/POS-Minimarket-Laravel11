<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function index()
    {
        $data['orders'] = Orders::with('details')->get();
        return view('order.index')->with($data);
    }

    public function indexdetail()
    {
        $data['detail'] = OrderDetail::with('product')->get();
        return view('detail.index')->with($data);
    }

    public function create()
    {
        return view('orders.form');
    }

    public function store(Request $request)
    {
        $keranjang = session('keranjang', []);
        if (empty($keranjang)) {
            return redirect('kasir/')->with('error', 'Keranjang kosong.');
        }

        // Hitung subtotal
        $subtotal = 0;
        foreach ($keranjang as $item) {
            $subtotal += $item['harga'] * $item['jumlah'];
        }

        // Terapkan diskon jika ada
        $diskonPersen = session('diskon', 0); // default 0 jika tidak ada diskon
        $subtotalSetelahDiskon = $subtotal - ($subtotal * ($diskonPersen / 100));

        // Pajak 10% dari subtotal setelah diskon
        $pajakPersen = 2;
        $pajak = $subtotalSetelahDiskon * ($pajakPersen / 100);

        // Total akhir
        $total = $subtotalSetelahDiskon + $pajak;

        // Ambil input bayar dan hilangkan titik
        $bayar = $request->input('bayar');
        $kembalian = $request->input('kembalian');

        $validated = $request->validate([
            'paid_amount' => 'required|numeric|min:0',
            'return_amount' => 'required|numeric|min:0',
            // lainnya sesuai kebutuhan
        ]);

        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);

        // Simpan ke tabel transaksi
        $transaksi = \App\Models\Orders::create([
            'invoice' => 'INV - ' . $string,
            'tanggal' => now(),
            'total' => $total,
            'id_user' => Auth::id(),    // Sesuaikan jika sudah ada sistem login
            'no_hp' => session('no_hp'),
            'paid_amount' => $validated['paid_amount'],
            'return_amount' => $validated['return_amount'],
        ]);

        // Simpan ke transaksi_detail
        foreach ($keranjang as $id_produk => $item) {
            \App\Models\OrderDetail::create([
                'id_order' => $transaksi->id_order,
                'id_product' => $id_produk,
                'quantity' => $item['jumlah'],
                'price' => $item['harga'],
            ]);

            // Kurangi stok produk
            $produk = \App\Models\Product::find($id_produk);
            if ($produk) {
                $produk->stock = max(0, $produk->stock - $item['jumlah']);
                $produk->save();
            }
        }

        // Hapus keranjang dan diskon dari session
        session()->forget(['keranjang', 'diskon', 'no_hp']);

        return view('struk.index', [
            'orders' => $transaksi->load('details.product'),
            'subtotal' => $subtotal,
            'diskon' => $diskonPersen,
            'pajak' => $pajakPersen,
            'total' => $total,
            'bayar' => $validated['paid_amount'],
            'kembalian' => $validated['return_amount'],
        ])->with('success', 'Transaksi berhasil disimpan.');
    }

    public function cekMember(Request $request)
    {
        $noHp = $request->input('no_hp');

        $member = \App\Models\Customers::where('no_hp', $noHp)->first();

        if ($member) {
            // Simpan diskon ke session, misal diskon 10%
            session(['diskon' => 10, 'no_hp' => $noHp]);
            return redirect()->back()->with('success', 'Diskon member 10% diterapkan');
        } else {
            // Hapus diskon jika tidak ditemukan
            session()->forget('diskon');
            session(['no_hp' => $noHp]);
            return redirect()->back()->with('error', 'Nomor HP tidak terdaftar sebagai member');
        }
    }


    public function show($id)
    {
        $data['order'] = Orders::with('details')->where('id_order', $id)->firstOrFail();
        return view('orders.show')->with($data);
    }

    public function destroy($id)
    {
        $result = \App\Models\Orders::where('id_order', $id)->first();
        $status = $result->delete();

        \App\Models\OrderDetail::where('id_order', $id)->delete();

        if ($status) return redirect('/order')->with('success', 'Data berhasil di hapus');
        else return redirect('/order')->with('error', 'Data gagal di hapus ');
    }

    public function destroydetail($id)
    {
        $result = \App\Models\OrderDetail::where('id_order_detail', $id)->first();
        $status = $result->delete();

        if ($status) return redirect('/detail')->with('success', 'Data berhasil di hapus');
        else return redirect('/detail')->with('error', 'Data gagal di hapus ');
    }

    public function showStruk($id)
    {
        $orders = Orders::with('details.product')->findOrFail($id);
        return view('struk.index', compact('orders'));
    }
}
