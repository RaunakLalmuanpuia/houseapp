<script setup>
import Rate from "@/Components/HouseRate/Rate.vue";
import {onMounted, ref} from "vue";


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
    <!--    House Rate-->
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


            <nav class="flex flex-wrap justify-center space-x-4 mt-4 text-gray-600 text-sm select-none p-2">
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
</template>

<style scoped>

</style>
