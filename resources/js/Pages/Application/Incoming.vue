<template>
    <div class="bg-white text-gray-900 font-sans p-6">


        <main class="max-w-[1200px] mx-auto">
            <header class="mb-6">
                <h1 class="text-lg font-semibold flex items-center gap-1">
                    <span class="border-l-4 border-black pl-2">Incoming</span>
                </h1>
            </header>

            <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <div class="flex items-center gap-6 border-r border-gray-300 pr-6">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-sm text-gray-800">
                        <i class="far fa-check-square text-base"></i>
                        Select all
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer select-none text-sm text-gray-800 border-l border-gray-300 pl-6">
                        <i class="fas fa-filter text-base"></i>
                        Filter by
                    </label>
                </div>
                <form class="flex items-center border border-gray-400 rounded-xl px-4 py-2 w-full max-w-xs">
                    <input
                        type="search"
                        placeholder="Search"
                        class="flex-grow text-sm text-gray-700 placeholder-gray-500 focus:outline-none border-none"
                        aria-label="Search"
                    />
                    <button type="submit" class="ml-2 text-gray-600">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.893 16.92L19.973 20M19 11.5C19 13.4891 18.2098 15.3968 16.8033 16.8033C15.3968 18.2098 13.4891 19 11.5 19C9.51088 19 7.60322 18.2098 6.1967 16.8033C4.79018 15.3968 4 13.4891 4 11.5C4 9.51088 4.79018 7.60322 6.1967 6.1967C7.60322 4.79018 9.51088 4 11.5 4C13.4891 4 15.3968 4.79018 16.8033 6.1967C18.2098 7.60322 19 9.51088 19 11.5Z" stroke="#61646B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </button>
                </form>
            </section>

            <section class="overflow-x-auto">
                <table class="w-full border-collapse min-w-[900px]">
                    <thead>
                    <tr class="bg-gray-700 text-white text-xs font-bold text-left">
                        <th class="py-3 px-3 whitespace-nowrap">SLNO</th>
                        <th class="py-3 px-3 whitespace-nowrap">APPLICANT NAME</th>
                        <th class="py-3 px-3 whitespace-nowrap">CONTACT</th>
                        <th class="py-3 px-3 whitespace-nowrap">GENDER</th>
                        <th class="py-3 px-3 whitespace-nowrap">DESIGNATION</th>
                        <th class="py-3 px-3 whitespace-nowrap">DEPARTMENT</th>
                        <th class="py-3 px-3 whitespace-nowrap">REASON</th>
                        <th class="py-3 px-3 whitespace-nowrap">NO. OF PERSONS</th>
                        <th class="py-3 px-3 whitespace-nowrap">HOUSE</th>
                        <th class="py-3 px-3 whitespace-nowrap">ARRIVAL</th>
                        <th class="py-3 px-3 whitespace-nowrap">DEPARTURE</th>
                        <th class="py-3 px-3 whitespace-nowrap"></th>
                    </tr>
                    </thead>
                    <tbody class="text-xs text-gray-900">
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6982
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Zothanzuala Chhakchhuak</td>
                        <td class="py-4 px-3 whitespace-nowrap">98765 12345</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Under Secretary</td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">General Administrative Department</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-indigo-200 text-indigo-700 rounded-full px-3 py-1 text-[10px] font-medium select-none">On Duty</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">02</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Vasant Vihar</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-100 bg-gray-50">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6981
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Lalhmingsangi Sailo</td>
                        <td class="py-4 px-3 whitespace-nowrap">98123 18765</td>
                        <td class="py-4 px-3 whitespace-nowrap">Female</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Assistant</td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Agriculture Department</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-blue-200 text-blue-600 rounded-full px-3 py-1 text-[10px] font-medium select-none">Medical</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Mumbai</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6980
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Andy Ngurthansangzuala Sailo</td>
                        <td class="py-4 px-3 whitespace-nowrap">88976 12345</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Addt. Director</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">I&PR Department</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-yellow-200 text-yellow-700 rounded-full px-3 py-1 text-[10px] font-medium select-none">Not On Duty</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Vasant Vihar</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-100 bg-gray-50">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6979
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Lalthanngura Hmar</td>
                        <td class="py-4 px-3 whitespace-nowrap">709873 18765</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Ex. Minister</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">NIL</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-yellow-100 text-yellow-800 rounded-full px-3 py-1 text-[10px] font-medium select-none">FLAM</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">New Town</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6978
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Andy Ngurthansangzuala Sailo</td>
                        <td class="py-4 px-3 whitespace-nowrap">87653 45632</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Addt. Director</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">I&PR Department</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-indigo-200 text-indigo-700 rounded-full px-3 py-1 text-[10px] font-medium select-none">On Duty</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Vasant Vihar</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-100 bg-gray-50">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6977
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Lalhmingsangi Sailo</td>
                        <td class="py-4 px-3 whitespace-nowrap">89346 34639</td>
                        <td class="py-4 px-3 whitespace-nowrap">Female</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Assistant</td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Agriculture Department</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-blue-200 text-blue-600 rounded-full px-3 py-1 text-[10px] font-medium select-none">Medical</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Mumbai</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6976
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Andy Ngurthansangzuala Sailo</td>
                        <td class="py-4 px-3 whitespace-nowrap">98436 56395</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Addt. Director</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">I&PR Department</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-yellow-200 text-yellow-700 rounded-full px-3 py-1 text-[10px] font-medium select-none">Not On Duty</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Vasant Vihar</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-100 bg-gray-50">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6975
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Lalthanngura Hmar</td>
                        <td class="py-4 px-3 whitespace-nowrap">89545 76543</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Ex. Minister</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">NIL</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-yellow-100 text-yellow-800 rounded-full px-3 py-1 text-[10px] font-medium select-none">FLAM</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">01</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Salt Lake</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-3 whitespace-nowrap">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" class="w-4 h-4" />
                                6974
                            </label>
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">Andy Ngurthansangzuala Sailo</td>
                        <td class="py-4 px-3 whitespace-nowrap">94585 34596</td>
                        <td class="py-4 px-3 whitespace-nowrap">Male</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">Asst. Professor</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">Govt. HBC</td>
                        <td class="py-4 px-3 whitespace-nowrap">
                            <span class="inline-block bg-red-200 text-red-700 rounded-full px-3 py-1 text-[10px] font-medium select-none">Study Tour</span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">40</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">Bengaluru</td>
                        <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <footer class="mt-6 flex items-center justify-end gap-4 text-xs text-gray-600 select-none">
                <span>Records per page:</span>
                <span class="font-semibold cursor-pointer">10 <i class="fas fa-caret-down"></i></span>
                <nav class="flex items-center gap-3 font-semibold">
                    <button class="w-8 h-8 border border-gray-900 rounded-sm flex items-center justify-center cursor-pointer select-none bg-gray-900 text-white">1</button>
                    <button class="w-8 h-8 cursor-pointer select-none hover:underline">2</button>
                    <button class="w-8 h-8 cursor-pointer select-none hover:underline">3</button>
                    <button class="w-8 h-8 cursor-pointer select-none hover:underline">4</button>
                    <button class="w-8 h-8 cursor-pointer select-none hover:underline">5</button>
                </nav>
            </footer>
        </main>


    </div>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
defineOptions({layout:AuthLayout})

defineProps({
    application: Object,
});

import { ref, computed } from 'vue';

// Sample data
const entries = [
    {
        id: 1,
        slno: 6982,
        applicantName: 'Zothanzuala Chhakchhuak',
        contact: '98765 12345',
        gender: 'Male',
        designation: 'Under Secretary',
        department: 'General Administrative Department',
        reason: 'On Duty',
        reasonClass: 'bg-indigo-200 text-indigo-700',
        noOfPersons: 2,
        house: 'Vasant Vihar',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        id: 2,
        slno: 6981,
        applicantName: 'Lalhmingsangi Sailo',
        contact: '98123 18765',
        gender: 'Female',
        designation: 'Assistant',
        department: 'Agriculture Department',
        reason: 'Medical',
        reasonClass: 'bg-blue-200 text-blue-600',
        noOfPersons: 1,
        house: 'Mumbai',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        id: 3,
        slno: 1234,
        applicantName: 'Lalhmingsangi Sailo',
        contact: '98123 18765',
        gender: 'Female',
        designation: 'Assistant',
        department: 'Agriculture Department',
        reason: 'Medical',
        reasonClass: 'bg-blue-200 text-blue-600',
        noOfPersons: 1,
        house: 'Mumbai',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },

    // More entries...
];

const selectAll = ref(false);
const selectedEntries = ref([]);
const searchQuery = ref('');

// Toggle select all checkboxes
const toggleSelectAll = () => {
    if (selectAll.value) {
        selectedEntries.value = entries.map(entry => entry.id);
    } else {
        selectedEntries.value = [];
    }
};

// Filter data based on search query
const filteredData = computed(() => {
    return entries.filter(entry => {
        return entry.applicantName.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            entry.contact.toLowerCase().includes(searchQuery.value.toLowerCase());
    });
});
</script>

<style>
/* Custom scrollbar removal for Firefox */
table {
    scrollbar-width: none;
}
table::-webkit-scrollbar {
    display: none;
}
</style>
