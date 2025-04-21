<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import OnDuty from "@/Components/Applications/OnDuty.vue";

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


    <Footer/>
</template>

<style scoped>

</style>
