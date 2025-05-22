<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import ReservationChart from "@/Components/Charts/ReservationChart.vue";
import CategoryChart from "@/Components/Charts/CategoryChart.vue";
import Applications from "@/Components/Statistics/Applications.vue";
import Status from "@/Components/Statistics/Status.vue";
import HouseStatus from "@/Components/Statistics/HouseStatus.vue";
import HouseApplications from "@/Components/Statistics/HouseApplications.vue";

import {Head, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";


const selectedYear = ref(new Date().getFullYear())
const years = Array.from({ length: 10 }, (_, i) => 2020 + i)

const admin=computed(()=>{
    const roles = usePage().props.roles;
    return roles.find(item => item === 'Admin');
})

const house=computed(()=>{
    const roles = usePage().props.roles;
    return roles.find(item => item === 'House');
})



</script>

<template>
    <Head title="Dashboard" />
    <AuthLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="ml-6">
            <Status v-if="admin"/>

            <Applications v-if="admin"/>

            <HouseStatus v-if="house"/>

            <HouseApplications v-if="house"/>

        </div>

        <div v-if="admin" class="py-12">
            <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row md:justify-between md:items-start gap-6">

                <div class="md:w-3/5">
                    <h2 class="text-black text-xl font-semibold flex items-center gap-2 mb-4">
                        <span class="border-l-4 border-black pl-2 flex items-center gap-2">
                          Reservation Stats :
                          <select
                              v-model="selectedYear"
                              class="border border-gray-300 rounded px-2 py-1 pr-8 text-sm focus:outline-none focus:ring focus:border-blue-300"
                          >
                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                          </select>
                        </span>

                        <i class="fas fa-caret-down text-black text-base"></i>
                    </h2>
                    <ReservationChart :year="selectedYear"/>
                </div>

                <div class="md:w-2/5 flex flex-col items-center">
                    <h2 class="text-black text-xl font-semibold flex items-center gap-2 mb-4 self-start">
                        <span class="border-l-4 border-black pl-2">Category</span>
                    </h2>
                    <CategoryChart/>
                </div>
            </div>


        </div>
    </AuthLayout>
</template>

