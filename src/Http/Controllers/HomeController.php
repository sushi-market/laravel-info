<?php

namespace DF\LaravelInfo\Http\Controllers;

use DF\LaravelInfo\LaravelInfo;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('laravel-info::layout', [
            'sections' => app(LaravelInfo::class)->sections(),
        ]);
    }
}
