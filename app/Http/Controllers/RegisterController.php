<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
class RegisterController extends Controller
{
    public function create() {
        return view("pages.register.create");
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'max:191', 'email', 'unique:users'],
            'password' => ['required', 'string', Rules\Password::default()]
        ]);

        if ($validator) {
            try {
                (new User())->create($validator);
                return redirect('/login')->with('success', 'Registration successful!');
            } catch (\Exception $e) {
                return back()->withErrors(['message' => 'Registration failed. Please try again.']);
            }
        } else {
            return back()->withErrors($validator)->withInput();
        }
    }

}
