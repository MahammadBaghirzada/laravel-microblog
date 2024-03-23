<div class="flex">
    @if (Auth::check())
        <a title="undo like" class="cursor-pointer">
            <x-microblog.images.like-icon class="fill-green-500 hover:stroke-cyan-700" />

        </a>

        <a title="you disliked this" class="post">
            <x-microblog.images.like-icon class="fill-green-300" />
        </a>


        (13)
        <a title="undo dislike" class="ml-2 cursor-pointer">
            <x-microblog.images.unlike-icon class="fill-red-500 hover:stroke-cyan-700" />
        </a>

        <a title="you like this post" class="ml-2">
            <x-microblog.images.unlike-icon class="fill-red-300" />
        </a>
        (3)
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
