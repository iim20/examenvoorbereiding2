<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class CustomerController extends Controller
{
    public function index()
    {
        $role=Auth::user()->is_employee;
        $users = User::all();
        if($role==0){
            return view('customer.index');
        }
        else{
            return back()->with('unauthenticated', 'Je hebt geen toegang');
        }
    }
}
