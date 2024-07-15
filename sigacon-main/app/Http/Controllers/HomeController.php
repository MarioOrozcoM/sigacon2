<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //

    public function changePassword()
{
   return view('change-password');
}

public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Contraseña actual incorrecta!");
        }


        #Update the new Password
        ModelsUser::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Contraseña actualizada con éxito!");
}
}
