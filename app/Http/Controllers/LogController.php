<?php

namespace App\Http\Controllers;

use App\Http\Services\SidebarService;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{

  public function index()
  {
    $isRole = SidebarService::getSidebarVisibility();
    $user = auth()->user();
    $log = $this->getAllLog($user->id_cabang);
    return view('system.log', ['name' => __('messages.log_history'), 'log' => $log, 'isRole' => $isRole, 'user' => $user]);
  }

  private function getAllLog($id_cabang)
  {
    return Log::where('id_cabang', $id_cabang)
      ->orderBy('created_at', 'desc')
      ->get();
  }
}
