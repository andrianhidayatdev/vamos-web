<?php

namespace App\Http\Middleware;

use App\Models\OtherSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LanguageSettingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $setting = OtherSetting::where('user_id', Auth::id())->first();
            $locale = $setting->bahasa ?? 'id';

            if ($locale === 'en') {
                App::setLocale('en');
            } else {
                App::setLocale('id');
            }
        } else {

            App::setLocale('id');
        }

        return $next($request);
    }
}
