<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Produk;
use App\Models\Supllier;
use App\Models\Pengurus;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $p = Produk::all();
        $s = Supllier::all();
        $ps = Pengurus::all();
        $data = Laporan::with('pengurus', 'supplier', 'produk')->get();
        return view('laporan', compact('p','s','ps','data'));
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
    $laporan = $request->validate([
        'tanggal' => 'required',
        'pengurus' => 'required',
        'supplier' => 'required',
        'produk' => 'required',
        'laporan' => 'required',
    ]);

    // If the code reaches this point, the data is valid.

    $laporan = new Laporan;
    $laporan->tanggal_l = $request->input('tanggal');
    $laporan->id_pengurus = $request->input('pengurus');
    $laporan->id_supplier = $request->input('supplier');
    $laporan->id_produk = $request->input('produk');
    $laporan->laporan = $request->input('laporan');
    $laporan->save();

    session()->flash('success', 'Laporan berhasil ditambahkan.');
    return redirect('/laporan');
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
    public function update(Request $request, string $id)
    {
        $laporan = $request->validate([
            'tanggal' => 'required',
            'pengurus' => 'required',
            'supplier' => 'required',
            'produk' => 'required',
            'laporan' => 'required',
        ]);
    
        // If the code reaches this point, the data is valid.
    
        $laporan = Laporan::find($id);
        $laporan->tanggal_l = $request->input('tanggal');
        $laporan->id_pengurus = $request->input('pengurus');
        $laporan->id_supplier = $request->input('supplier');
        $laporan->id_produk = $request->input('produk');
        $laporan->laporan = $request->input('laporan');
        $laporan->save();
    
        session()->flash('success', 'Laporan berhasil diedit.');
        return redirect('/laporan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::find($id); 
        if (!$laporan) {
            session()->flash('error', 'Laporan tidak ditemukan.');
            return redirect('/laporan');
        }
        $laporan->delete();

        session()->flash('success', 'Laporan berhasil dihapus.');
        return redirect('/laporan');
    }
}
