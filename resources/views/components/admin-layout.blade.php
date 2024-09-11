<div class="h-screen flex ">

        <x-nav />
    <div class="w-full">
        <x-main-header />
        <div class="flex-1 p-4 overflow-y-auto">
            {{$slot}}
        </div>
    </div>

    {{-- <nav class="bg-white">
        <x-main-header />
    </nav>
    <div class="flex flex-1 h-full overflow-hidden">
        <div class="w-[20rem] bg-white px-6 pb-2 flex-shrink-0 h-full overflow-y-auto">
            <div class="h-8"></div>
            <x-nav />
        </div>

    </div> --}}
</div>
