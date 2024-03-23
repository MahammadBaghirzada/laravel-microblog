<x-microblog.layout>
    <x-slot:title>
        Show a post
    </x-slot:title>
    <div class="my-14 flex flex-col">
        <div class="text-center">
            <p class="text-gray-500">{{ $post->created_at->format('d M Y') }}</p>
            <p class="italic text-sm">by {{ $post->user->name }} <img class="ml-2 object-scale-down h-14 w-14 rounded-full inline"
                                                                      src="{{ asset('storage/' . $post->user->image?->path) }}" alt="profile image"></p>

            <h1 class="mb-10 text-6xl font-bold tracking-tighter mt-5">{{ $post->title }}</h1>
            <hr>
        </div>

        <p class="text-gray-500 mt-10 leading-8">
            {{ $post->content }}
        </p>

        <div class="flex mt-10">

            <livewire:like :post="$post" />
            @if (Auth::user() && Auth::user()->id != $post->user->id)
                @if (Auth::user()->isFollowing($post->user))
                    You follow:&nbsp;<a class="text-green-500 hover:text-green-700" href="{{ route('posts.user', $post->user->id) }}">
                        {{ $post->user->name }}</a>
                @else
                    <a href="{{ route('toggleFollow', $post->user) }}"
                       class="ml-3 inline font-bold text-sm px-6 py-2 text-white rounded bg-blue-500 hover:bg-blue-600">
                        {{ __('Follow the post author') }}</a>
                @endif
            @endif
        </div>

    </div>
</x-microblog.layout>
