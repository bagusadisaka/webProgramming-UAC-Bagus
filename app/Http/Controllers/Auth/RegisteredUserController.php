<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('Register.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validateddata = $request->validate([
            'Fullname' => ['required', 'string', 'max:20','min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'instagram' => ['required', 'string'],
            'birthDate'=>['required'],
            'gender'=>['required'],
            'phonenumber'=>['required','min:10','max:13'],
            'image'=>['required'],
            'password' => ['required', 'min:3', 'max:1000'],

        ]);

        $validateddata['image'] = $request->file('image')->store('profile-images');

        $user = User::all();

        $user = User::create([
            'name' => $validateddata['Fullname'],
            'email' => $validateddata['email'],
            'instagram' => $validateddata['instagram'],
            'phonenumber'=>$validateddata['phonenumber'],
            'image'=>$validateddata['image'],
            'gender'=>$validateddata['gender'],
            'birthdate'=>$validateddata['birthDate'],
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME)->with('success','Congratulations! Your account already registered');
    }
}
