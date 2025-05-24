<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['result'] = \App\Models\Customers::all();
        return view('customer.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama'      => 'required|max:100',
            'no_hp'       => 'required|max:100',
            'alamat'       => 'required|',
            'tanggal_daftar'       => 'required|date',
            'poin'       => 'required|numeric',
            'status'       => 'required'
        ]);

        $input = $request->all();

        $status = \App\Models\Customers::create($input);

        if ($status) return redirect('/customer')->with('success', 'Data berhasil di tambahkan');
        else return redirect('customer')->with('error', 'Data gagal di tambahkan');
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
        $data['result'] = \App\Models\Customers::where('id_customers', $id)->first();
        return view('customer/form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'nama'      => 'required|max:100',
            'no_hp'       => 'required|max:100',
            'alamat'       => 'required|',
            'tanggal_daftar'       => 'required|date',
            'poin'       => 'numeric',
            'status'       => 'required'
        ]);

        $input = $request->all();

        $result = \App\Models\Customers::where('id_customers', $id)->first();
        $status = $result->update($input);

        if ($status) return redirect('/customer')->with('success', 'Data berhasil di ubah');
        else return redirect('customer')->with('error', 'Data gagal di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result = \App\Models\Customers::where('id_customers', $id)->first();
        $status = $result->delete();

        if($status) return redirect('/customer')->with('success', 'Data berhasil di hapus');
        else return redirect('customer')->with('error', 'Data gagal di hapus');
    }
}
