<?php

namespace App\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $likes;
    public $dislikes;

    public function like()
    {
        $this->likes++;
    }

    public function undoLike()
    {
        $this->likes--;
    }

    public function dislike()
    {
        $this->dislikes++;
    }

    public function undoDislike()
    {
        $this->dislikes--;
    }

    public function render()
    {
        return view('livewire.like');
    }
}
