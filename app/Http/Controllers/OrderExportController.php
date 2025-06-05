<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class OrderExportController extends Controller
{
    //
    public function export(Request $request)
    {
        $orders = Orders::with(['users', 'customer'])->get();

        return SimpleExcelWriter::streamDownload('Orders Laporan.xlsx')
            ->addHeader(['Invoice', 'User', 'Total', 'Tanggal Order', 'Customer', 'Uang Bayar', 'Kembalian'])
            ->addRows($orders->map(fn($order) => [
                'Invoice' => $order->invoice,
                'User' => $order->users->username ?? '-', // Hindari error jika null
                'Total' => $order->total,
                'Tanggal Order' => $order->tanggal_transaksi,
                'Customer' => optional($order->customer)->nama ?? 'Pelanggan', // Gunakan optional() untuk safety
                'Uang Bayar' => $order->paid_amount,
                'Kembalian' => $order->return_amount,
            ]));
    }

    public function exportProduct(Request $request)
    {
        $products = Product::with(['categories'])->get();

        return SimpleExcelWriter::streamDownload('Products Laporan.xlsx')
            ->addHeader([
                'Nama Produk',
                'Deskripsi',
                'Stok',
                'Harga',
                'Foto',
                'Kategori',
                'SKU'
            ])
            ->addRows($products->map(fn($product) => [
                'Nama Produk' => $product->nama_produk,
                'Deskripsi' => $product->description,
                'Stok' => $product->stock,
                'Harga' => $product->price,
                'Foto' => $product->foto,
                'Kategori' => optional($product->categories)->nama_categories, // safe null
                'SKU' => $product->sku,
            ]));
    }
}
