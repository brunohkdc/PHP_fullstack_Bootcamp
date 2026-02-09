<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Illuminate\Support\Facades\File;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $username = '';

    public string $email = '';

    public string $role = '';

    public string $password = '';

    public string $password_confirmation = '';


    public function render()
    {
        $all_roles = File::json('assets/roles.json', JSON_THROW_ON_ERROR);
        
        return view('livewire.auth.register', ['roles' => $all_roles["roles"]]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:191', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:191', 'unique:'.User::class],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($validated);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
