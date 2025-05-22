<template>
    <Head title="Approved Application" />
    <div class="ml-6">
        <Status/>
    </div>


    <div class="ml-6 py-5 bg-white text-gray-900 font-sans ">
        <div id="app" class="mx-auto">
            <header class="mb-6">
                <h1 class="text-lg font-semibold flex items-center gap-1">
                    <span class="border-l-4 border-black pl-2">Forwarded</span>
                </h1>
            </header>

            <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <div class="flex items-center gap-6 border-r border-gray-300 pr-6">

                    <label class="flex items-center gap-2 cursor-pointer select-none text-sm text-gray-800">
                        Filter
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
                            <option value="MEDICAL">Medical</option>
                        </select>

                    </label>
                </div>


                <div @submit.prevent class="flex items-center border border-gray-400 rounded-xl px-4 py-2 w-full max-w-xs mr-4">
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

            <section v-if="application.data.length != 0" class="overflow-x-auto overflow-y-auto">
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
                            {{ item.application_id }}
                        </td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">{{ item.applicant_name }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">{{ item.contact }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">{{ item.gender }}</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">{{ item.designation ?? 'N/A' }}</td>
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">{{ item.department?.name ?? 'N/A' }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">
              <span
                  :class="[
                  'inline-block rounded-full px-3 py-1 text-[10px] font-medium select-none',
                  item.type === 'ON DUTY' ? 'bg-indigo-200 text-indigo-700' :
                  item.type === 'Medical' ? 'bg-blue-200 text-blue-600' :
                  item.type === 'NOT ON DUTY' ? 'bg-yellow-200 text-yellow-700' :
                  item.type === 'FLAM' ? 'bg-yellow-100 text-yellow-800' :
                  item.type === 'PRIVATE' ? 'bg-green-100 text-yellow-800' :
                  item.type === 'STUDY TOUR' ? 'bg-red-200 text-red-700' :
                   item.type === 'MEDICAL' ? 'bg-[#E0F3FF] text-[#0073FF]' : ''
                ]"
              >
                {{ item.type }}
              </span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap text-center">{{ item.number_of_persons }}</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">{{ item.house.name }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">{{ item.start_date }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">{{ item.end_date }}</td>
                        <td class="py-4 px-3 whitespace-nowrap text-center cursor-pointer select-none">
                            <div class="relative inline-block text-left">
                                <button
                                    @click="openDropdownId = openDropdownId === item.id ? null : item.id"
                                    class="rounded-full px-2 py-1 hover:bg-gray-200 focus:outline-none"
                                >
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v.01M12 12v.01M12 18v.01" />
                                    </svg>
                                </button>

                                <div
                                    v-if="openDropdownId === item.id"
                                    class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                                >
                                    <div class="py-1">
                                        <div class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 class="flex-shrink-0">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M8 5.5C7.33696 5.5 6.70107 5.76339 6.23223 6.23223C5.76339 6.70107 5.5 7.33696 5.5 8C5.5 8.66304 5.76339 9.29893 6.23223 9.76777C6.70107 10.2366 7.33696 10.5 8 10.5C8.66304 10.5 9.29893 10.2366 9.76777 9.76777C10.2366 9.29893 10.5 8.66304 10.5 8C10.5 7.33696 10.2366 6.70107 9.76777 6.23223C9.29893 5.76339 8.66304 5.5 8 5.5ZM6.5 8C6.5 7.60218 6.65804 7.22064 6.93934 6.93934C7.22064 6.65804 7.60218 6.5 8 6.5C8.39782 6.5 8.77936 6.65804 9.06066 6.93934C9.34196 7.22064 9.5 7.60218 9.5 8C9.5 8.39782 9.34196 8.77936 9.06066 9.06066C8.77936 9.34196 8.39782 9.5 8 9.5C7.60218 9.5 7.22064 9.34196 6.93934 9.06066C6.65804 8.77936 6.5 8.39782 6.5 8Z"
                                                      fill="black"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M8.00004 2.16699C4.99071 2.16699 2.96337 3.96966 1.78671 5.49833L1.76604 5.52566C1.49937 5.87166 1.25471 6.18966 1.08871 6.56566C0.910707 6.96899 0.833374 7.40833 0.833374 8.00033C0.833374 8.59233 0.910707 9.03166 1.08871 9.43499C1.25537 9.81099 1.50004 10.1297 1.76604 10.475L1.78737 10.5023C2.96337 12.031 4.99071 13.8337 8.00004 13.8337C11.0094 13.8337 13.0367 12.031 14.2134 10.5023L14.234 10.475C14.5007 10.1297 14.7454 9.81099 14.9114 9.43499C15.0894 9.03166 15.1667 8.59233 15.1667 8.00033C15.1667 7.40833 15.0894 6.96899 14.9114 6.56566C14.7447 6.18966 14.5 5.87166 14.234 5.52566L14.2127 5.49833C13.0367 3.96966 11.0094 2.16699 8.00004 2.16699ZM2.58004 6.10833C3.66537 4.69699 5.43337 3.16699 8.00004 3.16699C10.5667 3.16699 12.334 4.69699 13.42 6.10833C13.7134 6.48833 13.884 6.71499 13.9967 6.96966C14.102 7.20833 14.1667 7.49966 14.1667 8.00033C14.1667 8.50099 14.102 8.79233 13.9967 9.03099C13.884 9.28566 13.7127 9.51233 13.4207 9.89233C12.3334 11.3037 10.5667 12.8337 8.00004 12.8337C5.43337 12.8337 3.66604 11.3037 2.58004 9.89233C2.28671 9.51233 2.11604 9.28566 2.00337 9.03099C1.89804 8.79233 1.83337 8.50099 1.83337 8.00033C1.83337 7.49966 1.89804 7.20833 2.00337 6.96966C2.11604 6.71499 2.28804 6.48833 2.58004 6.10833Z"
                                                      fill="black"/>
                                            </svg>

                                            <a :href="route('admin.application.view', item)" class="text-sm text-gray-700">View Details</a>
                                        </div>
                                        <div class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.12471 4.14174L4.53337 12.6504C4.59781 13.0399 4.79843 13.3939 5.09951 13.6494C5.40058 13.9048 5.78255 14.045 6.17737 14.0451H8.40937M12.8747 4.14174L11.4667 12.6504C11.4023 13.0399 11.2016 13.3939 10.9006 13.6494C10.5995 13.9048 10.2175 14.045 9.82271 14.0451H7.59071M6.68137 7.41041V10.7764M9.31871 7.41041V10.7764M1.83337 4.14174H14.1667M9.85137 4.14174V2.95508C9.85137 2.68986 9.74602 2.43551 9.55848 2.24797C9.37094 2.06043 9.11659 1.95508 8.85137 1.95508H7.14871C6.88349 1.95508 6.62914 2.06043 6.4416 2.24797C6.25406 2.43551 6.14871 2.68986 6.14871 2.95508V4.14174H9.85137Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>


                                            <button
                                                @click="exportJobDetails(item.id); openDropdownId = null"
                                                class="text-sm text-gray-700"
                                            >
                                                Delete
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section v-else class="flex items-center justify-center">
                <div class="bg-white flex items-center justify-center">
                    <div class="text-center">

                        <svg  class="mx-auto mb-4" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_534_2321)">
                                <path d="M33.7969 0H8.20312C3.67266 0 0 3.67266 0 8.20312V33.7969C0 38.3273 3.67266 42 8.20312 42H33.7969C38.3273 42 42 38.3273 42 33.7969V8.20312C42 3.67266 38.3273 0 33.7969 0Z" fill="#FFDA24"/>
                                <path d="M42 28.875V33.7969C42 38.3275 38.3275 42 33.7969 42H8.20312C3.67254 42 0 38.3275 0 33.7969V28.875C0 33.4056 3.67254 37.0781 8.20312 37.0781H33.7969C38.3275 37.0781 42 33.4056 42 28.875Z" fill="#FFC024"/>
                                <path d="M24.7317 11.6428C25.0664 10.6937 26.2591 10.3869 27.0064 11.0604C27.6881 11.6748 28.5913 12.3138 29.6831 12.6985C30.775 13.0832 31.8791 13.1513 32.7954 13.1005C33.8003 13.0439 34.5369 14.0307 34.2022 14.9798C34.0488 15.4146 33.6944 15.7493 33.2507 15.8707C32.3754 16.1094 30.7626 16.3202 28.6667 15.5811C26.5708 14.8428 25.4462 13.6673 24.9138 12.9331C24.6439 12.5599 24.5775 12.0767 24.7309 11.6428H24.7317Z" fill="#473535"/>
                                <path d="M17.2627 11.6428C16.9281 10.6937 15.7353 10.3869 14.988 11.0604C14.3063 11.6748 13.4032 12.3138 12.3113 12.6985C11.2195 13.0832 10.1154 13.1513 9.19907 13.1005C8.19419 13.0439 7.45755 14.0307 7.79223 14.9798C7.94563 15.4146 8.30001 15.7493 8.7438 15.8707C9.61907 16.1094 11.2318 16.3202 13.3277 15.5811C15.4236 14.8428 16.5483 13.6673 17.0806 12.9331C17.3505 12.5599 17.417 12.0767 17.2636 11.6428H17.2627Z" fill="#473535"/>
                                <path d="M15.385 33.1312C15.4326 32.4462 17.092 30.0771 20.9967 30.0771C24.9014 30.0771 26.5609 32.4462 26.6085 33.1312C26.6511 33.7456 26.2295 34.004 25.7111 33.8982C25.1943 33.7923 23.9203 32.5963 20.9959 32.5963C18.0715 32.5963 16.7984 33.7923 16.2808 33.8982C15.764 34.004 15.3407 33.7456 15.3833 33.1312H15.385Z" fill="#473535"/>
                                <path d="M28.3705 27.3973C31.14 27.3973 33.3851 25.1522 33.3851 22.3827C33.3851 19.6133 31.14 17.3682 28.3705 17.3682C25.6011 17.3682 23.356 19.6133 23.356 22.3827C23.356 25.1522 25.6011 27.3973 28.3705 27.3973Z" fill="white"/>
                                <path d="M28.3704 25.065C30.169 25.065 31.6271 23.607 31.6271 21.8084C31.6271 20.0098 30.169 18.5518 28.3704 18.5518C26.5718 18.5518 25.1138 20.0098 25.1138 21.8084C25.1138 23.607 26.5718 25.065 28.3704 25.065Z" fill="#473535"/>
                                <path d="M29.9471 21.9108C30.8749 21.9108 31.6271 21.1586 31.6271 20.2308C31.6271 19.3029 30.8749 18.5508 29.9471 18.5508C29.0193 18.5508 28.2671 19.3029 28.2671 20.2308C28.2671 21.1586 29.0193 21.9108 29.9471 21.9108Z" fill="white"/>
                                <path d="M13.6296 27.3973C16.399 27.3973 18.6441 25.1522 18.6441 22.3827C18.6441 19.6133 16.399 17.3682 13.6296 17.3682C10.8601 17.3682 8.61499 19.6133 8.61499 22.3827C8.61499 25.1522 10.8601 27.3973 13.6296 27.3973Z" fill="white"/>
                                <path d="M13.6294 25.065C15.428 25.065 16.8861 23.607 16.8861 21.8084C16.8861 20.0098 15.428 18.5518 13.6294 18.5518C11.8309 18.5518 10.3728 20.0098 10.3728 21.8084C10.3728 23.607 11.8309 25.065 13.6294 25.065Z" fill="#473535"/>
                                <path d="M15.2061 21.9108C16.134 21.9108 16.8861 21.1586 16.8861 20.2308C16.8861 19.3029 16.134 18.5508 15.2061 18.5508C14.2783 18.5508 13.5261 19.3029 13.5261 20.2308C13.5261 21.1586 14.2783 21.9108 15.2061 21.9108Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_534_2321">
                                    <rect width="42" height="42" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>

                        <p class="text-gray-400 font-normal text-base leading-6 max-w-xs mx-auto">
                            Sorry to inform you that record is not found.
                        </p>
                    </div>
                </div>
            </section>

            <footer v-if="application.data.length != 0" class="mt-6 flex items-center justify-end gap-4 text-xs text-gray-600 select-none">
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
import {Head, router} from "@inertiajs/vue3";
import Status from "@/Components/Statistics/Status.vue";

defineOptions({layout:AuthLayout})


const props = defineProps(['application','search', 'perPage','type']);


const search = ref('');

const state = reactive({
    search: props.search || '',
    perPage: props.perPage ? parseInt(props.perPage) : 10,
    type: props.type,
});

const handleSearch = () => {
    router.get(route('admin.application.index_approved'), {
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

const openDropdownId = ref(null)


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
