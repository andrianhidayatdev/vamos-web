<?php

namespace App\Http\Controllers;

use App\Http\Services\KategoriService;
use App\Http\Services\SidebarService;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private KategoriService  $kategoriService;

    function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $kategori = $this->kategoriService->getAllKategori();
        return view('master.kategori', ['name' => __('messages.categories'), 'kategori' => $kategori, 'isRole' => $isRole, 'user' => $user]);
    }

    public function destroy($id)
    {
        $this->kategoriService->deleteKategori($id);

        return redirect()->back()->with('success', 'Berhasil Hapus');
    }

    function create(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $this->kategoriService->createKategori(['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('master.kategori.index')->with('success', 'Berhasil Tambah');
    }

    function update(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'id_kategori' => 'required|integer'
        ]);

        $this->kategoriService->updateKategori($request->id_kategori, ['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('master.kategori.index')->with('success', 'Berhasil Edit');
    }
}
