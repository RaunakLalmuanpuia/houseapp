<script setup>
import {Head, Link, router} from '@inertiajs/vue3';
import {computed} from "vue";
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";


import HouseRate from "@/Components/Landing/HouseRate.vue";
import Knowledge from "@/Components/Landing/Knowledge.vue";
import Chibai from "@/Components/Landing/Chibai.vue";
import Statistics from "@/Components/Landing/Statistics.vue";
import Faqs from "@/Components/Landing/Faqs.vue";


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});



</script>

<template>
    <Head title="Welcome" />

    <Header/>


<!--    Chibai Section-->
    <Chibai/>


<!--    House Rate-->
    <HouseRate/>

<!--    Knowledge-->
   <Knowledge/>

    <div style="background: #F8F8F8;" class="flex flex-col md:flex-row justify-center items-stretch p-6 space-y-4 md:space-y-0 md:space-x-4">
        <!--    Statistics-->
        <Statistics/>

        <Faqs/>

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


