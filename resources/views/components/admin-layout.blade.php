<div class="h-screen flex">
    <!-- Sidebar Navigation -->
    <x-nav class="h-full" />
    
    <!-- Main Content -->
    <div class="w-full flex flex-col h-full">
        <x-main-header />
        
        <!-- Main Content Slot -->
        <div class="flex-1 p-4 overflow-y-auto h-full">
            {{$slot}}
        </div>
    </div>
</div>
