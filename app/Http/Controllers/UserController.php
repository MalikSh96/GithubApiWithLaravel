<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        //steps 
        /*
        Validation
        Within Laravels base controller, there is a validate method
        */
        //validate throw exception if not validated, so don't worry about checking
        $this->validate($request, [
            'username' => 'required',
        ]); 

        //store user
        User::create([
            'username' => $request->username,
        ]); //eloquent

        //redirect
        return redirect()->route('index');
    }
}
