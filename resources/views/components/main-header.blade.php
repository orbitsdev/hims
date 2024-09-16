<nav class="   px-4 bg-white ">
    <div class="mx-auto   ">
        <div class="relative flex  py-2 items-center justify-end    lg:border-opacity-25">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
            
        </div>
    </div>

    {{-- @include('components.mobile.main-header') --}}
</nav>
