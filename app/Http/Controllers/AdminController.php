<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function usertable(){
        $user = User::where('Admin','!=',1)->get();

        return view('pagesprofile',compact('user'));
    }

    public function updatedata(Request $request,$id){

        $user = User::all();
        $userchange = User::where('id',$id)->first();
        $userchange->Banned = $request->StatusBanned;
        $userchange->save();

        return view('pagesprofile',compact('user'));
    }
}
