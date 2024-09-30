<?php

namespace App\Http\Controllers;

use App\Http\Services\RoleService;
use App\Http\Services\SidebarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    private RoleService  $roleService;

    function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();

        $role = $this->roleService->getAllRole();
        return view('system.role', ['name' => __('messages.role'), 'role' => $role, 'isRole' => $isRole, 'user' => $user]);
    }

    public function destroy($id)
    {
        $this->roleService->deleteRole($id);
        if (Session::has('error')) {
            return redirect()->back();
        }
        return redirect()->back()->with('success', 'Berhasil Hapus');
    }

    function create(Request $request)
    {
        $role = $request->validate([
            'nama_role' => 'required|string|max:255',
            'role' => 'required|in:1,2,3',
        ]);

        $this->roleService->createRole($role);

        return redirect()->route('system.role.index')->with('success', 'Berhasil Tambah');
    }

    function update(Request $request)
    {
        $role = $request->validate([
            'nama_role' => 'required|string|max:255',
            'role' => 'required|in:1,2,3',
        ]);

        $this->roleService->updateRole($request->id_role, $role);

        return redirect()->route('system.role.index')->with('success', 'Berhasil Edit');
    }
}
