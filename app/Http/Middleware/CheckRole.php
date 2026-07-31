<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // kita tangkap role user yg sedang login
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        if ($request->user()->role == 'karyawan') {
            return redirect('/absensi/karyawan')->with('forbidden', 'Anda hanya memiliki akses ke menu Absensi');
        }

        return redirect('/dashboard')->with('forbidden', 'Anda tidak memiliki akses');
    }
}
