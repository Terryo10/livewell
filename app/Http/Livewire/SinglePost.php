<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class SinglePost extends Component
{
    public $post;
    public $postContent;
    public $canRead = false;

    public function render()
    {

        $user = Auth::user();
        $this->postContent = Str::limit($this->post->content, 500);
       
        if ($user != null) {
            if ($user->subscribed != null) {
                if ($user->subscribed->expires_at > Carbon::now()) {
                    $this->postContent = $this->post->content;
                    $this->canRead = true;
                } else {
                    $this->canRead = false;
                }
            }
        }
        return view(
            'livewire.single-post',
            [
                'post' => $this->post,
                'canRead' => $this->canRead,
                'postContent' => $this->postContent
            ]
        );
    }

    public function continueReading()
    {
        //navigate to subscription page
        return redirect()->route('subscriptions');
    }
}
