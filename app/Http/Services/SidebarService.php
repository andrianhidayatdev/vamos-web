<?php


namespace App\Http\Services;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SidebarService
{
  public static function getSidebarVisibility()
  {
    $user = auth()->user();

    $role = User::join('role', 'role.id_role', '=', 'users.id_role')
      ->where('users.id', $user->id)
      ->pluck('role.role')
      ->first();


    return $role;
  }
}
