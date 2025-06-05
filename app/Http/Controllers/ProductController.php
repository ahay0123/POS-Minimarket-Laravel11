<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['result'] = \App\Models\Product::orderBy('stock', 'asc')->get();
        return view('product/index')->with($data);
    }

    public function printBarcode($id)
    {
        $product = Product::findOrFail($id);
        return view('product.print-barcode', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('product/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama_produk'      => 'required|max:100',
            'description'       => 'required|max:100',
            'stock'             => 'required|max:10',
            'price'             => 'required|max:10',
            'id_categories' => 'required|exists:categories,id_categories',
            'foto'             => 'required|mimes:jpeg,png|max:512'
        ]);

        $input = $request->all();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nama_produk'] . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('', $filename);
            $input['foto'] = $filename;
        }
        $status = \App\Models\Product::create($input);

        if ($status) return redirect('/')->with('success', 'Data berhasil di tambahkan');
        else return redirect('product')->with('error', 'Data gagal di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['result'] = \App\Models\Product::where('id_product', $id)->first();
        return view('product/form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'nama_produk'      => 'required|max:100',
            'description'       => 'required|max:100',
            'stock'             => 'required|max:10',
            'price'             => 'required|max:10',
            'id_categories'      => 'required|exists:categories',
            'foto'             => 'required|mimes:jpeg,png|max:512',
        ]);

        $input = $request->all();

        $result = \App\Models\Product::where('id_product', $id)->first();
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nama_produk'] . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('', $filename);
            $input['foto'] = $filename;
        }
        $status = $result->update($input);

        if ($status) return redirect('/')->with('success', 'Data berhasil di ubah');
        else return redirect('product')->with('error', 'Data gagal di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result = \App\Models\Product::where('id_product', $id)->first();
        $status = $result->delete();

        if ($status) return redirect('/')->with('success', 'Data berhasil di hapus');
        else return redirect('product')->with('error', 'Data gagal di Hapus ');
    }
}
