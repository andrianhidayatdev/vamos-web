<?php

namespace App\Http\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberService
{
  public function getAllMember()
  {
    $userCompanyId = Auth::user()->id_cabang;

    return Member::where('id_cabang', $userCompanyId)->get();
  }

  public function createMember(array $data)
  {
    $data['kode_member'] = $this->genereteKodeMember();
    $user = Auth::user();
    $userCompanyId = $user->id_cabang;
    $data['user_id'] = $user->id;
    $data['user_id_last_update'] = $user->id;
    $data['id_cabang'] = $userCompanyId;
    $member = Member::create($data);
    Log::channel('database')->info("{$data['nama']}", [
      'table_name' => 'member',
      'id_row' => $member->id_member,
      'action' => 'tambah',
      'context' => $member,
    ]);
  }

  public function updateMember($id, array $data)
  {
    $data['user_id_last_update'] = Auth::id();
    $member = Member::find($id);
    if ($member) {
      Log::channel('database')->info("{$member->nama} = {$data['nama']}", [
        'table_name' => 'member',
        'id_row' => $member->id_member,
        'action' => 'perbarui',
        'context' => ['before' => $member, 'after' => $data],
      ]);

      $member->update($data);
      return $member;
    }
    return null;
  }

  public function deleteMember($id)
  {
    $member = Member::find($id);
    if ($member) {
      Log::channel('database')->info("{$member->nama}", [
        'table_name' => 'member',
        'id_row' => $member->id_member,
        'action' => 'hapus',
        'context' => $member,
      ]);
      $member->delete();
      return true;
    }
    return false;
  }

  public function getMemberById($id)
  {
    return $member = Member::find($id);
  }

  private function genereteKodeMember()
  {
    $lastMember = Member::orderBy('id_member', 'desc')->first();
    if ($lastMember) {
      $lastKode = (int)substr($lastMember->kode_member, 3); // Ubah ke tipe integer
      $newKode = 'MBR' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
    } else {
      $newKode = 'MBR001';
    }
    return $newKode;
  }
}
