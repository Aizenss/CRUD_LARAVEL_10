<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Produk;
use App\Models\Kategori;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $s = Kategori::all();
        $data = Produk::with('kategori')->get();
        return view('produk', compact('data','s'));
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
            'nama' => 'required|string|unique:produks,nama_p,except,id',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
            'stok' => 'required|numeric|min:0'
        ],[
                'nama.required' => 'Nama produk harus diisi.',
                'nama.unique' => 'Nama Produk harus unik/tidak boleh sama',
                'harga.required' => 'Harga produk harus diisi.',
                'harga.numeric' => 'Harga produk harus berupa angka.',
                'harga.min' => 'Harga produk tidak boleh kurang dari 0.',
                'kategori.required' => 'Kategori produk harus diisi.',
                'foto.required' => 'Foto produk harus diunggah.',
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg, png, atau jpg.',
                'stok.required' => 'Stok produk harus diisi.',
                'stok.numeric' => 'Stok produk harus berupa angka.',
                'stok.min' => 'Stok produk tidak boleh kurang dari 0.'
            ]);

        // Proses unggah foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $ekstensi = $foto->getClientOriginalExtension();
            $namaFoto = Str::random(10) . '.' . $ekstensi;
            $foto->move(public_path('images'), $namaFoto);
        } else {
            $namaFoto = null;
        }

        // Simpan data ke database
        $produk = new Produk;
        $produk->nama_p = $request->nama;
        $produk->harga = $request->harga;
        $produk->id_kategori = $request->kategori;
        $produk->stok = $request->stok;
        $produk->foto = $namaFoto;
        $produk->save();

        session()->flash('success', 'produk berhasil ditambahkan.');
    return redirect('/produk');
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
        // Validasi input
        $request->validate([
            'nama' => 'required|string|unique:produks,nama_p,except,id',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
            'stok' => 'required|numeric|min:0'
        ],[
            'nama.required' => 'Nama produk harus diisi.',
            'nama.unique' => 'Nama Produk harus unik/tidak boleh sama',
            'harga.required' => 'Harga produk harus diisi.',
            'harga.numeric' => 'Harga produk harus berupa angka.',
            'harga.min' => 'Harga produk tidak boleh kurang dari 0.',
            'kategori.required' => 'Kategori produk harus diisi.',
            'foto.required' => 'Foto produk harus diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format file gambar harus jpeg, png, atau jpg.',
            'stok.required' => 'Stok produk harus diisi.',
            'stok.numeric' => 'Stok produk harus berupa angka.',
            'stok.min' => 'Stok produk tidak boleh kurang dari 0.'
        ]);
        
        $produk = Produk::findOrFail($id);   
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $ekstensi = $foto->getClientOriginalExtension();
            $namaFoto = Str::random(10) . '.' . $ekstensi;
            $foto->move(public_path('images'), $namaFoto);
        } else {
            $namaFoto = $produk->foto;
        }

        $produk = Produk::find($id);
        $produk->nama_p = $request->nama;
        $produk->harga = $request->harga;
        $produk->id_kategori = $request->kategori;
        $produk->stok = $request->stok;
        $produk->foto = $namaFoto;
        $produk->save();

        session()->flash('success', 'produk berhasil diedit.');
    return redirect('/produk');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $produk = Produk::find($id);
        
    if ($produk->kategori2->count() > 0 || $produk->kategori3->count() > 0) {
        return redirect('/produk')->with('error', 'Produk ini masih digunakan di tabel lain dan tidak bisa dihapus.');
    }
    if ($produk->foto) {
        if (file_exists(public_path('images/' . $produk->foto))) unlink(public_path('images/' . $produk->foto));
    }
    $produk->delete();

    session()->flash('success', 'produk berhasil dihapus.');
    return redirect('/produk');
}
}