<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { reactive, ref, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";

defineOptions({ layout: AuthLayout });

const props = defineProps(['houses']);

const application = ref([]); // array of results
const pagination = ref([]);  // pagination links

const state = reactive({
    perPage: 10,
    search: '',
    filters: {
        status: '',
        category: '',
        start_date: '',
        end_date: '',
        mizoram_house: '',
        gender: ''
    }
});

const clearSearch = () => {
    state.search = '';
    fetchData(); // fetch default data after clearing search
};

const clearFilter = () => {
    state.search = '';
    state.filters = {
        status: '',
        category: '',
        start_date: '',
        end_date: '',
        mizoram_house: '',
        gender: ''
    };
    application.value = []; // clear the current report data
}

const fetchData = (url = route('admin.report.json-index')) => {
    axios.get(url, {
        params: {
            search: state.search,
            perPage: state.perPage,
            ...state.filters,
        }
    }).then(res => {
        const { list } = res.data;
        application.value = list.data;       // paginated data array
        pagination.value = list.links;       // pagination links array
    }).catch(err => {
        console.error(err?.response?.data?.message || err);
    });
};

const handleSearch = () => {
    // Called on search input enter or button click
    fetchData();
};

const navigateToPage = (url) => {
    if (url) {
        fetchData(url);
    }
};


const exportReport = () => {
    // Make a GET request to the URL with responseType as 'blob'
    axios.get(route('admin.report.export'), {
        params: {
            ...state.filters,
        },
        responseType: 'blob' })
        .then((res) => {
            // Create an object URL from the response data and trigger a download
            const fileUrl = window.URL.createObjectURL(new Blob([res.data]));
            const link = document.createElement('a');
            link.href = fileUrl;
            link.setAttribute('download', Date.now() + '.xlsx'); // Set a dynamic file name
            link.click();
        })
        .catch((err) => {
            console.log(err.response?.data?.message)
            // Show an error notification if something goes wrong
        })
        .finally(() => {

        });
};

const downloadReport = () => {
    // Make a GET request to the URL with responseType as 'blob'
    axios.get(route('admin.report.download'), {
        params: {
            ...state.filters,
        },
        responseType: 'blob' })
        .then((res) => {
            const blob = new Blob([res.data], { type: "application/pdf" });
            const url = window.URL.createObjectURL(blob);
            let a = document.createElement("a");
            a.href = url;
            a.target = "_blank";
            a.click();
        })
        .catch((err) => {
            console.log(err.response?.data?.message)
            // Show an error notification if something goes wrong
        })
        .finally(() => {

        });
};



</script>

<template>
    <Head title="Report" />
    <div class="bg-[#f7f7f7] p-6 ml-5">
        <div class="max-w-full bg-[#f7f7f7] rounded-md p-2">
            <h2 class="heading-bar font-semibold text-base mb-6 inline-block">Report</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6 max-w-full ml-12 mr-12">
                <div class="flex flex-col">
                    <label for="status" class="text-sm font-semibold mb-1 text-black">Status</label>
                    <select
                        v-model="state.filters.status"
                        id="status"
                        class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                        aria-label="Status"
                    >
                        <option value="" class="text-gray-400">All</option>
                        <option value="Pending" class="text-gray-400">Incoming</option>
                        <option value="Forwarded" class="text-gray-400">Forwarded</option>
                        <option value="Approved" class="text-gray-400">Approved</option>
                        <option value="Rejected" class="text-gray-400">Rejected</option>

                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="category" class="text-sm font-semibold mb-1 text-black">Category</label>
                    <select
                        v-model="state.filters.category"
                        id="category"
                        class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                        aria-label="Category"
                    >
                        <option value=""  class="text-gray-400">All</option>
                        <option value="FLAM"  class="text-gray-400">FLAM</option>
                        <option  value="ON DUTY"  class="text-gray-400">ON DUTY</option>
                        <option  value="NOT ON DUTY"  class="text-gray-400">NOT ON DUTY</option>
                        <option value="MEDICAL"  class="text-gray-400">MEDICAL</option>
                        <option  value="PRIVATE"  class="text-gray-400">PRIVATE</option>
                        <option  value="STUDY TOUR"  class="text-gray-400">STUDY TOUR</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="start-date" class="text-sm font-semibold mb-1 text-black">Start Date (From)</label>
                    <div class="relative">
                        <input
                            v-model="state.filters.start_date"
                            type="date"
                            id="start-date"
                            placeholder="Select Date"
                            class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 w-full cursor-pointer"
                            aria-label="Start Date From"
                        />
                        <i class="far fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                        <button
                            v-if="state.filters.start_date"
                            @click="state.filters.start_date = ''"
                            type="button"
                            class="absolute right-8 mr-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black"
                        >
                            ✕
                        </button>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="end-date" class="text-sm font-semibold mb-1 text-black">End Date (Till)</label>
                    <div class="relative">
                        <input
                            v-model="state.filters.end_date"
                            type="date"
                            id="end-date"
                            placeholder="Select Date"
                            class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 w-full cursor-pointer"
                            aria-label="End Date Till"
                        />
                        <i class="far fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                        <button
                            v-if="state.filters.end_date"
                            @click="state.filters.end_date = ''"
                            type="button"
                            class="absolute right-8 mr-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black"
                        >
                            ✕
                        </button>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="mizoram-house" class="text-sm font-semibold mb-1 text-black">Mizoram House</label>
                    <select
                        v-model="state.filters.mizoram_house"
                        id="mizoram-house"
                        class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                        aria-label="Mizoram House"
                    >
                        <option disabled selected>Select House</option>
                        <option value=""  class="text-gray-400">ALL</option>
                        <option v-for="loc in houses" :key="loc.id" :value="loc.id" class="text-gray-400">{{ loc.name }}</option>

                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="gender" class="text-sm font-semibold mb-1 text-black">Gender</label>
                    <select
                        v-model="state.filters.gender"
                        id="gender"
                        class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                        aria-label="Gender"
                    >
                        <option value=""  class="text-gray-400">All</option>
                        <option value="Male"  class="text-gray-400">Male</option>
                        <option value="Female"  class="text-gray-400">Female</option>
                        <option value="Other"  class="text-gray-400">Other</option>
                    </select>
                </div>



                <div class="lg:col-span-2 flex items-end justify-start lg:justify-end">
                    <button
                        @click="fetchData()"
                        type="submit"
                        class="bg-black text-white text-sm font-normal rounded-md py-3 px-8 w-full max-w-[220px]"
                    >
                        Generate Report
                    </button>
                </div>


            </div>
        </div>
    </div>
    <div class="ml-6 py-5 bg-white text-gray-900 font-sans ">
        <div id="app" class="mx-auto">
            <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-lg font-semibold flex items-center gap-2">
                    <span class="border-l-4 border-black pl-2">Generated Report</span>
                </h1>
                <nav class="flex gap-6 mt-4 sm:mt-0 text-gray-900 text-sm font-normal">

                    <button
                        v-if="application.length > 0"
                        type="button"
                        @click="exportReport"
                        class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                    >
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.505 3.97906e-05C7.927 -0.00307257 8.349 0.176407 8.671 0.535366L10.621 2.66214C10.834 2.89868 10.834 3.28462 10.621 3.52116C10.5723 3.57702 10.5128 3.62167 10.4464 3.65223C10.38 3.68279 10.3081 3.69858 10.2355 3.69858C10.1629 3.69858 10.091 3.68279 10.0246 3.65223C9.95824 3.62167 9.89875 3.57702 9.85 3.52116L8 1.50538V9.79775C8 10.1162 7.776 10.3746 7.5 10.3746C7.224 10.3746 7 10.1162 7 9.79775V1.53962L5.18 3.52116C5.13126 3.57685 5.07183 3.62136 5.00553 3.65182C4.93922 3.68227 4.86751 3.698 4.795 3.698C4.72249 3.698 4.65078 3.68227 4.58448 3.65182C4.51817 3.62136 4.45874 3.57685 4.41 3.52116C4.30705 3.4034 4.25003 3.25011 4.25003 3.09113C4.25003 2.93215 4.30705 2.77887 4.41 2.66111L6.36 0.534328C6.50496 0.369455 6.68084 0.237025 6.87686 0.145153C7.07289 0.0532806 7.28493 0.00390101 7.5 3.97906e-05H7.505ZM3.18 6.22476C2.707 6.22476 2.3 6.52977 2.208 6.95409L1.019 12.4007C1.00771 12.4595 1.00135 12.5192 1 12.5792C1 13.0802 1.444 13.4869 1.99 13.4869H13.01C13.0753 13.4869 13.14 13.4811 13.204 13.4693C13.741 13.3707 14.089 12.8925 13.982 12.4007L12.792 6.95409C12.7 6.52977 12.293 6.22476 11.822 6.22476H3.18ZM5 5.18731V6.22476H10V5.18731H11.825C12.771 5.18731 13.585 5.816 13.771 6.6885L14.961 12.2907C15.176 13.3023 14.479 14.2858 13.405 14.4881C13.2765 14.5134 13.1458 14.5255 13.015 14.5244H1.985C0.888 14.5244 0 13.6882 0 12.657C0 12.5332 0.013 12.4111 0.039 12.2907L1.229 6.6885C1.414 5.816 2.229 5.18731 3.174 5.18731H5Z" fill="black"/>
                        </svg>

                        Export
                    </button>
                    <button
                        v-if="application.length > 0"
                        type="button"
                        @click="downloadReport"
                        class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                    >
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15.577L8.461 12.039L9.169 11.319L11.5 13.65V5H12.5V13.65L14.83 11.32L15.539 12.039L12 15.577ZM6.616 19C6.15533 19 5.771 18.846 5.463 18.538C5.155 18.23 5.00067 17.8453 5 17.384V14.961H6V17.384C6 17.538 6.064 17.6793 6.192 17.808C6.32 17.9367 6.461 18.0007 6.615 18H17.385C17.5383 18 17.6793 17.936 17.808 17.808C17.9367 17.68 18.0007 17.5387 18 17.384V14.961H19V17.384C19 17.8447 18.846 18.229 18.538 18.537C18.23 18.845 17.8453 18.9993 17.384 19H6.616Z" fill="black"/>
                        </svg>

                        Download
                    </button>
                    <button
                        v-if="application.length > 0"
                        type="button"
                        @click="clearFilter"
                        class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                    >
                        <!--                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                        <!--                            <path d="M4.78594 15.6133C4.36361 15.6133 4.00237 15.4629 3.70224 15.1622C3.40211 14.8614 3.25173 14.5008 3.2511 14.0804V11.8142H1.5339C1.11219 11.8142 0.751276 11.6638 0.451146 11.3631C0.151015 11.0623 0.000633187 10.7014 0 10.2803V6.69963C0 6.16142 0.182674 5.71059 0.548023 5.34714C0.913372 4.98243 1.36388 4.80007 1.89956 4.80007H14.1004C14.6386 4.80007 15.0898 4.98243 15.4539 5.34714C15.818 5.71186 16 6.16269 16 6.69963V10.2803C16 10.702 15.8499 11.0629 15.5498 11.3631C15.2497 11.6632 14.8884 11.8136 14.4661 11.8142H12.7489V14.0794C12.7489 14.5011 12.5985 14.862 12.2978 15.1622C11.997 15.4623 11.6361 15.6127 11.215 15.6133H4.78594ZM1.5339 10.8644H3.2511C3.27579 10.4636 3.43472 10.1198 3.72789 9.83296C4.02105 9.54676 4.37374 9.40366 4.78594 9.40366H11.215C11.6266 9.40366 11.9789 9.54707 12.2721 9.83391C12.5653 10.1201 12.7242 10.4636 12.7489 10.8644H14.4661C14.6364 10.8644 14.7764 10.8096 14.8859 10.7001C14.9954 10.5906 15.0502 10.4506 15.0502 10.2803V6.69963C15.0502 6.43116 14.9594 6.20575 14.7776 6.02339C14.5959 5.84103 14.3702 5.74985 14.1004 5.74985H1.89956C1.63046 5.74985 1.40504 5.84103 1.22332 6.02339C1.04159 6.20575 0.950414 6.43148 0.949781 6.70058V10.2803C0.949781 10.4506 1.00455 10.5906 1.11409 10.7001C1.22363 10.8096 1.36357 10.8644 1.5339 10.8644ZM11.7991 4.80102V2.53485C11.7991 2.36388 11.7444 2.22395 11.6348 2.11504C11.5253 2.0055 11.3853 1.95073 11.215 1.95073H4.78499C4.61467 1.95073 4.47473 2.0055 4.36519 2.11504C4.25565 2.22458 4.20088 2.36452 4.20088 2.53485V4.80007H3.2511V2.53485C3.2511 2.11314 3.40148 1.75191 3.70224 1.45115C4.00237 1.15038 4.36329 1 4.78499 1H11.215C11.6367 1 11.9976 1.15038 12.2978 1.45115C12.5985 1.75191 12.7489 2.11283 12.7489 2.5339V4.80007L11.7991 4.80102ZM13.334 8.12525C13.6031 8.12525 13.8285 8.03407 14.0102 7.85172C14.1919 7.66936 14.2831 7.44394 14.2837 7.17547C14.2844 6.907 14.1932 6.68127 14.0102 6.49828C13.8272 6.31529 13.6018 6.22411 13.334 6.22474C13.0661 6.22537 12.8404 6.31655 12.6568 6.49828C12.4731 6.68 12.3823 6.90573 12.3842 7.17547C12.3861 7.44521 12.4769 7.67062 12.6568 7.85172C12.8366 8.03281 13.0623 8.12399 13.334 8.12525ZM11.7991 14.0785V10.9376C11.7991 10.7666 11.7444 10.6263 11.6348 10.5168C11.5253 10.4073 11.3853 10.3525 11.215 10.3525H4.78499C4.61467 10.3525 4.47473 10.4073 4.36519 10.5168C4.25565 10.627 4.20088 10.7672 4.20088 10.9376V14.0794C4.20088 14.2498 4.25565 14.3897 4.36519 14.4992C4.47473 14.6088 4.61498 14.6635 4.78594 14.6635H11.215C11.3853 14.6635 11.5253 14.6088 11.6348 14.4992C11.7444 14.3897 11.7991 14.2494 11.7991 14.0785ZM1.5339 5.7508H0.949781H15.0502H1.5339Z" fill="black"/>-->
                        <!--                        </svg>-->

                        Clear
                    </button>
                    <div class="flex items-center border border-gray-400 rounded-xl px-4 py-2 w-full max-w-xs mr-4">
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
                </nav>
            </header>
            <section v-if="application.length > 0" class="overflow-x-auto overflow-y-auto">
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
                    </tr>
                    </thead>
                    <tbody class="text-xs text-gray-900">
                    <tr
                        v-for="(item, index) in application"
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
                        <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                            {{
                                item.type === 'STUDY TOUR'
                                    ? item.study_tour_details?.institution || 'N/A'
                                    : item.department?.name || 'N/A'
                            }}
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap">
              <span
                  :class="[
                  'inline-block rounded-full px-3 py-1 text-[10px] font-medium select-none',
                  item.type === 'ON DUTY' ? 'bg-indigo-200 text-indigo-700' :
                  item.type === 'MEDICAL' ? 'bg-blue-200 text-blue-600' :
                  item.type === 'NOT ON DUTY' ? 'bg-yellow-200 text-yellow-700' :
                  item.type === 'FLAM' ? 'bg-yellow-100 text-yellow-800' :
                  item.type === 'PRIVATE' ? 'bg-green-100 text-yellow-800' :
                  item.type === 'STUDY TOUR' ? 'bg-red-200 text-red-700' : ''
                ]"
              >
                {{ item.type }}
              </span>
                        </td>
                        <td class="py-4 px-3 whitespace-nowrap text-center">{{ item.number_of_persons }}</td>
                        <td class="py-4 px-3 whitespace-nowrap max-w-[100px]">{{ item.house.name }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">{{ item.start_date }}</td>
                        <td class="py-4 px-3 whitespace-nowrap">{{ item.end_date }}</td>

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

<!--            {{application}}-->



            <footer v-if="application.length > 0" class="mt-6 flex items-center justify-end gap-4 text-xs text-gray-600 select-none">
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
                        v-for="(link, index) in pagination"
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

<style scoped>

</style>


