<?php

namespace App\Http\Controllers;

use App\Http\Services\SidebarService;
use App\Models\Kategori;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $id_cabang = auth()->user()->id_cabang;
        $kategori = Kategori::where('id_cabang', $id_cabang)->count();
        $produk = Produk::where('id_cabang', $id_cabang)->count();
        $member = Member::where('id_cabang', $id_cabang)->count();
        $supplier = Supplier::where('id_cabang', $id_cabang)->count();
        $data_per_hari = $this->getPendapatanPerHari($user);
        $totalPenjualan = $this->getTotalPenjualan($user);

        return view('dashboard', ['name' => 'Dashboard', 'isRole' => $isRole, 'user' => $user, 'kategori' => $kategori, 'produk' => $produk, 'member' => $member, 'supplier' => $supplier, 'data_per_hari' => $data_per_hari, 'totalPenjualan' => $totalPenjualan]);
    }

    public function getPendapatanPerHari($user)
    {

        $query = Penjualan::where('penjualan.id_cabang', $user->id_cabang)
            ->whereMonth('penjualan.created_at', date('m'))
            ->whereYear('penjualan.created_at', date('Y'))
            ->select(
                DB::raw('DATE(penjualan.created_at) as tanggal'),
                DB::raw('SUM(penjualan.diterima) as total_penjualan')
            )
            ->groupBy(DB::raw('DATE(penjualan.created_at)'))
            ->orderBy('tanggal', 'ASC');
        $data = $query->get();
        return $data;
    }

    public function getTotalPenjualan($user)
    {
        return Penjualan::where('penjualan.id_cabang', $user->id_cabang)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('diterima');
    }
}
