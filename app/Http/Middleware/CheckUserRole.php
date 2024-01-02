<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah pengguna memiliki salah satu peran yang diizinkan
        if ($request->user() && $request->user()->hasAnyRole(...$roles)) {
            return $next($request);
        }

        // Redirect atau tindakan lain jika perlu
        return redirect('/'); // Ganti dengan URL yang sesuai
    }
}
