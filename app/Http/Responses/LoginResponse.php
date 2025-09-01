<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $admin_url = 'admin-dashboard';
        $user_url = 'dashboard';
        $role = auth()->user()->role;

        return redirect()->intended($role === 'user' ? $user_url : $admin_url);
    }
}