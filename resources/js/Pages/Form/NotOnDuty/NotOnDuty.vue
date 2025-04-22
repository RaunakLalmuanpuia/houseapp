<template>
    <div class="min-h-screen flex flex-col">
        <Header/>
        <div class="flex-grow flex flex-col items-center w-[400px] mx-auto p-3">
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

                <h1 class="text-xl font-semibold text-primary">NOT ON DUTY</h1>
                <p class="text-muted-foreground">Officials travelling for personal reason</p>
                <h2 class="mt-4 text-lg font-medium">Kal turte Information</h2>

                <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
                <input v-model="application.applicant_name" required type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
                <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
                <select v-model="application.gender" required class="mt-1 p-2 border border-border rounded w-full">
                    <option>Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>

                <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
                <input v-model="application.designation" required  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />


                <label class="block mt-4 text-sm font-medium text-primary">Department</label>
                <input v-model="application.department" required  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

                <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
                <input v-model="application.contact" required type="text" placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />




                <div v-for="(not_on_duty, index) in application.not_on_duty_details" :key="index">
                    <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
                    <input v-model="not_on_duty.name" required type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
                    <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                    <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
                    <select v-model="not_on_duty.gender" required class="mt-1 p-2 border border-border rounded w-full">
                        <option>Select</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>

                    <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
                    <input v-model="not_on_duty.designation" required  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

                    <label class="block mt-4 text-sm font-medium text-primary">Department</label>
                    <input v-model="not_on_duty.department"  required  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

                    <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
                    <input v-model="not_on_duty.contact"  required type="text" placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />

                    <button @click.prevent="application.removeNotOnDuty(index)">Remove</button>
                </div>



                <h2 class="mt-4 text-lg font-medium">Family Member</h2>
                <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                <div v-for="(family, index) in application.family_details" :key="index">

                    <label class="block mt-4 text-sm font-medium text-primary">Name</label>
                    <input v-model="family.name" required type="text" placeholder="Name" class="mt-1 p-2 border border-border rounded w-full" />

                    <label class="block mt-4 text-sm font-medium text-primary">Relationship</label>
                    <select v-model="family.relation" required class="mt-1 p-2 border border-border rounded w-full">
                        <option>Select</option>
                        <option>Wife</option>
                        <option>Husband</option>
                        <option>Children</option>
                        <option>Other</option>
                    </select>
                    <button @click.prevent="application.removeFamilyMember(index)">Remove</button>
                </div>

                <div class="flex justify-between mt-4">
                    <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" @click.prevent="application.addNotOnDuty()">+ Add Other Official</button>
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

    </div>


</template>
<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import InformationStep from "@/Components/Common/InformationStep.vue";

import { useNotOnDutyApplicationStore } from '@/Store/useNotOnDutyApplicationStore.js'
import {router, usePage} from '@inertiajs/vue3'

const application = useNotOnDutyApplicationStore()
const page = usePage()
function next() {
    router.visit(route('apply.not-on-duty.step-three'))
}

function back() {
    router.visit('/apply/step-one')
}
</script>
