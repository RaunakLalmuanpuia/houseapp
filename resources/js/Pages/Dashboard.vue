<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Welcome from '@/Components/Welcome.vue';

import { ref } from 'vue';

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
    <AuthLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div id="app" class="max-w-full">
            <div class="flex flex-wrap gap-6 mb-6">
                <div class="flex flex-col rounded-xl bg-[#fff3e6] p-6 min-w-[180px]">
                    <span class="text-orange-600 font-extrabold text-lg leading-none">106</span>
                    <span class="text-orange-500 mt-1 text-sm font-normal">Incoming</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#e8f9f0] p-6 min-w-[180px]">
                    <span class="text-green-700 font-extrabold text-lg leading-none">2,098</span>
                    <span class="text-green-600 mt-1 text-sm font-normal">Approved</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#ffeaea] p-6 min-w-[180px]">
                    <span class="text-red-400 font-extrabold text-lg leading-none">98</span>
                    <span class="text-red-400 mt-1 text-sm font-normal">Rejected</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#e6f3ff] p-6 min-w-[180px]">
                    <span class="text-blue-500 font-extrabold text-lg leading-none">23,23,098</span>
                    <span class="text-blue-500 mt-1 text-sm font-normal">All Application</span>
                </div>
            </div>

            <hr class="border-gray-300 mb-6" />

            <div class="flex flex-wrap gap-6">
                <div class="flex flex-col rounded-xl bg-[#fff3e6] p-6 min-w-[140px]">
                    <span class="text-[#5c3e1f] font-extrabold text-lg leading-none">106</span>
                    <span class="text-[#5c3e1f] mt-1 text-sm font-normal">FLAM</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#e1dfff] p-6 min-w-[140px]">
                    <span class="text-[#1e1a6f] font-extrabold text-lg leading-none">19,876</span>
                    <span class="text-[#1e1a6f] mt-1 text-sm font-normal">ON DUTY</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#e6ffdb] p-6 min-w-[140px]">
                    <span class="text-[#3a7a0a] font-extrabold text-lg leading-none">9,876</span>
                    <span class="text-[#3a7a0a] mt-1 text-sm font-normal">NOT ON DUTY</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#d9ecff] p-6 min-w-[140px]">
                    <span class="text-[#1e73e8] font-extrabold text-lg leading-none">5,000</span>
                    <span class="text-[#1e73e8] mt-1 text-sm font-normal">MEDICAL</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#fff3e6] p-6 min-w-[140px]">
                    <span class="text-orange-600 font-extrabold text-lg leading-none">2,006</span>
                    <span class="text-orange-500 mt-1 text-sm font-normal">PRIVATE</span>
                </div>
                <div class="flex flex-col rounded-xl bg-[#ffeaea] p-6 min-w-[140px]">
                    <span class="text-red-400 font-extrabold text-lg leading-none">13,094</span>
                    <span class="text-red-400 mt-1 text-sm font-normal">STUDY TOUR</span>
                </div>
            </div>
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
