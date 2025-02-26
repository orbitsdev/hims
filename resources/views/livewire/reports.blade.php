<x-admin-layout>

    <h1 class="text-2xl mt-8 mb-6"> Reports </h1>
    <div x-data="{ activeTab: 'students' }">
        <!-- Tabs -->
        <div class="flex ">
            <button @click="activeTab = 'students'"
                class="px-4 py-2  m-0 rounded-b-md border-r border-l border-t border-gray-800"
                :class="{ 'bg-white text-gray-900': activeTab === 'students' }">
                Student Report
            </button>

            <button @click="activeTab = 'personnel'"
                class="px-4 py-2  m-0 rounded-b-md border-r border-l border-t border-gray-800"
                :class="{ 'bg-white text-gray-900': activeTab === 'personnel' }">
                Personnel Report
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4 bg-white">
            <div x-show="activeTab === 'students'" x-cloak>
                {{-- @livewire('student-report') --}}

                @livewire('student-list')
            </div>
            <div x-show="activeTab === 'personnel'" x-cloak>
                Studnr
                {{-- @livewire('personnel-report') --}}
            </div>
        </div>
    </div>



</x-admin-layout>
