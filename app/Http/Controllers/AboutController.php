<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $institutional = config('institutional');
        $team = TeamMember::published()->ordered()->get();

        return view('about', compact('institutional', 'team'));
    }
}
