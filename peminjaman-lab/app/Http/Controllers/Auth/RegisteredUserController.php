<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $role = Role::where('nama','=','mahasiswa')->first();
        return view('auth.register',compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim'      => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_role'  => ['required', 'exists:roles,id'],
        ]);

        $user = User::create([
                'name'     => $request->name,
                'nim'      => $request->nim,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'no_hp'    => '-',
                'id_role'  => $request->id_role,

        ]);
        return redirect()->route('login')->with('success', 'Akun Mahasiswa berhasil dibuat! Silakan login.');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
