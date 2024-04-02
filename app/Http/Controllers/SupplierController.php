<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supllier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supllier::all();
        return view('supplier', compact('data'));
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
            'nama' => 'required|string|unique:suplliers,nama_s,except,id',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:0|max:12|unique:suplliers,no_hp_sup,except,id',
            'email' => 'required|string|unique:suplliers,email_s,except,id',
        ]);

        $supplier = new Supllier;
        $supplier->nama_s = $request->input('nama');
        $supplier->alamat_s = $request->input('alamat');
        $supplier->no_hp_sup = $request->input('no_hp');
        $supplier->email_s = $request->input('email');
        $supplier->save();

        session()->flash('success', 'supplier berhasil ditambahkan.');
    return redirect('/supplier');
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
        $request->validate([
            'nama' => 'required|string|unique:suplliers,nama_s,except,id',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:0|max:12|unique:suplliers,no_hp_sup,except,id',
            'email' => 'required|string|unique:suplliers,email_s,except,id',
        ]);

        $supplier = Supllier::find($id);

        $supplier->nama_s = $request->input('nama');
        $supplier->alamat_s = $request->input('alamat');
        $supplier->no_hp_sup = $request->input('no_hp');
        $supplier->email_s = $request->input('email');
        $supplier->save();

        session()->flash('success', 'Kategori berhasil diedit.');
        return redirect('/supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supllier::find($id);

        if (!$supplier) {
            session()->flash('error', 'Kategori tidak ditemukan.');
            return redirect('/supplier');
        }
        if ($supplier->supplier()->count() > 0 || $supplier->supplier2()->count() > 0) {
            session()->flash('error', 'Supplier ini masih digunakan di tabel lain dan tidak bisa dihapus.');
            return redirect('/supplier');
        }
        $supplier->delete();

        session()->flash('success', 'Kategori berhasil dihapus.');
        return redirect('/supplier');
    }
    
}
