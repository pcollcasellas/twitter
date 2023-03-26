<?php

namespace App\Http\Livewire;

use App\Models\Twit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewTwit extends Component
{
    public $newTwitBody;

    public function createTwit()
    {
        if ($this->newTwitBody){
            $attributes = [
                'user_id' => Auth::user()->id,
                'body' => $this->newTwitBody
            ];
            Twit::create($attributes);
            $this->newTwitBody = null;
            $this->emit('newTwitAdded');
        }
    }

    public function render()
    {
        return view('livewire.new-twit');
    }
}
