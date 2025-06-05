<?php

namespace App\Http\Controllers;

use App\Models\Orders;
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
                'User' => $order->users->username ?? '-',
                'Total' => $order->total,
                'Tanggal Order' => $order->tanggal_transaksi,
                'Customer' => $order->customer->nama ?? 'Pelanggan',
                'Uang Bayar' => $order->paid_amount,
                'Kembalian' => $order->return_amount,
            ])) 
            ->toResponse($request);
    }
}
