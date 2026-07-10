<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VivahMitraAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if(!session()->has('LoggedMember') && ($request->path() !='member-login')){
    //         return redirect()->route('member.login')->with(session()->flash('alert-warning', 'You must be logged in.'));
    //     }

    //     if(session()->has('LoggedMember') && ($request->path() == 'member-login')){
    //         return redirect('member/dashboard');
    //     }
    //     return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
    //                           ->header('Pragma','no-cache')
    //                           ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');
    // }

    public function handle(Request $request, Closure $next)
        {
            // ------------------------------------
            // 1) If session is gone, check cookie
            // ------------------------------------
            if (!session()->has('LoggedVivahMitra')) {

                // Check remember cookie
                $rememberToken = $request->cookie('creator_remember');

                if ($rememberToken) {
                    $userLogin = \App\Models\UserLogin::where('remember_token', $rememberToken)->first();

                    if ($userLogin) {
                        // Auto-login by restoring session
                        $user = \App\Models\User::find($userLogin->user_id);
                        $request->session()->put('LoggedVivahMitra', $user);
                    }
                }
            }

            // ------------------------------------
            // 2) If user still not logged in → redirect
            // ------------------------------------
            if (!session()->has('LoggedVivahMitra') && ($request->path() != 'vivah-mitra-login')) {
                return redirect()->route('vivahmitra.login')
                                ->with(session()->flash('alert-warning', 'You must be logged in.'));
            }

            // ------------------------------------
            // 3) If already logged in → block login page
            // ------------------------------------
            if (session()->has('LoggedVivahMitra') && ($request->path() == 'vivah-mitra-login')) {
                return redirect('member/dashboard');
            }

            // ------------------------------------
            // 4) Disable caching
            // ------------------------------------
            return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                                ->header('Pragma', 'no-cache')
                                ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
        }


}
