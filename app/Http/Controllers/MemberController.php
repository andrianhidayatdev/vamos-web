<?php

namespace App\Http\Controllers;

use App\Http\Services\MemberService;
use App\Http\Services\SidebarService;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    private MemberService $memberService;

    function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }
    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();
        $member = $this->memberService->getAllMember();
        return view('master.member', ['name' => __('messages.members'), 'member' => $member, 'isRole' => $isRole, 'user' => $user]);
    }

    public function create(Request $request)
    {

        $validate = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string:max:25',
            'alamat' => 'nullable|string|max:255',
        ]);

        $this->memberService->createMember($validate);

        return redirect()->route('master.member.index')->with('success', 'Berhasil Tambah');
    }

    public function destroy($id)
    {
        $this->memberService->deleteMember($id);

        return redirect()->back()->with('success', 'Berhasil Hapus');
    }

    function update(Request $request)
    {
        $member = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:25'
        ]);

        $this->memberService->updateMember($request->id_member, $member);

        return redirect()->route('master.member.index')->with('success', 'Berhasil Edit');
    }
}
