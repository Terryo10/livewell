<?php

namespace App\Http\Livewire;

use App\Models\BlogCategories;
use App\Models\PostComments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SinglePost extends Component
{
    public $post;
    public $postContent;
    public $canRead = false;
    public $newComment;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';



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
                'postContent' => $this->postContent,
                'comments' => PostComments::where('post_id', $this->post->id)->orderBy('created_at', 'desc')->paginate(5),
                'categories' => BlogCategories::all()
            ]
        );
    }



    public function continueReading()
    {
        //navigate to subscription page
        if(Auth::user()== null){
            session()->flash('message', 'You need to login to read the full post.');
    }
        return redirect()->route('subscriptions');
    }

    public function addComment()
    {

      if($this->__isset($this->newComment) || $this->newComment == null) {
          session()->flash('message', 'Comment cannot be empty.');
          return redirect()->route('post', ['id' => $this->post->id]);
      }
       else if ($this->canRead == false) {
            session()->flash('message', 'You need to subscribe to read the full post.');
            return redirect()->route('subscriptions');
        }else{
            $user = Auth::user();
            $this->post->comments()->create([
                'post_id' => $this->post->id,
                'content' => $this->newComment,
                'user_id'=>$user->id
            ]);
            $this->newComment = null;
            session()->flash('message', 'Comment added successfully.');
            return redirect()->route('post', ['id' => $this->post->id]);
        }
    }
}


