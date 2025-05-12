<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Welcome from '@/Components/Welcome.vue';

import { ref } from 'vue';
import {Head} from "@inertiajs/vue3";

// Data for the status cards
const incoming = ref(106);
const approved = ref(2098);
const rejected = ref(98);
const allApplications = ref(2323098);

const card1 = ref({ number: 106, label: 'FLAM' });
const card2 = ref({ number: 19876, label: 'ON DUTY' });
const card3 = ref({ number: 9876, label: 'NOT ON DUTY' });
const card4 = ref({ number: 5000, label: 'MEDICAL' });
const card5 = ref({ number: 2006, label: 'PRIVATE' });
const card6 = ref({ number: 13094, label: 'STUDY TOUR' });
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

            <!-- Top stats row 2 -->
                    <section class="flex flex-wrap gap-2 mb-6 text-[12px] font-semibold">
                        <div class="w-[150px] h-[78px] bg-[#F9F0D9] text-[#B27F00] rounded-md px-3 py-2 flex flex-col justify-center">
                            <span class="text-[15px] font-bold leading-none">106</span>
                            <span class="font-normal">FLAM</span>
                        </div>
                        <div class="w-[150px] h-[78px] bg-[#D9D9F9] text-[#3B3B8F] rounded-md px-3 py-2 flex flex-col justify-center">
                            <span class="text-[15px] font-bold leading-none">19,876</span>
                            <span class="font-normal">ON DUTY</span>
                        </div>
                        <div class="w-[150px] h-[78px] bg-[#D9F9D9] text-[#3B8F3B] rounded-md px-3 py-2 flex flex-col justify-center">
                            <span class="text-[15px] font-bold leading-none">9,876</span>
                            <span class="font-normal">NOT ON DUTY</span>
                        </div>
                        <div class="w-[150px] h-[78px] bg-[#D9E9F9] text-[#3B8FF9] rounded-md px-3 py-2 flex flex-col justify-center">
                            <span class="text-[15px] font-bold leading-none">5,000</span>
                            <span class="font-normal">MEDICAL</span>
                        </div>
                        <div class="w-[150px] h-[78px] bg-[#F9E9D9] text-[#B27F00] rounded-md px-3 py-2 flex flex-col justify-center">
                            <span class="text-[15px] font-bold leading-none">2,006</span>
                            <span class="font-normal">PRIVATE</span>
                        </div>
                        <div class="w-[150px] h-[78px] bg-[#F9D9D9] text-[#B23B3B] rounded-md px-3 py-2 flex flex-col justify-center">
                            <span class="text-[15px] font-bold leading-none">13,094</span>
                            <span class="font-normal">STUDY TOUR</span>
                        </div>
                    </section>
        </div>

        <div class="py-12">
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">-->
<!--                    <Welcome />-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </AuthLayout>
</template>
