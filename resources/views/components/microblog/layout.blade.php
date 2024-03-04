<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? null }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    {{-- notification --}}
    <div x-data="{ show: true, message: 'New blog posts has been written' }" x-show="show" x-init="setTimeout(() => show = false, 5000)" @close.window="show=false" x-transition class="flex justify-between m-auto w-3/4 text-blue-200 shadow-inner p-3 bg-blue-600">
        <p><strong>Info </strong><span x-html="message"></span></p>
        <strong @click="$dispatch('close')" class="text-xl align-center cursor-pointer">&times;</strong>
    </div>

    {{-- container for all --}}
    <div class="container mx-auto p-10">
        {{-- header --}}
        <header class="flex justify-between items-center">
            {{-- logo, search --}}
            <div class="flex items-center">
                <x-microblog.images.laravel-logo/>

                <div class="text-3xl hidden md:block text-gray-600 font-medium ml-2 tracking-tight">
                    <a href="{{ url('/') }}">LaravelMicroBlog</a>
                </div>
                <div class="ml-4">
                    <label>
                        <input
                            class="placeholder:italic placeholder:text-slate-400 bg-white w-full border-slate-300 rounded-md py-2 pl-9 pr-3 sm:text-sm"
                            placeholder="Search for posts ..." type="text" name="search"/>
                    </label>
                    <ul class="bg-white border border-gray-100 mt-2 absolute">
                        <li
                            class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative hover:bg-yellow-50 hover:text-gray-900">
                            <a href="{{ route('posts.show', 1) }}">Post title</a>
                        </li>
                        <li
                            class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative hover:bg-yellow-50 hover:text-gray-900">
                            <a href="{{ route('posts.show', 1) }}">Post title</a>
                        </li>

                    </ul>
                </div>
            </div>
            {{-- links --}}
            <div class="text-lg hidden md:flex space-x-6">
                @if (Auth::check())
                    <p>Logged as: <a class="hover:text-stone-500"
                                     href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a></p>
                    <x-microblog.logout-form/>
                    <a href="{{ route('posts.create') }}"
                       class="inline font-bold text-sm px-6 py-2 text-white rounded-full bg-red-500 hover:bg-red-600">{{ __('New blog post') }}</a>
                @else
                    <a class="tracking-widest hover:text-stone-500" href="{{ route('login') }}">Login</a>
                    <a class="tracking-widest hover:text-stone-500" href="{{ route('register') }}">Register</a>
                @endif
            </div>

            {{-- hamburger icon --}}
            <div id="hamburger-icon" class="space-y-2 cursor-pointer md:hidden">
                <div class="w-8 h-0.5 bg-gray-600"></div>
                <div class="w-8 h-0.5 bg-gray-600"></div>
                <div class="w-8 h-0.5 bg-gray-600"></div>
            </div>
        </header>
        {{-- mobile menu --}}
        <div class="md:hidden">
            <div id="mobile-menu"
                 class="flex-col items-center hidden py-8 mt-10 space-y-6 bg-white left-6 right-6 drop-shadow-lg">
                @if (Auth::check())
                    <p>Logged as: <a class="hover:text-stone-500"
                                     href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a></p>
                    <x-microblog.logout-form/>
                    <a href="{{ route('posts.create') }}"
                       class="inline font-bold text-sm px-6 py-2 text-white rounded-full bg-red-500 hover:bg-red-600">
                        New
                        blog post</a>
                @else
                    <a class="tracking-widest hover:text-stone-500" href="{{ route('login') }}">Login</a>
                    <a class="tracking-widest hover:text-stone-500" href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>


        {{ $slot }}

        {{-- footer --}}
        <footer class="flex items-center justify-center mt-12">
            &copy; 2024 LaravelMicroBlog
        </footer>
    </div>
</body>

</html>
