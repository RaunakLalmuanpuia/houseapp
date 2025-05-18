<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {Head} from "@inertiajs/vue3";

defineOptions({layout:AuthLayout})
const props = defineProps(['application', 'house','departments']);

import FLAM from "@/Components/EditApplication/FLAM.vue";
import OnDuty from "@/Components/EditApplication/OnDuty.vue";
import NotOnDuty from "@/Components/EditApplication/NotOnDuty.vue";
import NonOfficial from "@/Components/EditApplication/NonOfficial.vue";
import StudyTour from "@/Components/EditApplication/StudyTour.vue";
import Medical from "@/Components/EditApplication/Medical.vue";
</script>

<template>
    <Head title="Edit Application" />
<!--    {{application}}-->
    <div class="max-w-5xl mx-auto p-6 bg-white  rounded-xl">
        <h2 class="text-2xl font-semibold mb-6">Edit Application :: {{application.type}}</h2>

        <OnDuty
            v-if="application.type === 'ON DUTY'"
            :application="application"
            :house="house"
            :departments="departments"
        />

        <FLAM
            v-if="application.type === 'FLAM'"
            :application="application"
            :house="house"
        />

        <NotOnDuty
            v-if="application.type === 'NOT ON DUTY'"
            :application="application"
            :house="house"
            :departments="departments"
        />

        <NonOfficial
            v-if="application.type === 'PRIVATE'"
            :application="application"
            :house="house"
        />

        <StudyTour
            v-if="application.type === 'STUDY TOUR'"
            :application="application"
            :house="house"
        />

        <Medical
            v-if="application.type === 'MEDICAL'"
            :application="application"
            :house="house"
            :departments="departments"
        />


    </div>


</template>

<style scoped>

</style>
