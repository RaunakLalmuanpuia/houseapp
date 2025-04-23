<template>

    <div class="ml-6">
        <section class="flex flex-wrap gap-4 mb-4 text-[12px] font-semibold">
            <div class="w-[190px] h-[78px] bg-[#FFF4E5] text-[#F59E0B] rounded-md px-3 py-2 flex flex-col justify-center">
                <span class="text-[15px] font-bold leading-none">106</span>
                <span class="font-normal">Incoming</span>
            </div>
            <div class="w-[190px] h-[78px] bg-[#D9F7EE] text-[#10B981] rounded-md px-3 py-2 flex flex-col justify-center">
                <span class="text-[15px] font-bold leading-none">2,098</span>
                <span class="font-normal">Approved</span>
            </div>
            <div class="w-[190px] h-[78px] bg-[#FEE2E2] text-[#EF4444] rounded-md px-3 py-2 flex flex-col justify-center">
                <span class="text-[15px] font-bold leading-none">98</span>
                <span class="font-normal">Rejected</span>
            </div>
            <div class="w-[190px] h-[78px] bg-[#DBF2FF] text-[#3B82F6] rounded-md px-3 py-2 flex flex-col justify-center">
                <span class="text-[15px] font-bold leading-none">23,23,098</span>
                <span class="font-normal">All Application</span>
            </div>
        </section>


    </div>

<!--{{application}}-->

    <div class="ml-6 py-5 bg-white text-gray-900 font-sans ">
        <div id="app" class="mx-auto">
        <header class="mb-6">
            <h1 class="text-lg font-semibold flex items-center gap-1">
                <span class="border-l-4 border-black pl-2">Incoming</span>
            </h1>
        </header>

        <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div class="flex items-center gap-6 border-r border-gray-300 pr-6">
                <label class="flex items-center gap-2 cursor-pointer select-none text-sm text-gray-800">
                    <input
                        type="checkbox"
                        @change="toggleSelectAll($event.target.checked)"
                        :checked="allSelected"
                    />
                    Select all
                </label>


                <select
                    v-model="state.type"
                    @change="handleSearch"
                    class="appearance-none bg-white  text-sm px-3 py-1  font-semibold text-gray-700 cursor-pointer border-none"
                >
                <option value="">All Types</option>
                <option value="FLAM">FLAM</option>
                <option value="ON DUTY">On Duty</option>
                <option value="NOT ON DUTY">Not On Duty</option>
                <option value="PRIVATE">Private</option>
                <option value="STUDY TOUR">Study Tour</option>
                <!-- Add more types as per your needs -->
                </select>
            </div>


            <div @submit.prevent class="flex items-center border border-gray-400 rounded-xl px-4 py-2 w-full max-w-xs">
                <input
                    v-model="state.search"
                    type="search"
                    placeholder="Search"
                    @keyup.enter="handleSearch"
                    class="flex-grow text-sm text-gray-700 placeholder-gray-500 focus:outline-none border-none"
                    aria-label="Search"
                />
                <button v-if="state.search" @click="clearSearch" class="ml-1 text-gray-500 hover:text-red-500" title="Clear Search">
                    ✕
                </button>
                <button @click="handleSearch" type="submit" class="ml-2 text-gray-600">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.893 13.92L16.973 17M16 8.5C16 10.4891 15.2098 12.3968 13.8033 13.8033C12.3968 15.2098 10.4891 16 8.5 16C6.51088 16 4.60322 15.2098 3.1967 13.8033C1.79018 12.3968 1 10.4891 1 8.5C1 6.51088 1.79018 4.60322 3.1967 3.1967C4.60322 1.79018 6.51088 1 8.5 1C10.4891 1 12.3968 1.79018 13.8033 3.1967C15.2098 4.60322 16 6.51088 16 8.5Z" stroke="#61646B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
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
                    v-for="(item, index) in application.data"
                    :key="item.id"
                    :class="index % 2 === 1 ? 'bg-gray-50 border-b border-gray-100' : 'border-b border-gray-200'"
                >
                    <td class="py-4 px-3 whitespace-nowrap">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" class="w-4 h-4" v-model="selectedApplications"
                                   :value="item.id" />
                            {{ item.application_id }}
                        </label>
                    </td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">{{ item.applicant_name }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.contact }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.gender }}</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px]">{{ item.designation ?? 'N/A' }}</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">{{ item.designation ?? 'N/A' }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  :class="[
                  'inline-block rounded-full px-3 py-1 text-[10px] font-medium select-none',
                  item.type === 'ON DUTY' ? 'bg-indigo-200 text-indigo-700' :
                  item.type === 'Medical' ? 'bg-blue-200 text-blue-600' :
                  item.type === 'NOT ON DUTY' ? 'bg-yellow-200 text-yellow-700' :
                  item.type === 'FLAM' ? 'bg-yellow-100 text-yellow-800' :
                  item.type === 'PRIVATE' ? 'bg-green-100 text-yellow-800' :
                  item.type === 'STUDY TOUR' ? 'bg-red-200 text-red-700' : ''
                ]"
              >
                {{ item.type }}
              </span>
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.noOfPersons }}</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">{{ item.location }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.start_date }}</td>
                    <td class="py-4 px-3 whitespace-nowrap">{{ item.end_date }}</td>
                    <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>

        <footer class="mt-6 flex items-center justify-end gap-4 text-xs text-gray-600 select-none">
            <span>Records per page:</span>
            <div class="relative inline-block text-left">
                <select
                    v-model="state.perPage"
                    @change="handleSearch"
                    class="appearance-none bg-white border border-gray-400 text-sm px-3 py-1 pr-6 rounded-lg font-semibold text-gray-700 cursor-pointer focus:outline-none"
                >
                    <option :value="10">10</option>
                    <option :value="25">25</option>
                    <option :value="50">50</option>
                    <option :value="100">100</option>
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                    <i class="fas fa-caret-down"></i>
                </div>
            </div>
            <nav class="flex items-center gap-3 font-semibold">
                <button
                    v-for="(link, index) in application.links"
                    :key="index"
                    :disabled="!link.url"
                    @click="navigateToPage(link.url)"
                    v-html="link.label"
                    :class="[
                    'min-w-[32px] h-8 px-2 border rounded-sm flex items-center justify-center cursor-pointer select-none',
                    link.active ? 'bg-gray-900 text-white border-gray-900' : 'hover:underline border-gray-300 text-gray-700',
                    !link.url ? 'opacity-50 cursor-not-allowed' : ''
                  ]"
                />
            </nav>
        </footer>
    </div>
    </div>



</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { ref, computed, reactive } from 'vue';
import {router} from "@inertiajs/vue3";

defineOptions({layout:AuthLayout})


const props = defineProps(['application','search', 'perPage','type']);


const search = ref('');

const state = reactive({
    search: props.search || '',
    perPage: props.perPage ? parseInt(props.perPage) : 10,
    type: props.type,
});

const handleSearch = () => {
    router.get(route('admin.application.incoming'), {
        search: state.search,
        type: state.type,   // Send the selected type filter
        perPage: state.perPage,
    }, {
        preserveState: true,
        replace: true,
    });
};

const clearSearch = () => {
    state.search = '';
    handleSearch();
};
const navigateToPage = (url) => {
    // Append the perPage parameter to pagination URLs
    if (url) {
        router.get(url, {
            search: state.search,
            perPage: state.perPage,
        });
    }
};


const selectedApplications = ref([]);

const allSelected = computed({
    get: () => props.application.data.length > 0 && selectedApplications.value.length === props.application.data.length,
    set: (value) => toggleSelectAll(value),
});

function toggleSelectAll(checked) {
    selectedApplications.value = checked
        ? props.application.data.map((application) => application.id)
        : [];
}
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
