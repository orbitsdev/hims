<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RoleSelection extends Component
{
    public $selectedRole;

    public function selectRole($role)
    {
        $this->selectedRole = $role;
    }

    public function saveRole()
    {
        $user = Auth::user();
        $user->role = $this->selectedRole;
        $user->save();

        // Redirect the user to the dashboard or another page after saving
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.role-selection', [
            'roles' => [
                // 'Admin',
                // 'Staff',
                'Personnel',
                'Student'
            ]
        ]);
    }
}
