<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import OnDuty from "@/Components/Applications/OnDuty.vue";
import Flam from "@/Components/Applications/Flam.vue";
import NotOnDuty from "@/Components/Applications/NotOnDuty.vue";
import NonOfficial from "@/Components/Applications/NonOfficial.vue";
import StudyTour from "@/Components/Applications/StudyTour.vue";

defineProps({
    application: Object,
});
</script>

<template>
    <Header/>


    <OnDuty
        v-if="application.type === 'ON DUTY'"
        :application="application"
    />

    <Flam
        v-if="application.type === 'FLAM'"
        :application="application"
    />

    <NotOnDuty
        v-if="application.type === 'NOT ON DUTY'"
        :application="application"
    />
<!--<div>{{application}}</div>-->
    <NonOfficial
        v-if="application.type === 'PRIVATE'"
        :application="application"
    />


    <StudyTour
        v-if="application.type === 'STUDY TOUR'"
        :application="application"
    />


    <Footer/>
</template>

<style scoped>

</style>
