<script setup>
import {defineProps} from "vue";
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import StudyTourCard from '@/Components/Submission/StudyTour.vue'
import OnDutyCard from "@/Components/Submission/OnDuty.vue";
import NotOnDuty from "@/Components/Submission/NotOnDuty.vue";
import Flam from "@/Components/Submission/Flam.vue";
import NonOfficial from "@/Components/Submission/NonOfficial.vue";

const props = defineProps({
    application: Object,
});

</script>

<template>

    <div class="min-h-screen flex flex-col">
        <Header/>

        <div class="flex-grow flex flex-col items-center bg-background mt-4">
            <div class="bg-card bg-green-500 rounded-lg shadow-lg p-6 max-w-md text-center ">
                <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-4">
            <span>
                <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="42" height="42" rx="21" fill="white"/>
                    <mask id="mask0_64_4582" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="11" y="11" width="20" height="20">
                        <rect x="11" y="11" width="20" height="20" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_64_4582)">
                        <path d="M18.959 26L14.209 21.25L15.3965 20.0625L18.959 23.625L26.6048 15.9792L27.7923 17.1667L18.959 26Z" fill="#3B6939"/>
                    </g>
                </svg>
            </span>
                </div>
                <h2 class=" text-white text-lg font-semibold mb-2 text-center">You have successfully submitted your application</h2>
            </div>

            <div class="bg-card rounded-lg shadow-lg p-6 max-w-md text-center">
                <p class="text-muted-foreground mb-4">Please, Remember your Application ID to check status and receive it via SMS.</p>
                <p class="font-medium mb-2">Application ID</p>
                <p class="text-lg font-bold">{{ props.application.application_id }}</p>
                <br>
                <p class="text-muted-foreground mb-4">All reservations are made subject to availability of seats and GAD has no responsibility if accommodation is denied due to non-availability of seats.</p>
            </div>
        </div>

        <StudyTourCard
            v-if="application.type === 'STUDY TOUR'"
            :application="application"
        />
        <OnDutyCard
            v-if="application.type === 'ON DUTY'"
            :application="application"
        />
        <NotOnDuty
            v-if="application.type === 'NOT ON DUTY'"
            :application="application"
        />
        <Flam
            v-if="application.type === 'FLAM'"
            :application="application"
        />
        <NonOfficial
            v-if="application.type === 'PRIVATE'"
            :application="application"
        />

        <div class="p-4">
            <button
                class="bg-secondary text-secondary-foreground hover:bg-secondary/80 w-full py-2 rounded-lg"
                @click="$inertia.get(route('home'))"
            >
                Back to Home
            </button>
        </div>

        <Footer/>

    </div>

</template>

<style scoped>

</style>


