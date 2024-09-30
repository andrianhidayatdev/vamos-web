<?php

namespace App\Http\Controllers;

use App\Http\Services\KategoriService;
use App\Http\Services\ProdukService;
use App\Http\Services\SidebarService;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    private ProdukService $produkService;
    private KategoriService $kategoriService;

    function __construct(ProdukService $produkService, KategoriService $kategoriService)
    {
        $this->produkService = $produkService;
        $this->kategoriService = $kategoriService;
    }
    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();

        $produk = $this->produkService->getAllProduk();
        $kategori = $this->kategoriService->getAllKategori();
        return view('master.produk', ['name' => __('messages.products'), 'produk' => $produk, 'kategori' => $kategori, 'isRole' => $isRole, 'user' => $user]);
    }

    public function create(Request $request)
    {

        $validate = $request->validate([
            'nama_produk' => 'required|string|max:255|produk:nama_produk',
            'merk' => 'nullable|string|max:255',
            'id_kategori' => 'nullable|integer|min:0',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'stok' => 'nullable|integer',
            'diskon' => 'nullable|integer|between:0,100',
        ]);

        $this->produkService->createProduk($validate);

        return redirect()->route('master.produk.index')->with('success', 'Berhasil Tambah');
    }

    public function destroy($id)
    {
        $this->produkService->deleteProduk($id);

        return redirect()->back()->with('success', 'Berhasil Hapus');
    }

    function update(Request $request)
    {
        $validate = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'id_kategori' => 'nullable|integer|min:0',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'stok' => 'nullable|integer',
            'diskon' => 'nullable|integer|between:0,100',
        ]);

        $this->produkService->updateProduk($request->id_produk, $validate);

        return redirect()->route('master.produk.index')->with('success', 'Berhasil Edit');
    }
}
