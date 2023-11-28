<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create() {
        return view("pages.register.create");
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'password' => ['required', 'min:7', 'max:191']
        ]);

        (new User())->create($attributes);

        return redirect('/login')->with('success', 'Registration successful!');
    }
}
