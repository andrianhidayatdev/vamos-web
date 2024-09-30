<?php

namespace App\Http\Controllers;

use App\Http\Services\PengeluaranService;
use App\Http\Services\SidebarService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{

    private PengeluaranService  $pengeluaranService;

    function __construct(PengeluaranService $pengeluaranService)
    {
        $this->pengeluaranService = $pengeluaranService;
    }

    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $pengeluaran = $this->pengeluaranService->getAllPengeluaran();

        return view('transaksi.pengeluaran', ['name' => __('messages.expenses'), 'pengeluaran' => $pengeluaran, 'isRole' => $isRole, 'user' => $user]);
    }

    public function create(Request $request)
    {
        $pengeluaran =  $request->validate([
            'deskripsi' => 'required|string|max:255',
            'nominal' => 'integer|required'
        ]);

        $this->pengeluaranService->createPengeluaran($pengeluaran);

        return redirect()->route('transaksi.pengeluaran.index')->with('success', 'Berhasil Tambah');
    }
}
