<script setup>

</script>

<template>
    <section class="flex-grow space-y-8">
        <!-- Add Room Type form -->
        <form
            class="border border-gray-200 rounded-xl p-6 max-w-4xl"
            aria-label="Add Room Type"
        >
            <h3 class="font-bold text-lg mb-6">Add Mizoram House</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div>
                    <label
                        for="roomTypeName"
                        class="block text-sm font-normal mb-1 text-black"
                    >Name</label
                    >
                    <input
                        id="roomTypeName"
                        name="roomTypeName"
                        type="text"
                        placeholder="Name of Room Type"
                        class="w-full rounded border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                    />
                </div>

            </div>
            <button
                type="submit"
                class="bg-black text-white rounded-md px-8 py-3 text-base font-normal"
            >
                Submit
            </button>
        </form>

        <!-- List of Room Type -->
        <section class="max-w-4xl space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="font-bold text-lg mb-3 sm:mb-0">List of Mizoram House</h3>
                <form
                    class="relative w-full max-w-xs sm:w-auto"
                    role="search"
                    aria-label="Search Room Types"
                >
                    <input
                        type="search"
                        name="search"
                        id="search"
                        placeholder="Search"
                        class="w-full sm:w-64 rounded-lg border border-gray-400 px-4 py-2 pr-10 text-gray-600 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                    />
                    <button
                        type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-black"
                        aria-label="Search"
                    >
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <table class="w-full border-collapse text-sm">
                <thead>
                <tr class="bg-gray-700 text-white text-left">
                    <th class="py-2 px-3 font-semibold w-[10%]">SL.NO</th>
                    <th class="py-2 px-3 font-semibold w-[40%]">HOUSE</th>
                    <th class="py-2 px-3 font-semibold w-[10%] text-center">ACTION</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b border-gray-100">
                    <td class="py-2 px-3">30</td>
                    <td class="py-2 px-3">Visant Vihar, New Delhi</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <td class="py-2 px-3">29</td>
                    <td class="py-2 px-3">Visant Vihar, New Delhi</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-100">
                    <td class="py-2 px-3">28</td>
                    <td class="py-2 px-3">Visant Vihar, New Delhi</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <td class="py-2 px-3">27</td>
                    <td class="py-2 px-3">Salt Lake, Kolkata</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-100">
                    <td class="py-2 px-3">26</td>
                    <td class="py-2 px-3">Salt Lake, Kolkata</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <td class="py-2 px-3">25</td>
                    <td class="py-2 px-3">Salt Lake, Kolkata</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-100">
                    <td class="py-2 px-3">24</td>
                    <td class="py-2 px-3">Salt Lake, Kolkata</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <td class="py-2 px-3">23</td>
                    <td class="py-2 px-3">Salt Lake, Kolkata</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-100">
                    <td class="py-2 px-3">22</td>
                    <td class="py-2 px-3">Salt Lake, Kolkata</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <td class="py-2 px-3">21</td>
                    <td class="py-2 px-3">Bengaluru</td>
                    <td class="py-2 px-3 text-center">
                        <i class="fas fa-ellipsis-v cursor-pointer"></i>
                    </td>
                </tr>
                </tbody>
            </table>

            <nav
                class="flex items-center justify-end space-x-3 text-gray-500 text-sm select-none"
                aria-label="Pagination"
            >
                <span class="mr-2">Records per page:</span>
                <select
                    aria-label="Records per page"
                    class="border border-gray-300 rounded px-1.5 py-0.5 text-black cursor-pointer"
                    name="recordsPerPage"
                    id="recordsPerPage"
                >
                    <option>10</option>
                </select>
                <button
                    aria-current="page"
                    class="border border-black rounded px-3 py-1 font-semibold text-black"
                >
                    1
                </button>
                <button class="hover:text-black cursor-pointer">2</button>
                <button class="hover:text-black cursor-pointer">3</button>
                <button class="hover:text-black cursor-pointer">4</button>
                <button class="hover:text-black cursor-pointer">5</button>
            </nav>
        </section>
    </section>
</template>

<style scoped>

</style>
