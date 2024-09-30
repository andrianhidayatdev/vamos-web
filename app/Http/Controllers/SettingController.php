<?php

namespace App\Http\Controllers;

use App\Http\Services\CabangService;
use App\Http\Services\SettingService;
use App\Http\Services\SidebarService;
use App\Models\OtherSetting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private CabangService $cabangService;

    function __construct(CabangService $cabangService)
    {
        $this->cabangService = $cabangService;
    }

    function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();

        $setting = Setting::where('id_cabang', $user->id_cabang)->first();

        return view('system.setting', ['name' => __('messages.settings'), 'isRole' => $isRole, 'user' => $user, 'setting' => $setting]);
    }

    function updateOrCreate(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kartu_member' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telepon' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'diskon' => 'nullable|integer|min:0|max:100',
        ]);

        $id_cabang = auth()->user()->id_cabang;

        $setting = Setting::updateOrCreate(
            ['id_cabang' => $id_cabang],
            [
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'diskon' => $request->diskon,
            ]
        );

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $logoPath = $request->file('logo')->store('logo', 'public');
            $setting->logo = $logoPath;
        }

        if ($request->hasFile('kartu_member')) {
            if ($setting->kartu_member) {
                Storage::disk('public')->delete($setting->kartu_member);
            }
            $kartuMemberPath = $request->file('kartu_member')->store('kartu_member', 'public');
            $setting->kartu_member = $kartuMemberPath;
        }

        $setting->save();
        Log::channel('database')->info("{$setting->cabang->nama_cabang}", [
            'table_name' => 'setting_cabang',
            'id_row' => $setting->id_setting,
            'action' => 'perbarui',
            'context' => $setting,
        ]);
        return redirect()->route('system.setting')->with('success', 'Berhasil ');
    }

    public function createOrUpdateOtherSetting(Request $request)
    {

        $Othersetting = OtherSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'bahasa' => $request->bahasa,
            ]
        );
        $Othersetting->save();
        return redirect()->route('system.setting')->with('success', 'Berhasil ');
    }
}
