<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $user;
    public $showUsers;

    public function render()
    {
        $this->getUsers();
        return view('livewire.user-list', [
            'users' => $this->showUsers
        ]);
    }

    public function getUsers()
    {
        $explodedURL = explode('/', url()->current());
        $this->user = User::where('username', $explodedURL[4])->first();
        if($explodedURL[5]== 'followers') {
            $this->showUsers = $this->user->followers;
        } else {
            $this->showUsers = $this->user->following;
        }
    }
}
