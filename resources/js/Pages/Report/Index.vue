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
                    <i class="fas fa-print text-base"></i>
                    Print
                </button>
                <button
                    type="button"
                    class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                >
                    <i class="fas fa-share-alt text-base"></i>
                    Export
                </button>
                <button
                    type="button"
                    class="flex items-center gap-2 hover:text-gray-700 focus:outline-none"
                >
                    <i class="fas fa-download text-base"></i>
                    Download
                </button>
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


