<template>

<!--    {{allHouse}}-->
    <div style="background-color:#EEF5FF">
        <div class="flex flex-col items-center mt-2">
            <h2 class="font-semibold text-black mb-3 mt-3">Mizoram House Rate-te</h2>
            <div class="relative w-[280px] sm:w-[320px] md:w-[360px] lg:w-[400px]">
                <input
                    v-model="state.search"
                    type="search"
                    placeholder="Search"
                    @keyup.enter="handleSearch"
                    aria-label="Search"
                    class="w-full rounded-md border border-gray-300 py-2 px-4 pr-10 text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400"
                />
                <i
                    class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-lg pointer-events-none"
                    aria-hidden="true"
                ></i>
            </div>
            <nav class="flex flex-wrap justify-center space-x-4 mt-4 text-gray-600 text-sm select-none">
                <template v-for="house in allHouse" :key="house.id">
                    <a
                        href="#"
                        @click.prevent="selectHouse(house.name)"
                        class="hover:text-gray-800"
                        :class="{ 'text-[#f15a29] font-semibold': house.name === (state.search || props.house.name) }"
                    >
                        {{ house.name }}
                    </a>
                </template>
            </nav>

        </div>



        <Rate :house="house" :rooms="rooms" />
    </div>

</template>


<script setup>
import Rate from "@/Components/HouseRate/Rate.vue";
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(['allHouse', 'house', 'rooms', 'search']);

const state = reactive({
    search: props.search || '',
});

// For typing directly + Enter
const handleSearch = () => {
    router.get(route('house.index'), { search: state.search }, {
        preserveState: true,
        replace: true,
    });
};

// For clicking on a house name
const selectHouse = (houseName) => {
    state.search = houseName;
    router.get(route('house.index'), { search: houseName }, {
        preserveState: true,
        replace: true,
    });
};

</script>


