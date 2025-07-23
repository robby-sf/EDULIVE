<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function statistic()
    {
        // nambahin database di sini.
        return view('statistic');
    }
}
