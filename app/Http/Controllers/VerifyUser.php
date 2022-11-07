<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyUser extends Controller
{
    public function notifyUser()
    {
        return view('verification.notice');
    }
}
