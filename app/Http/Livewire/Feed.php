<?php

namespace App\Http\Livewire;

use App\Models\Comment;
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
    public $pageType;
    public $explodedURL;

    public function render()
    {
        $this->getTwits();
        return view('livewire.feed', [
            'twits' => $this->twits
        ]);
    }

    public function getTwits()
    {
        $this->getPageType();
        if($this->pageType == 'dashboard') {
            $this->user = Auth::user();
            $this->twits = Twit::whereIn('user_id', $this->user->following->pluck('id'))
            ->orwhereIn('user_id', [$this->user->id])
            ->orderBy('created_at', 'desc')
            ->get();
        } else if($this->pageType == 'twitPage'){
            $twit = Twit::where('id', $this->explodedURL[5])->first();
            $this->user = User::where('username', $this->explodedURL[3])->first();
            $this->twits = Comment::where('twit_id', $twit->id)
            ->orderBy('created_at', 'desc')
            ->get();
        } else if ($this->pageType == 'userPage') {
            $this->user = User::where('username', $this->explodedURL[3])->first();
            $this->twits = Twit::where('user_id', $this->user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        } else if ($this->pageType == 'commentPage') {
            $comment = Comment::where('comment_id', $this->explodedURL[6]->first());
            $twit = Twit::where('twit_id', $this->explodedURL[5]->first());
            dd($this->getTwitAncestors($comment, $twit));

        }
    }

    public function getPageType()
    {
        $this->explodedURL = explode('/', url()->current());
        if($this->explodedURL[3]== 'dashboard') {
            return $this->pageType = 'dashboard';
        } else if (isset($this->explodedURL[5]) && $this->explodedURL[4] == 'status') {
            return $this->pageType = 'twitPage';
        } else if (isset($this->explodedURL[6]) && $this->explodedURL[4] == 'status') {
            return $this->pageType = 'commentPage';
        } else {
            return $this->pageType = 'userPage';
        }
    }

    public function getFeedData()
    {
        return ['user' => $this->user];
    }

    function getTwitAncestors($comment, &$twits) {
        if($comment->parent_id) {
            $parentComment = Comment::find($comment->parent_id);
            $parentTwit = $parentComment->twit;
            $twits[] = $parentTwit;
            $this->getTwitAncestors($parentComment, $twits);
        }
        $this->twits = $twits;
        dd($this->twits);
    }

}
