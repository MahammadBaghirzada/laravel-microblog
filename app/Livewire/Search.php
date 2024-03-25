<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search', [
            'posts' => $this->search ? Post::query()->whereFullText('title', $this->search)->orWhereFullText('content', $this->search)->get() : [],
        ]);
    }
}
