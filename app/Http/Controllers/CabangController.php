<?php

namespace App\Http\Controllers;

use App\Http\Services\CabangService;
use App\Http\Services\SidebarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CabangController extends Controller
{

    private CabangService $cabangService;

    public function __construct(CabangService $cabangService)
    {
        $this->cabangService = $cabangService;
    }

    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $cabang = $this->cabangService->getAllCabang();
        return view('system.cabang', ['name' => __('messages.branches'), 'cabang' => $cabang, 'isRole' => $isRole, 'user' => $user]);
    }

    public function destroy($id)
    {
        $this->cabangService->deleteCabang($id);
        if (Session::has('error')) {
            return redirect()->back();
        }
        return redirect()->back()->with('success', 'Berhasil Hapus');
    }

    function create(Request $request)
    {
        $cabang = $request->validate([
            'nama_cabang' => 'required|string|max:255',
        ]);

        $this->cabangService->createCabang($cabang);

        return redirect()->route('system.cabang.index')->with('success', 'Berhasil Tambah');
    }

    function update(Request $request)
    {
        $cabang = $request->validate([
            'nama_cabang' => 'required|string|max:255',
        ]);

        $this->cabangService->updateCabang($request->id_cabang, $cabang);

        return redirect()->route('system.cabang.index')->with('success', 'Berhasil Edit');
    }
}
