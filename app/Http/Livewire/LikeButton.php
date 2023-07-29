<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class LikeButton extends Component
{
    public $likes = 0;
    public $liked = false;
    public $postid = null;
    public $userid = null;
    public $createdby = null;
    public $post = null;

    public function mount(?int $likes,bool $liked,?int $postid,?int $userid,?int $createdby)
    {
        $this->likes = $likes;
        $this->liked = $liked;
        $this->postid = $postid;
        $this->userid = $userid;
        $this->createdby = $createdby;
        $this->post = Post::find($postid);
    }

    public function toggleLike(): void
    {
        if($this->isAuthorizedToLike()) {
            if ($this->liked) {
                $this->likes--;
                $like = Like::where('user_id', $this->userid)
                        ->where('post_id', $this->postid)
                        ->first();
                $like->delete();
            } else {
                $this->likes++;
                $like = new Like();
                $like->post_id = $this->postid;
                $like->user_id = $this->userid;
                $like->save();
            }

            $this->liked = !$this->liked;
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }

    public function isAuthorizedToLike()
    {
        return Gate::allows('like', $this->post);
    }

}
