<script setup>
import {Head, Link, router} from '@inertiajs/vue3';
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import Rate from "@/Components/HouseRate/Rate.vue";
import {onMounted, ref} from "vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const allHouse = ref();
const house = ref();
const rooms = ref();


const filter = ref('');

function handleSearch(val) {
    getHouseRate({ filter: val });
}

function clearSearch() {
    filter.value = ''; // Clear the search value
    // Reset the pagination if needed (e.g., set page to 1 after clearing search)
    getHouseRate({  filter: '' }); // Clear the filter in the API request
}
function getHouseRate(props) {
    const filter = props.filter;

    axios.get(route('house.index'), {
        params: {
            filter,
        }
    }).then(res => {
        const { allHouseData, houseData, roomsData } = res.data;

        allHouse.value = allHouseData;
        house.value = houseData;
        rooms.value = roomsData;


    }).catch(err => {
        console.error(err?.response?.data?.message);
    }).finally(() => {
    });
}

const selectHouse = (houseName) => {
    getHouseRate({ filter: houseName });
};

onMounted(() => {
    getHouseRate({filter: filter.value });
});
</script>

<template>
    <Head title="Welcome" />

    <Header/>


    <div class="bg-[#1F3652] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center md:items-start justify-between gap-4 md:gap-20">
            <div class="flex-1 w-full md:max-w-xl text-white">
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">
                    Chibai! Kan lo lawm a che!
                </h1>
                <p class="text-base md:text-lg font-normal leading-relaxed max-w-md mb-20">
                    Effortless Reservations, Peaceful Stays
                    <br/>
                    Mizoram House for You
                </p>
            </div>

            <div class="flex gap-6">
                <a class="flex flex-col justify-center rounded-xl bg-[#0059d9] px-8 py-10 w-40 md:w-48 text-white cursor-pointer hover:brightness-110 transition" href="#">
                    <div class="flex items-center justify-between text-xl font-bold mb-1">
                        <span>Form</span>
                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.6 6L0 1.4L1.4 0L7.4 6L1.4 12L0 10.6L4.6 6Z" fill="white"/>
                        </svg>

                    </div>
                    <span class="text-sm font-normal">Reservation Form</span>
                </a>

                <a class="flex flex-col justify-center rounded-xl bg-[#df8a0f] px-8 py-10 w-40 md:w-48 text-white cursor-pointer hover:brightness-110 transition" href="#">
                    <div class="flex items-center justify-between text-xl font-bold mb-1">
                        <span>Status</span>
                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.6 6L0 1.4L1.4 0L7.4 6L1.4 12L0 10.6L4.6 6Z" fill="white"/>
                        </svg>
                    </div>
                    <span class="text-sm font-normal">Check for Status</span>
                </a>
            </div>
        </div>



        <!-- Now shifted towards right -->
        <img
            src="/images/icons/dance.png"
            alt="Outline drawing of people dancing"
            class="absolute bottom-0 left-20 md:left-20 w-72 md:w-96 opacity-300  pointer-events-none select-none"
        />
    </div>

    <div style="background-color:#EEF5FF">
        <div class="flex flex-col items-center mt-2">
            <h2 class="font-semibold text-black mb-3 mt-3">Mizoram House Rate-te</h2>
            <div class="relative w-[280px] sm:w-[320px] md:w-[360px] lg:w-[400px]">
                <input
                    v-model="filter"
                    type="search"
                    placeholder="Search"
                    @input="handleSearch(filter)"
                    aria-label="Search"
                    class="w-full rounded-md border border-gray-300 py-2 px-4 pr-10 text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                />
                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
                >
                    <path
                        d="M13.893 13.92L16.973 17M16 8.5C16 10.4891 15.2098 12.3968 13.8033 13.8033C12.3968 15.2098 10.4891 16 8.5 16C6.51088 16 4.60322 15.2098 3.1967 13.8033C1.79018 12.3968 1 10.4891 1 8.5C1 6.51088 1.79018 4.60322 3.1967 3.1967C4.60322 1.79018 6.51088 1 8.5 1C10.4891 1 12.3968 1.79018 13.8033 3.1967C15.2098 4.60322 16 6.51088 16 8.5Z"
                        stroke="#61646B"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>


            <nav class="flex flex-wrap justify-center space-x-4 mt-4 text-gray-600 text-sm select-none">
                <template v-for="houses in allHouse" :key="house.id">
                    <a
                        href="#"
                        @click.prevent="selectHouse(houses.name)"
                        class="hover:text-gray-800"
                        :class="{ 'text-[#f15a29] font-semibold': houses.name === house.name }"
                    >
                        {{ houses.name }}
                    </a>
                </template>
            </nav>

        </div>

        <Rate v-if="house && rooms" :house="house" :rooms="rooms" />
    </div>



    <div class="flex flex-col md:flex-row justify-center items-stretch gap-2 md:gap-4 p-6 bg-card">
        <div class="w-full max-w-md p-4 flex flex-col bg-card rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-grow">
                <div class="p-4 border rounded-lg bg-card text-foreground">
                    <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                        On Duty & Not On Duty
                    </p>
                </div>
                <div class="p-4 border rounded-lg bg-card text-foreground">
                    <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                        Medical Study Tour Private
                    </p>

                </div>
                <div class="col-span-1 md:col-span-2 p-4 border rounded-lg bg-card text-foreground">
                    <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                        General Requirements (For All Applicants)
                    </p>
                </div>
                <div class="p-4 border rounded-lg bg-card text-foreground">
                    <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                        Special Concessions & Conditions
                    </p>

                </div>
                <div class="p-4 border rounded-lg bg-card text-foreground">
                    <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                        Before Entering Mizoram House
                    </p>

                </div>
            </div>
        </div>
        <div class="w-full max-w-md p-6 bg-card rounded-lg shadow-md flex flex-col h-full">
            <h2 class="text-lg font-semibold mb-4">General Requirements (For All Applicants)</h2>
            <hr class="border-b border-border mb-4" />
            <ol class="list-decimal list-inside space-y-2 flex-grow">
                <li><span class="font-medium">Valid Identity Card :</span> Required for all guests at check-in and bill payment.</li>
                <li><span class="font-medium">Room Availability :</span> Booking is subject to room availability.</li>
                <li><span class="font-medium">Room Rent :</span> Charges vary based on category (On Duty, Not On Duty, Medical, Private).</li>
                <li><span class="font-medium">Extra Bed Charges :</span> ₹100 per extra bed/mattress per night.</li>
                <li>
                    <span class="font-medium">Transit Stay Charges :</span>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Up to 3 hours : 20% of normal room rent.</li>
                        <li>3 to 10 hours : 50% of normal room rent.</li>
                        <li>More than 10 hours : Full-day charge.</li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>


    <div style="background: #F8F8F8;" class="flex flex-col md:flex-row justify-center items-center p-6 space-y-4 md:space-y-0 md:space-x-4">
        <div class="w-full max-w-md bg-background p-4 rounded-lg shadow-md">
            <p class="text-black font-sans text-[20px] font-bold leading-[24px] tracking-[0.15px]">
                Application Statistics
            </p>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="w-[196px] h-[88px] flex-shrink-0 rounded-[14px] border border-[#EEE] bg-white p-4 shadow">

                    <p class="text-[rgba(2,2,2,0.87)] font-sans text-[20px] font-bold leading-[23px] tracking-[0.15px]">
                        10,30,987
                    </p>

                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Submitted
                    </p>

                </div>
                <div class="w-[196px] h-[88px] flex-shrink-0 rounded-[14px] border border-[#EEE] bg-white p-4 shadow">
                    <p class="text-[rgba(2,2,2,0.87)] font-sans text-[20px] font-bold leading-[23px] tracking-[0.15px]">
                        6,12,340
                    </p>

                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Approved
                    </p>

                </div>
            </div>
            <p class="text-[20px] font-bold leading-[24px] text-black font-sans mt-6">
                Category Statistics
            </p>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-orange-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#733E15] font-sans">
                        10,30,987
                    </p>

                    <p class="text-[12px] font-normal leading-[18px] text-[#733E15] font-sans">
                        FLAM
                    </p>

                </div>
                <div class="bg-purple-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#409B16] font-sans">
                        6,12,340
                    </p>

                    <p class="text-[12px] font-normal leading-[18px] text-[#150D72] font-sans">
                        On Duty
                    </p>

                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#409B16] font-sans">
                        1,007
                    </p>

                    <p class="text-[12px] font-normal leading-[18px] text-[#409B16] font-sans">
                        Not on Duty
                    </p>

                </div>
                <div class="bg-blue-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#0073FF] font-sans">
                        987
                    </p>

                    <p class="text-[12px] font-normal leading-[18px] text-[#0073FF] font-sans">
                        Medical
                    </p>

                </div>
                <div class="bg-red-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#FF8C00] font-sans">
                        1,007
                    </p>

                    <p class="text-[12px] font-normal leading-[18px] text-[#FF8C00] font-sans">
                        Private
                    </p>

                </div>
                <div class="bg-pink-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#DD4939] font-sans">
                        987
                    </p>

                    <p class="text-[12px] font-normal leading-[18px] text-[#DD4939] font-sans">
                        Study Tour
                    </p>

                </div>
            </div>
        </div>

        <div  class="w-full max-w-md bg-card p-4 rounded-lg shadow-md">
            <p class=" text-black font-sans text-[20px] font-bold leading-[24px] tracking-[0.15px]">
                Mizoram House Online Reservation chungchang a zawhna leh chhana tlanglawn
            </p>

            <div class="mt-4 space-y-2">
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Mizoram House Online Reservation hi tu te in nge dil thei?
                    </p>
                    <button class="text-primary">+</button>
                </div>
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Lorem Ipsum zawhna 1?
                    </p>

                    <button class="text-primary">+</button>
                </div>
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Lorem Ipsum zawhna 2?
                    </p>
                    <button class="text-primary">+</button>
                </div>
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Lorem Ipsum zawhna 3?
                    </p>
                    <button class="text-primary">+</button>
                </div>
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Lorem Ipsum zawhna 4?
                    </p>
                    <button class="text-primary">+</button>
                </div>
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Lorem Ipsum zawhna 5?
                    </p>
                    <button class="text-primary">+</button>
                </div>
                <div class="flex justify-between items-center p-2 border-b border-border">
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">
                        Lorem Ipsum zawhna 6?
                    </p>
                    <button class="text-primary">+</button>
                </div>
            </div>
        </div>
    </div>


    <Footer/>



</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>


