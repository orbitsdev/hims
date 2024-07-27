
<div class="h-screen">
    <nav class="bg-white  ">
        <x-main-header />
    </nav>
    <div class="relative flex flex-1 h-screen">
        <div class="w-[20rem] bg-white px-6 pb-2 flex-shrink-0 h-screen">
            <div class="h-8"></div>
            <x-nav/>
        </div>
        <div class="flex-1 p-4">
            {{$slot}}
        </div>
    </div>
</div>