<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Summary of loginForm
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function loginForm(Request $request): View
    {
        return view("admin/auth/login");
    }

    /**
     * Summary of login
     * @param \App\Http\Requests\Admin\Auth\LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $validateRequest = $request->validated();

        if ($validateRequest) {
            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
        }

        return redirect()->back();
    }

    /**
     * Summary of logout
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.form');
    }
}
