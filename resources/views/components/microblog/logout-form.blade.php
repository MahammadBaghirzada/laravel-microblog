<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="tracking-widest hover:text-stone-500">
        {{ __('Logout') }}
    </button>
</form>
