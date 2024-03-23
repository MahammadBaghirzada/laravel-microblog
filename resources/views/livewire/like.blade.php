<div class="flex">
    @if (Auth::check())
        <a wire:click="undoLike" title="undo like" class="cursor-pointer">
            <x-microblog.images.like-icon class="fill-green-500 hover:stroke-cyan-700" />

        </a>

        <a title="you disliked this" class="post">
            <x-microblog.images.like-icon class="fill-green-300" />
        </a>

        <a wire:click="like" title="like" class="cursor-pointer">
            <x-microblog.images.like-icon class="fill-green-300 hover:stroke-cyan-700" />
        </a>

        ({{ $likes }})
        <a wire:click="undoDislike" title="undo dislike" class="ml-2 cursor-pointer">
            <x-microblog.images.unlike-icon class="fill-red-500 hover:stroke-cyan-700" />
        </a>

        <a title="you like this post" class="ml-2">
            <x-microblog.images.unlike-icon class="fill-red-300" />
        </a>
        <a wire:click="dislike" title="dislike" class="ml-2 cursor-pointer">
            <x-microblog.images.unlike-icon class="fill-red-300 hover:stroke-cyan-700" />
        </a>
        ({{ $dislikes }})
    @else
        <a href="#" title="login to like" class="pointer-events-none">
            <x-microblog.images.like-icon class="fill-green-300" />
        </a>
        (12)
        login to like
        <a href="#" title="login to dislike" class="ml-2 pointer-events-none">
            <x-microblog.images.unlike-icon class="fill-red-300" />
        </a>
        (2)
        login to dislike
    @endif
</div>
