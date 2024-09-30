<?php

namespace App\Http\Controllers;

use App\Http\Services\SidebarService;
use App\Models\Penjualan;
use App\Models\User;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');



        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $laporan = $this->getDataLaporan($tanggal_awal, $tanggal_akhir);


        return view('report.laporan', ['name' => __('messages.income_report'), 'laporan' => $laporan, 'user' => $user, 'isRole' => $isRole, 'tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
    }

    private function getDataLaporan($tanggal_awal, $tanggal_akhir = null)
    {
        $user = auth()->user();
        $query = Penjualan::leftJoin('pengeluaran', 'penjualan.id_cabang', '=', 'pengeluaran.id_cabang')
            ->where('penjualan.id_cabang', $user->id_cabang)
            ->select(
                DB::raw('DATE(penjualan.created_at) as tanggal'),
                DB::raw('SUM(penjualan.diterima) as total_penjualan'),
                DB::raw('SUM(pengeluaran.nominal) as total_pengeluaran')
            )
            ->groupBy(DB::raw('DATE(penjualan.created_at)'))
            ->orderBy('tanggal', 'DESC');

        if ($tanggal_akhir) {
            $query->whereBetween('penjualan.created_at', [$tanggal_awal . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
        } else {
            if ($tanggal_awal) {
                $query->where('penjualan.created_at', '>=', $tanggal_awal . ' 00:00:00');
            } else {
                $query->whereMonth('penjualan.created_at', date('m'))
                    ->whereYear('penjualan.created_at', date('Y'));
            }
        }

        return $query->get();
    }



    public function pdf($tanggal_awal = null, $tanggal_akhir = null)
    {


        $data = $this->getDataLaporan($tanggal_awal, $tanggal_akhir);
        if (is_null($tanggal_akhir)) {
            $tanggal_akhir = (new \DateTime())->format('Y-m-d');
        }
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $html = view('report.export.pdf', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'data' => $data
        ])->render();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        return $dompdf->stream('laporan.pdf', ['Attachment' => false]);
    }
}
