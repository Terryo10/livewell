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

    public function render()
    {

        $user = Auth::user();
        $this->postContent = Str::limit($this->post->content, 500);
        $canRead = false;
        if ($user != null) {
            if ($user->subscribed != null) {
                if ($user->subscribed->expires_at > Carbon::now()) {
                    $this->postContent = $this->post->content;
                    $canRead = true;
                } else {
                    $canRead = false;
                }
            }
        }
        return view(
            'livewire.single-post',
            [
                'post' => $this->post,
                'canRead' => $canRead,
                'postContent' => $$this->postContent
            ]
        );
    }

    public function continueReading()
    {
        $this->postContent = $this->post->content;
    }
}
