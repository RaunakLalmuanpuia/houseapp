<template>

    <Header/>
    <div class="flex flex-col items-center w-[400px] mx-auto p-3">
        <InformationStep class="w-full" />
        <p v-if="Object.keys(page.props.errors).length">
            <b>Please correct the following error(s):</b>
            <ul class="text-red-500 text-sm mt-2">
                <li v-for="(message, field) in page.props.errors" :key="field">
                    {{ message }}
                </li>
            </ul>
        </p>
        <div class="p-6 bg-card rounded-lg shadow-md w-full">

            <h1 class="text-xl font-semibold text-primary">Private</h1>
            <p class="text-muted-foreground">Non-official personal stay</p>
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


            <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
            <input v-model="application.contact" type="text" placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />




            <div v-for="(non_official, index) in application.non_official_details" :key="index">
                <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
                <input v-model="non_official.name" type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
                <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
                <select v-model="non_official.gender" class="mt-1 p-2 border border-border rounded w-full">
                    <option>Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>



                <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
                <input v-model="non_official.contact" type="text" placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />

                <button @click.prevent="application.removeNonOfficial(index)">Remove</button>
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
                <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" @click.prevent="application.addNonOfficial()">+ Add Other Official</button>
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

import { useNonOfficialApplicationStore } from '@/Store/useNonOfficialApplicationStore.js'
import {router, usePage} from '@inertiajs/vue3'
const page = usePage()
const application = useNonOfficialApplicationStore()

function next() {
    router.visit(route('apply.non-official.step-three'))
}

function back() {
    router.visit('/apply/step-one')
}
</script>
