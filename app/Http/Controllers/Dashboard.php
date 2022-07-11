<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard');
    }
}
