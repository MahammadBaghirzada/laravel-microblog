<div class="flex">
    @if (Auth::check())
        @if ($isLiked = $post->isLiked())
            <a wire:key="isliked-{{$post->id}}" wire:click="undoLike" title="undo like" class="cursor-pointer">
                <x-microblog.images.like-icon class="fill-green-500 hover:stroke-cyan-700" />

            </a>
        @elseif($isDisliked = $post->isDisliked())
            <a wire:key="isdisliked-{{$post->id}}" title="you disliked this" class="post">
                <x-microblog.images.like-icon class="fill-green-300" />
            </a>
        @else
            <a wire:key="is1liked-{{$post->id}}" wire:click="like" title="like" class="cursor-pointer">
                <x-microblog.images.like-icon class="fill-green-300 hover:stroke-cyan-700" />
            </a>
        @endif
        ({{ $post->usersThatLike()->count() }})
        @if ($isDisliked ?? false)
            <a wire:key="i2sliked-{{$post->id}}" wire:click="undoDislike" title="undo dislike" class="ml-2 cursor-pointer">
                <x-microblog.images.unlike-icon class="fill-red-500 hover:stroke-cyan-700" />
            </a>
        @elseif($isLiked ?? false)
            <a wire:key="i3sliked-{{$post->id}}" title="you like this post" class="ml-2">
                <x-microblog.images.unlike-icon class="fill-red-300" />
            </a>
        @else
            <a wire:key="i4sliked-{{$post->id}}" wire:click="dislike" title="dislike" class="ml-2 cursor-pointer">
                <x-microblog.images.unlike-icon class="fill-red-300 hover:stroke-cyan-700" />
            </a>
        @endif
        ({{ $post->usersThatDislike()->count() }})
    @else
        <a href="#" title="login to like" class="pointer-events-none">
            <x-microblog.images.like-icon class="fill-green-300" />
        </a>
        ({{ $post->usersThatLike()->count() }})
        login to like
        <a href="#" title="login to dislike" class="ml-2 pointer-events-none">
            <x-microblog.images.unlike-icon class="fill-red-300" />
        </a>
        ({{ $post->usersThatDislike()->count() }})
        login to dislike
    @endif
</div>
