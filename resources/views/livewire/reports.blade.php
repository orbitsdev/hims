<x-admin-layout>

    <h1 class="text-2xl mt-8 mb-6">Reports</h1>

    <div x-data="{
            activeTab: sessionStorage.getItem('activeTab') || 'students',
            setActiveTab(tab) {
                this.activeTab = tab;
                sessionStorage.setItem('activeTab', tab);
            }
        }">

        <!-- Tabs -->
        <div class="flex">
            <button @click="setActiveTab('students')"
                class="px-4 py-2 m-0 rounded-t-sm"
                :class="{ 'bg-white text-gray-900': activeTab === 'students' }">
                Students
            </button>

            <button @click="setActiveTab('personnel')"
                class="px-4 py-2 m-0 rounded-t-sm"
                :class="{ 'bg-white text-gray-900': activeTab === 'personnel' }">
                Personnels
            </button>

            <button @click="setActiveTab('staffs')"
                class="px-4 py-2 m-0 rounded-t-sm"
                :class="{ 'bg-white text-gray-900': activeTab === 'staffs' }">
                Staffs
            </button>

            <button @click="setActiveTab('emergency_contacts')"
                class="px-4 py-2 m-0 rounded-t-sm"
                :class="{ 'bg-white text-gray-900': activeTab === 'emergency_contacts' }">
                Emergency Contacts
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4 bg-white">
            <div x-show="activeTab === 'students'" x-cloak>
                @livewire('student-list')
            </div>

            <div x-show="activeTab === 'personnel'" x-cloak>
                @livewire('personnel-list')
            </div>

            <div x-show="activeTab === 'staffs'" x-cloak>
                @livewire('staff-list')
            </div>

            <div x-show="activeTab === 'emergency_contacts'" x-cloak>
                <div class="container mx-auto py-6 px-4 max-w-5xl">
                   

                    <!-- Emergency Contact List -->
                    <div id="printArea" class="border p-6 bg-white">
                        <!-- Header with Logo -->
                        <div class="text-right mb-4">
                            <button onclick="printDiv('printArea')" class="px-4 py-2 bg-gray-600 text-white rounded">
                                <i class="fas fa-print"></i> Print Emergency Contacts
                            </button>
                        </div>

                        <!-- Emergency Contacts Table -->
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 p-2 text-left">#</th>
                                    <th class="border border-gray-300 p-2 text-left">Name</th>
                                    <th class="border border-gray-300 p-2 text-left">Contact</th>
                                    <th class="border border-gray-300 p-2 text-left">Address</th>
                                    <th class="border border-gray-300 p-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $index => $contact)
                                    <tr>
                                        <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                                        <td class="border border-gray-300 p-2">{{ $contact->name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 p-2">{{ $contact->contact ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 p-2">{{ $contact->address ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 p-2 font-medium">
                                            <span class="{{ $contact->active ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $contact->active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border border-gray-300 p-4 text-center text-gray-500">
                                            No emergency contacts found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
</x-admin-layout>
