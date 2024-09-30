<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserService
{
  public function getAllUser()
  {
    $userId = Auth::id();
    $userRoleId = Auth::user()->id_role;

    $query = User::leftJoin('role', 'role.id_role', '=', 'users.id_role')
      ->leftJoin('cabang', 'cabang.id_cabang', '=', 'users.id_cabang')
      ->where('users.id', '!=', $userId);

    if ($userRoleId != 1) {
      $query->where('users.id_role', '!=', 1);
    }

    $posts = $query->select('users.*', 'role.nama_role as nama_role', 'cabang.nama_cabang as nama_cabang')
      ->get();

    return $posts;
  }


  public function createUser(array $data)
  {
    $user = User::create($data);
    Log::channel('database')->info("{$data['name']}", [
      'table_name' => 'users',
      'id_row' => $user->id,
      'action' => 'tambah',
      'context' => $user,
    ]);
  }

  public function updateUser($id, array $data)
  {
    $user = User::findOrFail($id);

    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->id_cabang = $data['id_cabang'];
    if (isset($data['foto'])) {
      if ($user->foto) {
        Storage::disk('public')->delete($user->foto);
      }

      $path = $data['foto']->store('foto', 'public');
      $user->foto = $path;
    }

    if (isset($data['password']) && !empty($data['password'])) {
      $user->password = Hash::make($data['password']);
    }

    $user->id_role = $data['id_role'] ?? $user->id_role;

    $user->save();

    Log::channel('database')->info("{$user->name} = {$data['name']}", [
      'table_name' => 'user',
      'id_row' => $user->id,
      'action' => 'perbarui',
      'context' => ['before' => $user, 'after' => $data],
    ]);
  }


  public function deleteUser($id)
  {
    $user = User::find($id);

    if ($user) {
      if ($user->foto) {
        Storage::disk('public')->delete($user->foto);
      }
      Log::channel('database')->info("{$user->name}", [
        'table_name' => 'users',
        'id_row' => $user->id,
        'action' => 'hapus',
        'context' => $user,
      ]);
      $user->delete();
      return true;
    }

    return false;
  }


  public function getUserById($id)
  {
    return $user = User::find($id);
  }
}
