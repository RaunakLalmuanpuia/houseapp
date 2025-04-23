<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";

defineOptions({layout:AuthLayout})

function toggleMenu(id) {
    const menu = document.getElementById(id);
    if (!menu) return;
    const isHidden = menu.classList.contains("hidden");
    // Close all menus
    document.querySelectorAll("[id^='menu-']").forEach((el) => {
        el.classList.add("hidden");
    });
    if (isHidden) {
        menu.classList.remove("hidden");
    }
}
// Close menus on click outside
document.addEventListener("click", (e) => {
    if (!e.target.closest("[aria-haspopup='true']")) {
        document.querySelectorAll("[id^='menu-']").forEach((el) => {
            el.classList.add("hidden");
        });
    }
});
</script>

<template>
    <div class="bg-[#f7f7f7] p-6 ml-5">
    <div class="max-w-full bg-[#f7f7f7] rounded-md p-2">
        <h2 class="heading-bar font-semibold text-base mb-6 inline-block">Report</h2>
        <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6 max-w-full ml-12 mr-12">
            <div class="flex flex-col">
                <label for="status" class="text-sm font-semibold mb-1 text-black">Status</label>
                <select
                    id="status"
                    class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                    aria-label="Status"
                >
                    <option selected disabled class="text-gray-400">Approved</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="category" class="text-sm font-semibold mb-1 text-black">Category</label>
                <select
                    id="category"
                    class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                    aria-label="Category"
                >
                    <option selected disabled class="text-gray-400">All</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="start-date" class="text-sm font-semibold mb-1 text-black">Start Date (From)</label>
                <div class="relative">
                    <input
                        type="date"
                        id="start-date"
                        placeholder="Select Date"
                        class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 w-full cursor-pointer"
                        aria-label="Start Date From"
                    />
                    <i class="far fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="end-date" class="text-sm font-semibold mb-1 text-black">End Date (Till)</label>
                <div class="relative">
                    <input
                        type="date"
                        id="end-date"
                        placeholder="Select Date"
                        class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 w-full cursor-pointer"
                        aria-label="End Date Till"
                    />
                    <i class="far fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="mizoram-house" class="text-sm font-semibold mb-1 text-black">Mizoram House</label>
                <select
                    id="mizoram-house"
                    class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                    aria-label="Mizoram House"
                >
                    <option selected disabled class="text-gray-400">All</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="gender" class="text-sm font-semibold mb-1 text-black">Gender</label>
                <select
                    id="gender"
                    class="text-sm text-gray-400 placeholder-gray-400 border border-gray-300 rounded-md py-2 px-3 cursor-pointer"
                    aria-label="Gender"
                >
                    <option selected disabled class="text-gray-400">Both (male & female)</option>
                </select>
            </div>

            <div class="lg:col-span-2 flex items-end justify-start lg:justify-end">
                <button
                    type="submit"
                    class="bg-black text-white text-sm font-normal rounded-md py-3 px-8 w-full max-w-[220px]"
                >
                    Generate Report
                </button>
            </div>
        </form>
    </div>
    </div>

    <div class="bg-white text-gray-900">
    <div class="max-w-[1200px] mx-auto px-6 py-8">
        <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-lg font-semibold flex items-center gap-2">
                <span class="border-l-4 border-black pl-2">Generated Report</span>
            </h1>
            <nav class="flex gap-6 mt-4 sm:mt-0 text-gray-900 text-sm font-normal">
                <button
                    type="button"
                    class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                >
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.78594 15.6133C4.36361 15.6133 4.00237 15.4629 3.70224 15.1622C3.40211 14.8614 3.25173 14.5008 3.2511 14.0804V11.8142H1.5339C1.11219 11.8142 0.751276 11.6638 0.451146 11.3631C0.151015 11.0623 0.000633187 10.7014 0 10.2803V6.69963C0 6.16142 0.182674 5.71059 0.548023 5.34714C0.913372 4.98243 1.36388 4.80007 1.89956 4.80007H14.1004C14.6386 4.80007 15.0898 4.98243 15.4539 5.34714C15.818 5.71186 16 6.16269 16 6.69963V10.2803C16 10.702 15.8499 11.0629 15.5498 11.3631C15.2497 11.6632 14.8884 11.8136 14.4661 11.8142H12.7489V14.0794C12.7489 14.5011 12.5985 14.862 12.2978 15.1622C11.997 15.4623 11.6361 15.6127 11.215 15.6133H4.78594ZM1.5339 10.8644H3.2511C3.27579 10.4636 3.43472 10.1198 3.72789 9.83296C4.02105 9.54676 4.37374 9.40366 4.78594 9.40366H11.215C11.6266 9.40366 11.9789 9.54707 12.2721 9.83391C12.5653 10.1201 12.7242 10.4636 12.7489 10.8644H14.4661C14.6364 10.8644 14.7764 10.8096 14.8859 10.7001C14.9954 10.5906 15.0502 10.4506 15.0502 10.2803V6.69963C15.0502 6.43116 14.9594 6.20575 14.7776 6.02339C14.5959 5.84103 14.3702 5.74985 14.1004 5.74985H1.89956C1.63046 5.74985 1.40504 5.84103 1.22332 6.02339C1.04159 6.20575 0.950414 6.43148 0.949781 6.70058V10.2803C0.949781 10.4506 1.00455 10.5906 1.11409 10.7001C1.22363 10.8096 1.36357 10.8644 1.5339 10.8644ZM11.7991 4.80102V2.53485C11.7991 2.36388 11.7444 2.22395 11.6348 2.11504C11.5253 2.0055 11.3853 1.95073 11.215 1.95073H4.78499C4.61467 1.95073 4.47473 2.0055 4.36519 2.11504C4.25565 2.22458 4.20088 2.36452 4.20088 2.53485V4.80007H3.2511V2.53485C3.2511 2.11314 3.40148 1.75191 3.70224 1.45115C4.00237 1.15038 4.36329 1 4.78499 1H11.215C11.6367 1 11.9976 1.15038 12.2978 1.45115C12.5985 1.75191 12.7489 2.11283 12.7489 2.5339V4.80007L11.7991 4.80102ZM13.334 8.12525C13.6031 8.12525 13.8285 8.03407 14.0102 7.85172C14.1919 7.66936 14.2831 7.44394 14.2837 7.17547C14.2844 6.907 14.1932 6.68127 14.0102 6.49828C13.8272 6.31529 13.6018 6.22411 13.334 6.22474C13.0661 6.22537 12.8404 6.31655 12.6568 6.49828C12.4731 6.68 12.3823 6.90573 12.3842 7.17547C12.3861 7.44521 12.4769 7.67062 12.6568 7.85172C12.8366 8.03281 13.0623 8.12399 13.334 8.12525ZM11.7991 14.0785V10.9376C11.7991 10.7666 11.7444 10.6263 11.6348 10.5168C11.5253 10.4073 11.3853 10.3525 11.215 10.3525H4.78499C4.61467 10.3525 4.47473 10.4073 4.36519 10.5168C4.25565 10.627 4.20088 10.7672 4.20088 10.9376V14.0794C4.20088 14.2498 4.25565 14.3897 4.36519 14.4992C4.47473 14.6088 4.61498 14.6635 4.78594 14.6635H11.215C11.3853 14.6635 11.5253 14.6088 11.6348 14.4992C11.7444 14.3897 11.7991 14.2494 11.7991 14.0785ZM1.5339 5.7508H0.949781H15.0502H1.5339Z" fill="black"/>
                    </svg>

                    Print
                </button>
                <button
                    type="button"
                    class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                >
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.505 3.97906e-05C7.927 -0.00307257 8.349 0.176407 8.671 0.535366L10.621 2.66214C10.834 2.89868 10.834 3.28462 10.621 3.52116C10.5723 3.57702 10.5128 3.62167 10.4464 3.65223C10.38 3.68279 10.3081 3.69858 10.2355 3.69858C10.1629 3.69858 10.091 3.68279 10.0246 3.65223C9.95824 3.62167 9.89875 3.57702 9.85 3.52116L8 1.50538V9.79775C8 10.1162 7.776 10.3746 7.5 10.3746C7.224 10.3746 7 10.1162 7 9.79775V1.53962L5.18 3.52116C5.13126 3.57685 5.07183 3.62136 5.00553 3.65182C4.93922 3.68227 4.86751 3.698 4.795 3.698C4.72249 3.698 4.65078 3.68227 4.58448 3.65182C4.51817 3.62136 4.45874 3.57685 4.41 3.52116C4.30705 3.4034 4.25003 3.25011 4.25003 3.09113C4.25003 2.93215 4.30705 2.77887 4.41 2.66111L6.36 0.534328C6.50496 0.369455 6.68084 0.237025 6.87686 0.145153C7.07289 0.0532806 7.28493 0.00390101 7.5 3.97906e-05H7.505ZM3.18 6.22476C2.707 6.22476 2.3 6.52977 2.208 6.95409L1.019 12.4007C1.00771 12.4595 1.00135 12.5192 1 12.5792C1 13.0802 1.444 13.4869 1.99 13.4869H13.01C13.0753 13.4869 13.14 13.4811 13.204 13.4693C13.741 13.3707 14.089 12.8925 13.982 12.4007L12.792 6.95409C12.7 6.52977 12.293 6.22476 11.822 6.22476H3.18ZM5 5.18731V6.22476H10V5.18731H11.825C12.771 5.18731 13.585 5.816 13.771 6.6885L14.961 12.2907C15.176 13.3023 14.479 14.2858 13.405 14.4881C13.2765 14.5134 13.1458 14.5255 13.015 14.5244H1.985C0.888 14.5244 0 13.6882 0 12.657C0 12.5332 0.013 12.4111 0.039 12.2907L1.229 6.6885C1.414 5.816 2.229 5.18731 3.174 5.18731H5Z" fill="black"/>
                    </svg>

                    Export
                </button>
                <button
                    type="button"
                    class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 15.577L8.461 12.039L9.169 11.319L11.5 13.65V5H12.5V13.65L14.83 11.32L15.539 12.039L12 15.577ZM6.616 19C6.15533 19 5.771 18.846 5.463 18.538C5.155 18.23 5.00067 17.8453 5 17.384V14.961H6V17.384C6 17.538 6.064 17.6793 6.192 17.808C6.32 17.9367 6.461 18.0007 6.615 18H17.385C17.5383 18 17.6793 17.936 17.808 17.808C17.9367 17.68 18.0007 17.5387 18 17.384V14.961H19V17.384C19 17.8447 18.846 18.229 18.538 18.537C18.23 18.845 17.8453 18.9993 17.384 19H6.616Z" fill="black"/>
                    </svg>

                    Download
                </button>
                <div @submit.prevent class="flex items-center border border-gray-400 rounded-xl px-4 py-2 w-full max-w-xs mr-4">
                    <input

                        type="search"
                        placeholder="Search"

                        class="flex-grow text-sm text-gray-700 placeholder-gray-500 focus:outline-none border-none"
                        aria-label="Search"
                    />
                    <button class="ml-1 text-gray-500 hover:text-red-500" title="Clear Search">
                        ✕
                    </button>
                    <button  type="submit" class="ml-2 text-gray-600">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.893 13.92L16.973 17M16 8.5C16 10.4891 15.2098 12.3968 13.8033 13.8033C12.3968 15.2098 10.4891 16 8.5 16C6.51088 16 4.60322 15.2098 3.1967 13.8033C1.79018 12.3968 1 10.4891 1 8.5C1 6.51088 1.79018 4.60322 3.1967 3.1967C4.60322 1.79018 6.51088 1 8.5 1C10.4891 1 12.3968 1.79018 13.8033 3.1967C15.2098 4.60322 16 6.51088 16 8.5Z" stroke="#61646B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </nav>
        </header>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full border-collapse table-auto">
                <thead class="bg-gray-800 text-white text-xs font-semibold">
                <tr>
                    <th class="py-3 px-3 text-left whitespace-nowrap">SLNO</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">APPLICANT NAME</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">CONTACT</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">GENDER</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">DESIGNATION</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">DEPARTMENT</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">REASON</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">NO. OF PERSONS</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">HOUSE</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">ARRIVAL</th>
                    <th class="py-3 px-3 text-left whitespace-nowrap">DEPARTURE</th>
                    <th class="py-3 px-3 text-center whitespace-nowrap"></th>
                </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-900">
                <tr class="border-b border-gray-100">
                    <td class="py-4 px-3 whitespace-nowrap">6982</td>
                    <td class="py-4 px-3 whitespace-nowrap">Zothanzuala Chhakchhuak</td>
                    <td class="py-4 px-3 whitespace-nowrap">98765 12345</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Under Secretary</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        General Administrative Department
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#E3E0FF] text-[#5B55D9] rounded-full px-3 py-1 text-xs font-semibold"
              >On Duty</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">02</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Vasant Vihar</td>
                    <td class="py-4 px-3 whitespace-nowrap"></td>
                    <td class="py-4 px-3 whitespace-nowrap"></td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-1')"
                        >
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v.01M12 12v.01M12 18v.01" />
                            </svg>
                        </button>
                        <div
                            id="menu-1"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-1"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-50 bg-gray-50">
                    <td class="py-4 px-3 whitespace-nowrap">6981</td>
                    <td class="py-4 px-3 whitespace-nowrap">Lalhmingsangi Sailo</td>
                    <td class="py-4 px-3 whitespace-nowrap">98123 18765</td>
                    <td class="py-4 px-3 whitespace-nowrap">Female</td>
                    <td class="py-4 px-3 whitespace-nowrap">Assistant</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        Agriculture Department
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#D9EEFF] text-[#3B9BFF] rounded-full px-3 py-1 text-xs font-semibold"
              >Medical</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Mumbai</td>
                    <td class="py-4 px-3 whitespace-nowrap"></td>
                    <td class="py-4 px-3 whitespace-nowrap"></td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-2"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-2')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-2"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-2"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <td class="py-4 px-3 whitespace-nowrap">6980</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        Andy Ngurthansangzuala Sailo
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">88976 12345</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Addt. Director</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">I&PR Department</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#FFE7C2] text-[#FFB84D] rounded-full px-3 py-1 text-xs font-semibold"
              >Not On Duty</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Vasant Vihar</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-3"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-3')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-3"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-3"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-50 bg-gray-50">
                    <td class="py-4 px-3 whitespace-nowrap">6979</td>
                    <td class="py-4 px-3 whitespace-nowrap">Lalthanngura Hmar</td>
                    <td class="py-4 px-3 whitespace-nowrap">709873 18765</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Ex. Minister</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">NIL</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#FFE7C2] text-[#FFB84D] rounded-full px-3 py-1 text-xs font-semibold"
              >FLAM</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">New Town</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-4"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-4')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-4"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-4"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <td class="py-4 px-3 whitespace-nowrap">6978</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        Andy Ngurthansangzuala Sailo
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">87653 45632</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Addt. Director</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">I&PR Department</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#E3E0FF] text-[#5B55D9] rounded-full px-3 py-1 text-xs font-semibold"
              >On Duty</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Vasant Vihar</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-5"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-5')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-5"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-5"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-50 bg-gray-50">
                    <td class="py-4 px-3 whitespace-nowrap">6977</td>
                    <td class="py-4 px-3 whitespace-nowrap">Lalhmingsangi Sailo</td>
                    <td class="py-4 px-3 whitespace-nowrap">89346 34639</td>
                    <td class="py-4 px-3 whitespace-nowrap">Female</td>
                    <td class="py-4 px-3 whitespace-nowrap">Assistant</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        Agriculture Department
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#D9EEFF] text-[#3B9BFF] rounded-full px-3 py-1 text-xs font-semibold"
              >Medical</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Mumbai</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-6"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-6')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-6"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-6"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <td class="py-4 px-3 whitespace-nowrap">6976</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        Andy Ngurthansangzuala Sailo
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">98436 56395</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Addt. Director</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">I&PR Department</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#FFE7C2] text-[#FFB84D] rounded-full px-3 py-1 text-xs font-semibold"
              >Not On Duty</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Vasant Vihar</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-7"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-7')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-7"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-7"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-50 bg-gray-50">
                    <td class="py-4 px-3 whitespace-nowrap">6975</td>
                    <td class="py-4 px-3 whitespace-nowrap">Lalthanngura Hmar</td>
                    <td class="py-4 px-3 whitespace-nowrap">89545 76543</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Ex. Minister</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">NIL</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#FFE7C2] text-[#FFB84D] rounded-full px-3 py-1 text-xs font-semibold"
              >FLAM</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">01</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Salt Lake</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-8"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-8')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-8"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-8"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <td class="py-4 px-3 whitespace-nowrap">6974</td>
                    <td class="py-4 px-3 whitespace-normal max-w-[140px]">
                        Andy Ngurthansangzuala Sailo
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">94585 34596</td>
                    <td class="py-4 px-3 whitespace-nowrap">Male</td>
                    <td class="py-4 px-3 whitespace-nowrap">Asst. Professor</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[140px]">Govt. HBC</td>
                    <td class="py-4 px-3 whitespace-nowrap">
              <span
                  class="inline-block bg-[#FFD9D9] text-[#FF6B6B] rounded-full px-3 py-1 text-xs font-semibold"
              >Study Tour</span
              >
                    </td>
                    <td class="py-4 px-3 whitespace-nowrap">40</td>
                    <td class="py-4 px-3 whitespace-nowrap max-w-[120px] truncate">Bengaluru</td>
                    <td class="py-4 px-3 whitespace-nowrap">1-3-2025</td>
                    <td class="py-4 px-3 whitespace-nowrap">5-3-2025</td>
                    <td class="py-4 px-3 text-center whitespace-nowrap relative">
                        <button
                            aria-label="More options"
                            class="text-gray-600 hover:text-gray-900 focus:outline-none"
                            id="menu-btn-9"
                            aria-haspopup="true"
                            aria-expanded="false"
                            onclick="toggleMenu('menu-9')"
                        >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div
                            id="menu-9"
                            class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
                            role="menu"
                            aria-labelledby="menu-btn-9"
                        >
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button
                                class="flex items-center gap-2 w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm"
                                role="menuitem"
                            >
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <footer
            class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-2 mt-8 text-gray-500 text-sm font-normal"
        >
            <span class="ml-auto">Records per page:</span>
            <select
                aria-label="Records per page"
                class="border border-gray-300 rounded px-2 py-1 text-sm font-normal text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400"
            >
                <option>10 ▼</option>
            </select>
            <nav class="flex items-center gap-3 select-none">
                <button
                    aria-current="page"
                    class="w-8 h-8 border border-gray-900 rounded text-gray-900 font-semibold"
                >
                    1
                </button>
                <button class="text-gray-400 hover:text-gray-900">2</button>
                <button class="text-gray-400 hover:text-gray-900">3</button>
                <button class="text-gray-400 hover:text-gray-900">4</button>
                <button class="text-gray-400 hover:text-gray-900">5</button>
            </nav>
        </footer>
    </div>


    </div>
</template>

<style scoped>

</style>


