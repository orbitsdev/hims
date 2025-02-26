<x-admin-layout>

    <h1 class="text-2xl mt-8 mb-6"> Reports </h1>
    <div x-data="{ activeTab: 'students' }">
        <!-- Tabs -->
        <div class="flex ">
            <button @click="activeTab = 'students'"
                class="px-4 py-2  m-0  rounded-t-sm "
                :class="{ 'bg-white text-gray-900': activeTab === 'students' }">
                Students
            </button>

            <button @click="activeTab = 'personnel'"
                class="px-4 py-2  m-0  rounded-t-sm "
                :class="{ 'bg-white text-gray-900': activeTab === 'personnel' }">
                Personnels
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4 bg-white">
            <div x-show="activeTab === 'students'" x-cloak>
                {{-- @livewire('student-report') --}}

                @livewire('student-list')
            </div>
            <div x-show="activeTab === 'personnel'" x-cloak>
                @livewire('personnel-list')

            </div>
        </div>
    </div>



</x-admin-layout>
