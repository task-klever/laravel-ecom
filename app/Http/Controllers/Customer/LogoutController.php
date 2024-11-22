<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Hash;
use Auth;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
}
