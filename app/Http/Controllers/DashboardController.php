<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return \view('dashboard');
    }
    public function form()
    {
        return \view('form');
    }
    public function list()
    {
        return \view('list');
    }
}
