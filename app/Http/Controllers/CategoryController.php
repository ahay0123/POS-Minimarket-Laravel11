<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $data['result'] = \App\Models\Category::all();
        return view('categories/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama_categories'      => 'required|max:100',
            'description'       => 'required|max:100'
        ]);

        $input = $request->all();

        $status = \App\Models\Category::create($input);

        if($status) return redirect('/categories')->with('success', 'Data berhasil di tambahkan');
        else return redirect('categories')->with('error', 'Data gagal di tambahkan');
        
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
        $data['result'] = \App\Models\Category::where('id_categories', $id)->first();
        return view('categories/form')->with($data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$
        $validated = $request->validate([
            'nama_categories'      => 'required|max:100',
            'description'       => 'required|max:100'
        ]);

        $input = $request->all();

        $result = \App\Models\Category::where('id_categories', $id)->first();
        $status = $result->update($input);

        if($status) return redirect('/')->with('success', 'Data berhasil di ubah');
        else return redirect('categories')->with('error', 'Data gagal di ubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result = \App\Models\Category::where('id_categories', $id)->first();
        $status = $result->delete();

        if($status) return redirect('/')->with('success', 'Data berhasil di hapus');
        else return redirect('categories')->with('error', 'Data gagal di hapus');
    }
}
