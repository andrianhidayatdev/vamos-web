<?php

namespace App\Http\Controllers;

use App\Http\Services\PenjualanService;
use App\Http\Services\SidebarService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{

    private PenjualanService  $penjualanService;

    function __construct(PenjualanService $penjualanService)
    {
        $this->penjualanService = $penjualanService;
    }

    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $penjualan = $this->penjualanService->getAllPenjualan();

        return view('transaksi.penjualan', ['name' => __('messages.sales'), 'penjualan' => $penjualan, 'isRole' => $isRole, 'user' => $user]);
    }
}
