<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pengurus;
use App\Models\Supllier;
use App\Models\Produk;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ps = Pengurus::all();
        $sup = Supllier::all();
        $pro = Produk::all();
        $data = Transaksi::with('supplier', 'pengurus', 'produk')->get();
        return view('transaksi', compact('data', 'ps', 'sup', 'pro'));
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
    // Menyimpan transaksi baru ke dalam penyimpanan.
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pengurus' => 'required',
            'supplier' => 'required',
            'produk' => 'required',
            'stok' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $produkId = $request->input('produk');
                    $produk = Produk::find($produkId);

                    if (!$produk) {
                        $fail('Produk tidak ditemukan.');
                        return;
                    }

                    if ($value > $produk->stok) {
                        $fail('Jumlah produk melebihi stok yang tersedia (' . $produk->stok . ').');
                    }
                },
            ],
        ]);

        // Membuat transaksi baru
        $transaksi = new Transaksi;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->id_pengurus = $request->pengurus;
        $transaksi->id_supplier = $request->supplier;
        $transaksi->id_produk = $request->produk;
        $transaksi->stok = $request->stok;
        $transaksi->save();

        // Memperbarui stok produk
        $produk = Produk::find($request->produk);
        $produk->stok -= $request->stok;
        $produk->save();

        session()->flash('success', 'Transaksi berhasil ditambahkan.');
        return redirect('/transaksi');
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
    // Menyimpan transaksi baru ke dalam penyimpanan.
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pengurus' => 'required',
            'supplier' => 'required',
            'produk' => 'required',
            'stok' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $produkId = $request->input('produk');
                    $produk = Produk::find($produkId);

                    if (!$produk) {
                        $fail('Produk tidak ditemukan.');
                        return;
                    }

                    if ($value > $produk->stok) {
                        $fail('Jumlah produk melebihi stok yang tersedia (' . $produk->stok . ').');
                    }
                },
            ],
        ]);

        // Mengambil transaksi yang akan diperbarui
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            session()->flash('error', 'Transaksi tidak ditemukan.');
            return redirect('/transaksi');
        }

        // Mengembalikan stok produk sebelum pembaruan
        $produkSebelumnya = Produk::find($transaksi->id_produk);
        $produkSebelumnya->stok += $transaksi->stok;
        $produkSebelumnya->save();

        // Memperbarui transaksi
        $transaksi->tanggal = $request->tanggal;
        $transaksi->id_pengurus = $request->pengurus;
        $transaksi->id_supplier = $request->supplier;
        $transaksi->id_produk = $request->produk;
        $transaksi->stok = $request->stok;
        $transaksi->save();

        // Memperbarui stok produk
        $produkBaru = Produk::find($request->produk);
        $produkBaru->stok -= $request->stok;
        $produkBaru->save();

        session()->flash('success', 'Transaksi berhasil diperbarui.');
        return redirect('/transaksi');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            session()->flash('error', 'Transaksi tidak ditemukan.');
            return redirect('/transaksi');
        }

        // Mengembalikan stok produk saat transaksi dihapus
        $produk = Produk::find($transaksi->id_produk);
        $produk->stok += $transaksi->stok;
        $produk->save();

        $transaksi->delete();

        session()->flash('success', 'Transaksi berhasil dihapus.');
        return redirect('/transaksi');
    }
}
