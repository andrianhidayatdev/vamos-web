<?php

namespace App\Http\Services;

use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RoleService
{
  public function getAllRole()
  {
    return Role::all();
  }

  public function createRole(array $data)
  {
    $role = Role::create($data);
    Log::channel('database')->info("{$data['nama_role']}", [
      'table_name' => 'role',
      'id_row' => $role->id_role,
      'action' => 'tambah',
      'context' => $role,
    ]);
  }

  public function updateRole($id, array $data)
  {
    $role = Role::find($id);
    if ($role) {
      Log::channel('database')->info("{$role->nama_role} = {$data['nama_role']}", [
        'table_name' => 'role',
        'id_row' => $role->id_role,
        'action' => 'perbarui',
        'context' => ['before' => $role, 'after' => $data],
      ]);
      $role->update($data);
      return $role;
    }
    return null;
  }

  public function deleteRole($id)
  {
    $role = Role::find($id);
    if ($role) {
      try {
        Log::channel('database')->info("{$role->nama_role}", [
          'table_name' => 'role',
          'id_row' => $role->id_role,
          'action' => 'hapus',
          'context' => $role,
        ]);
        $role->delete();
        return true;
      } catch (QueryException $e) {
        if ($e->getCode() === '23000') {
          Session::flash('error', 'Tidak dapat menghapus role ini karena ada user yang memiliki role ini.');
          return false;
        }
        Session::flash('error', 'Terjadi kesalahan saat mencoba menghapus role.');
        return false;
      }
    }
    return false;
  }

  public function getRoleById($id)
  {
    return $role = Role::find($id);
  }
}
