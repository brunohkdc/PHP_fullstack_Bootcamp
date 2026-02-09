<?php

namespace App\Livewire\Settings;

use Livewire\Component;

use App\Models\User;

class UserManagement extends Component
{
    public function render()
    {
        $this->authorize('is.admin');
        
        return view('livewire.settings.user-management', ['users' => User::paginate(5)]);
    }
}
