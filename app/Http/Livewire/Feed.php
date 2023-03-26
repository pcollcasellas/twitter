<?php

namespace App\Http\Livewire;

use App\Models\Twit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Feed extends Component
{
    protected $listeners = ['newTwitAdded' => 'render'];
    public $user;
    public $twits;

    public function render()
    {
        $this->getTwits();
        return view('livewire.feed', [
            'twits' => $this->twits
        ]);
    }

    public function getTwits()
    {
        $explodedURL = explode('/', url()->current());
        if($explodedURL[3]== 'users') {
            $this->user = User::where('username', $explodedURL[4])->first();
            $this->twits = Twit::where('user_id', $this->user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $this->user = Auth::user();
            $this->twits = Twit::whereIn('user_id', $this->user->following->pluck('id'))
            ->orwhereIn('user_id', [$this->user->id])
            ->orderBy('created_at', 'desc')
            ->get();
        }
    }

    public function getFeedData()
    {
        return ['user' => $this->user];
    }
}
