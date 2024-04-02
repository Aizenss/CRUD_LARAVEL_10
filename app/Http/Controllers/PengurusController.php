<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengurus::all();
        return view('pengurus', compact('data'));
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
            'nama' => 'required|string|unique:penguruses,nama_ps,except,id',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:1|max:12|unique:penguruses,no_hp_peng,except,id',
            'email' => 'required|string|unique:penguruses,email_ps,except,id',
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'nama.string' => 'Nama pengurus harus berupa teks.',
            'nama.unique' => 'Nama pengurus sudah digunakan.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.min' => 'Nomor HP minimal :min karakter.',
            'no_hp.max' => 'Nomor HP maksimal :max karakter.',
            'no_hp.unique' => 'Nomor HP sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);
        $pengurus = new Pengurus;
        $pengurus->nama_ps = $request->input('nama');
        $pengurus->alamat_ps = $request->input('alamat');
        $pengurus->no_hp_peng = $request->input('no_hp');
        $pengurus->email_ps = $request->input('email');
        $pengurus->save();

        session()->flash('success', 'pengurus berhasil ditambahkan.');
        return redirect('/pengurus');
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
            'nama' => 'required|string|unique:penguruses,nama_ps,except,id,',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:1|max:12|unique:penguruses,no_hp_peng,except,id',
            'email' => 'required|string|unique:penguruses,email_ps,except,id',
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'nama.string' => 'Nama pengurus harus berupa teks.',
            'nama.unique' => 'Nama pengurus sudah digunakan.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.min' => 'Nomor HP minimal :min karakter.',
            'no_hp.max' => 'Nomor HP maksimal :max karakter.',
            'no_hp.unique' => 'Nomor HP sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        $pengurus = Pengurus::find($id);
        $pengurus->nama_ps = $request->input('nama');
        $pengurus->alamat_ps = $request->input('alamat');
        $pengurus->no_hp_peng = $request->input('no_hp');
        $pengurus->email_ps = $request->input('email');
        $pengurus->save();
        session()->flash('success', 'pengurus berhasil diedit.');
        return redirect('/pengurus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengurus = Pengurus::find($id);

        if (!$pengurus) {
            session()->flash('error', 'pengurus tidak ditemukan.');
            return redirect('/pengurus');
        }

        if ($pengurus->pengurus()->count() > 0 || $pengurus->pengurus2()->count() > 0) {
            session()->flash('error', 'Pengurus ini masih digunakan di tabel lain dan tidak bisa dihapus.');
            return redirect('/pengurus');
        }
        $pengurus->delete();

        session()->flash('success', 'pengurus berhasil dihapus.');
        return redirect('/pengurus');
    }
}