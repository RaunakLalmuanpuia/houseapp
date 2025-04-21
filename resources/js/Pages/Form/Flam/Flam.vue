
<template>

    <Header/>
    <div class="flex flex-col items-center w-[400px] mx-auto p-3">
        <InformationStep class="w-full" />
        <div class="p-6 bg-card rounded-lg shadow-md w-full">

            <h1 class="text-xl font-semibold text-primary">FLAM</h1>
            <p class="text-muted-foreground">Former Legislators Association of Mizoram</p>
            <h2 class="mt-4 text-lg font-medium">Kal turte Information</h2>

            <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
            <input v-model="application.applicant_name" type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
            <p class="text-muted-foreground text-xs">Must be FLAM member</p>

            <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
            <select v-model="application.gender" class="mt-1 p-2 border border-border rounded w-full">
                <option>Select</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>

            <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
            <input v-model="application.designation"  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

            <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
            <input v-model="application.contact" type="text" placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />


            <div v-for="(flam, index) in application.flam_details" :key="index">
                <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
                <input v-model="flam.flam_name" type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
                <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
                <select v-model="flam.gender" class="mt-1 p-2 border border-border rounded w-full">
                    <option>Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>

                <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
                <input v-model="flam.designation"  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

                <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
                <input v-model="flam.contact" type="text" placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />

                <button @click.prevent="application.removeFlam(index)">Remove</button>
            </div>



            <h2 class="mt-4 text-lg font-medium">Family Member</h2>
            <p class="text-muted-foreground text-xs">Must be FLAM member</p>

            <div v-for="(family, index) in application.family_details" :key="index">

                <label class="block mt-4 text-sm font-medium text-primary">Name</label>
                <input v-model="family.name" type="text" placeholder="Name" class="mt-1 p-2 border border-border rounded w-full" />

                <label class="block mt-4 text-sm font-medium text-primary">Relationship</label>
                <select v-model="family.relation" class="mt-1 p-2 border border-border rounded w-full">
                    <option>Select</option>
                    <option>Wife</option>
                    <option>Husband</option>
                    <option>Children</option>
                    <option>Other</option>
                </select>
                <button @click.prevent="application.removeFamilyMember(index)">Remove</button>
            </div>

            <div class="flex justify-between mt-4">
                <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" @click.prevent="application.addFlam()">+ Add FLAM</button>
                <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" @click.prevent="application.addFamilyMember()">+ Add Family</button>
            </div>




            <div class="flex justify-between mt-6">
                <button  @click="back" class="bg-muted text-muted-foreground hover:bg-muted/80 p-2 rounded border">Back</button>
                <button @click="next" class="bg-primary text-primary-foreground p-2 rounded-md">
                    Save & Next
                </button>
            </div>
        </div>
    </div>

    <Footer/>

</template>

<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import InformationStep from "@/Components/Common/InformationStep.vue";


import { useForm } from '@inertiajs/vue3';
import { defineProps, watch } from 'vue';
import { useFlamApplicationStore } from '@/Store/useFlamApplicationStore.js'
import { router } from '@inertiajs/vue3'

const application = useFlamApplicationStore()

function next() {
    router.visit('/apply/step-three')
}

function back() {
    router.visit('/apply/step-one')
}
</script>


<style scoped>

</style>
