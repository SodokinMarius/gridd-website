<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $poles = config('services_content');

        return view('services', compact('poles'));
    }
}
