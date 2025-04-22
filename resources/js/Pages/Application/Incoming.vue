<template>


    <div class="bg-white text-gray-900 font-sans p-6">
    <div id="app" class="max-w-[1200px] mx-auto">
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
            <form @submit.prevent class="flex items-center border border-gray-400 rounded-xl px-4 py-2 w-full max-w-xs">
                <input
                    v-model="search"
                    type="search"
                    placeholder="Search"
                    class="flex-grow text-sm text-gray-700 placeholder-gray-500 focus:outline-none"
                    aria-label="Search"
                />
                <button type="submit" class="ml-2 text-gray-600">
                    <i class="fas fa-search"></i>
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
                <tr
                    v-for="(item, index) in filteredItems"
                    :key="item.slno"
                    :class="index % 2 === 1 ? 'bg-gray-50 border-b border-gray-100' : 'border-b border-gray-200'"
                >
                    <td class="py-4 px-3 whitespace-nowrap">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" class="w-4 h-4" />
                            {{ item.slno }}
                        </label>
                    </td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">{{ item.applicantName }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.contact }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.gender }}</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">{{ item.designation }}</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">{{ item.department }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  :class="[
                  'inline-block rounded-full px-3 py-1 text-[10px] font-medium select-none',
                  item.reason === 'On Duty' ? 'bg-indigo-200 text-indigo-700' :
                  item.reason === 'Medical' ? 'bg-blue-200 text-blue-600' :
                  item.reason === 'Not On Duty' ? 'bg-yellow-200 text-yellow-700' :
                  item.reason === 'FLAM' ? 'bg-yellow-100 text-yellow-800' :
                  item.reason === 'Study Tour' ? 'bg-red-200 text-red-700' : ''
                ]"
              >
                {{ item.reason }}
              </span>
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.noOfPersons }}</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">{{ item.house }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.arrival }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.departure }}</td>
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
    </div>
    </div>



</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
defineOptions({layout:AuthLayout})

defineProps({
    application: Object,
});

import { ref, computed } from 'vue';


const items = ref([
    {
        slno: '6982',
        applicantName: 'Zothanzuala Chhakchhuak',
        contact: '98765 12345',
        gender: 'Male',
        designation: 'Under Secretary',
        department: 'General Administrative Department',
        reason: 'On Duty',
        noOfPersons: '02',
        house: 'Vasant Vihar',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6981',
        applicantName: 'Lalhmingsangi Sailo',
        contact: '98123 18765',
        gender: 'Female',
        designation: 'Assistant',
        department: 'Agriculture Department',
        reason: 'Medical',
        noOfPersons: '01',
        house: 'Mumbai',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6980',
        applicantName: 'Andy Ngurthansangzuala Sailo',
        contact: '88976 12345',
        gender: 'Male',
        designation: 'Addt. Director',
        department: 'I&PR Department',
        reason: 'Not On Duty',
        noOfPersons: '01',
        house: 'Vasant Vihar',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6979',
        applicantName: 'Lalthanngura Hmar',
        contact: '709873 18765',
        gender: 'Male',
        designation: 'Ex. Minister',
        department: 'NIL',
        reason: 'FLAM',
        noOfPersons: '01',
        house: 'New Town',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6978',
        applicantName: 'Andy Ngurthansangzuala Sailo',
        contact: '87653 45632',
        gender: 'Male',
        designation: 'Addt. Director',
        department: 'I&PR Department',
        reason: 'On Duty',
        noOfPersons: '01',
        house: 'Vasant Vihar',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6977',
        applicantName: 'Lalhmingsangi Sailo',
        contact: '89346 34639',
        gender: 'Female',
        designation: 'Assistant',
        department: 'Agriculture Department',
        reason: 'Medical',
        noOfPersons: '01',
        house: 'Mumbai',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6976',
        applicantName: 'Andy Ngurthansangzuala Sailo',
        contact: '98436 56395',
        gender: 'Male',
        designation: 'Addt. Director',
        department: 'I&PR Department',
        reason: 'Not On Duty',
        noOfPersons: '01',
        house: 'Vasant Vihar',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6975',
        applicantName: 'Lalthanngura Hmar',
        contact: '89545 76543',
        gender: 'Male',
        designation: 'Ex. Minister',
        department: 'NIL',
        reason: 'FLAM',
        noOfPersons: '01',
        house: 'Salt Lake',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
    {
        slno: '6974',
        applicantName: 'Andy Ngurthansangzuala Sailo',
        contact: '94585 34596',
        gender: 'Male',
        designation: 'Asst. Professor',
        department: 'Govt. HBC',
        reason: 'Study Tour',
        noOfPersons: '40',
        house: 'Bengaluru',
        arrival: '1-3-2025',
        departure: '5-3-2025',
    },
]);

const search = ref('');


const filteredItems = computed(() => {
    if (!search.value.trim()) return items.value;
    const s = search.value.toLowerCase();
    return items.value.filter((item) =>
        Object.values(item).some((val) =>
            String(val).toLowerCase().includes(s)
        )
    );
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
