<?php

namespace App\Http\Controllers;

use App\Http\Services\CabangService;
use App\Http\Services\RoleService;
use App\Http\Services\SidebarService;
use App\Http\Services\UserService;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

class UserController extends Controller
{
  private  UserService $userService;
  private  RoleService $roleService;
  private CabangService $cabangService;

  function __construct(UserService $userService, RoleService $roleService, CabangService $cabangService)
  {
    $this->userService = $userService;
    $this->roleService = $roleService;
    $this->cabangService = $cabangService;
  }

  public function index()
  {
    $isRole = SidebarService::getSidebarVisibility();
    $user = auth()->user();

    $cabang = $this->cabangService->getAllCabang();
    $userData = $this->userService->getAllUser();
    $role = $this->roleService->getAllRole();
    return view('system.user', ['name' => __('messages.users'), 'userData' => $userData, 'role' => $role, 'cabang' => $cabang,  'isRole' => $isRole, 'user' => $user]);
  }

  public function create(Request $request)
  {

    $user = $request->validate([
      'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'name' => 'required|string|max:100',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8|confirmed',
      'id_role' => 'nullable|int',
      'id_cabang' => 'nullable|int',
    ]);

    $userAuth = auth()->user();
    $userRoleId = $userAuth->role->role;
    $roleRequest = Role::find($request->id_role);


    if ($userRoleId != 1 && $roleRequest->role->role == 1) {
      return redirect()->back()->with('error', 'You are not allowed to assign the Admin role.');
    }

    if ($request->hasFile('foto')) {
      $filePath = $request->file('foto')->store('foto', 'public');
      $user['foto'] = $filePath;
    }

    $this->userService->createUser($user);

    return redirect()->route('system.user.index')->with('success', 'Berhasil Tambah');
  }

  public function destroy($id)
  {
    $this->userService->deleteUser($id);

    return redirect()->back()->with('success', 'Berhasil Hapus');
  }

  public function update(Request $request)
  {
    $user = $request->validate([
      'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'name' => 'required|string|max:100',
      'email' => 'required|email',
      'password' => 'nullable|min:8|confirmed',
      'id_role' => 'nullable|int',
      'id_cabang' => 'nullable|int',
    ]);
    $userAuth = auth()->user();
    $userRoleId = $userAuth->role->role;
    $roleRequest = Role::find($request->id_role);


    if ($userRoleId !== 1 && $roleRequest->role === 1) {
      return redirect()->back()->with('error', 'You are not allowed to assign the Admin role.');
    }

    $this->userService->updateUser($request->id, $user);

    return redirect()->route('system.user.index')->with('success', 'Berhasil Edit');
  }

  public function profile()
  {
    $isRole = SidebarService::getSidebarVisibility();
    $user = auth()->user();
    $cabang = $this->cabangService->getCabangById($user->id_cabang);
    $user->nama_cabang = $cabang->nama_cabang;
    return view('profile', ['name' => 'Profile', 'isRole' => $isRole, 'user' => $user]);
  }

  public function updateProfile(Request $request)
  {
    $updateProfile = $request->validate([
      'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'name' => 'required|string|max:100',
      'old_password' => 'nullable|string',
      'password_baru' => 'nullable|string|min:6|confirmed',
    ]);

    $user = User::find(Auth::id());

    $user->name = $request->name;
    if ($request->hasFile('foto')) {

      if ($user->foto) {
        Storage::disk('public')->delete($user->foto);
      }

      $path = $request->file('foto')->store('foto', 'public');
      $user->foto = $path;
    }

    if ($request->old_password || $request->password_baru || $request->confirm_password_baru) {

      if (!$request->filled('old_password')) {
        return back()->withErrors(['old_password' => 'Password lama harus diisi jika ingin mengganti password.']);
      }

      if (Hash::check($updateProfile['old_password'], $user->password)) {

        if ($request->filled('password_baru')) {
          $user->password = Hash::make($updateProfile['password_baru']);
        }
      } else {
        return back()->withErrors(['old_password' => 'Password lama tidak cocok.']);
      }
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
  }
}
