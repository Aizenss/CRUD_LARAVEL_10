<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::all();
        return view('kategori', compact('data'));
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
            'nama' => 'required|string|unique:kategoris,nama_k,except,id',
        ],[
            'nama.required' => 'Mohon isi nama terlebih dahulu',
            'nama.unique' => 'Nama tidak boleh sama / unik',
        ]);

        $kategori = new Kategori;
        $kategori->nama_k = $request->input('nama');
        $kategori->save();

        session()->flash('success', 'Kategori berhasil ditambahkan.');
    return redirect('/kategori');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|unique:kategoris,nama_k,except,id',
        ],[
            'nama.required' => 'Mohon isi nama terlebih dahulu',
            'nama.unique' => 'Nama tidak boleh sama / unik',
        ]);

        $kategori = Kategori::find($id);

        $kategori->nama_k = $request->input('nama');
        $kategori->save();

        session()->flash('success', 'Kategori berhasil diedit.');
        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            session()->flash('error', 'Kategori tidak ditemukan.');
            return redirect('/kategori');
        }

        if ($kategori->produk()->count() > 0) {
            session()->flash('error', 'Kategori ini masih digunakan di tabel lain dan tidak bisa dihapus.');
            return redirect('/kategori');
        }

        $kategori->delete();

        session()->flash('success', 'Kategori berhasil dihapus.');
        return redirect('/kategori');
    }
}
