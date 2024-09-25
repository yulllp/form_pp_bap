<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OngoingController extends Controller
{
    public function index() {
        return view('ongoing', ['title' => 'On Going']);
    }
}
