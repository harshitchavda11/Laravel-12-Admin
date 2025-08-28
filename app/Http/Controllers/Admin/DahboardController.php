<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DahboardController extends Controller
{
    /**
     * Summary of dashboard
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}
