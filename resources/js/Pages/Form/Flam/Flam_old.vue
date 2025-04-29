
<template>
    <div class="min-h-screen flex flex-col">
        <Header/>
        <div class="flex-grow flex flex-col items-center w-[400px] mx-auto p-3">
            <InformationStep class="w-full" />

            <div
                v-if="showError"
                class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white p-4 rounded-lg shadow-lg w-[90%] max-w-md z-50"
            >
                <div class="flex justify-between items-start">
                    <div>
                        <b class="block">Please correct the following error(s):</b>
                        <ul class="text-sm mt-2 list-disc list-inside">
                            <li v-for="(message, field) in page.props.errors" :key="field">
                                {{ message }}
                            </li>
                        </ul>
                    </div>
                    <button @click="showError = false" class="ml-4 text-white font-bold text-xl leading-none">&times;</button>
                </div>
            </div>


            <div class="p-6 bg-card rounded-lg shadow-md w-full">

                <div>
                    <h1 class="text-xl font-semibold text-primary">FLAM</h1>
                    <p class="text-muted-foreground">Former Legislators Association of Mizoram</p>
                </div>


                <h2 class="mt-4 text-lg font-medium">Kal turte Information</h2>

                <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
                <input v-model="application.applicant_name" required  type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
                <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
                <select v-model="application.gender"  required  class="mt-1 p-2 border border-border rounded w-full">
                    <option>Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>

                <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
                <input v-model="application.designation" required   type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

                <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
                <input v-model="application.contact" type="text" required placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />


                <div v-for="(flam, index) in application.flam_details" :key="index">

                    <h2 class="mt-4 text-lg font-medium">FLAM Member</h2>
                    <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                    <label class="block mt-4 text-sm font-medium text-primary">Applicant Name</label>
                    <input v-model="flam.flam_name" required  type="text" placeholder="Diltu Hming" class="mt-1 p-2 border border-border rounded w-full" />
                    <p class="text-muted-foreground text-xs">Must be FLAM member</p>

                    <label class="block mt-4 text-sm font-medium text-primary">Gender</label>
                    <select v-model="flam.gender" required  class="mt-1 p-2 border border-border rounded w-full">
                        <option>Select</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>

                    <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
                    <input v-model="flam.designation" required   type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />

                    <label class="block mt-4 text-sm font-medium text-primary">Contact Number</label>
                    <input v-model="flam.contact" type="text" required  placeholder="Phone Number" class="mt-1 p-2 border border-border rounded w-full" />

                    <button @click.prevent="application.removeFlam(index)">Remove</button>
                </div>





                <div v-for="(family, index) in application.family_details" :key="index">
                    <h2 class="mt-4 text-lg font-medium">Family Member</h2>
                    <p class="text-muted-foreground text-xs">Must be FLAM Relative</p>
                    <label class="block mt-4 text-sm font-medium text-primary">Name</label>
                    <input v-model="family.name" required  type="text" placeholder="Name" class="mt-1 p-2 border border-border rounded w-full" />

                    <label class="block mt-4 text-sm font-medium text-primary">Relationship</label>
                    <select v-model="family.relation"  required  class="mt-1 p-2 border border-border rounded w-full">
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

    </div>


</template>

<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import InformationStep from "@/Components/Common/InformationStep.vue";


import {useForm, usePage} from '@inertiajs/vue3';
import {defineProps, ref, watch} from 'vue';
import { useFlamApplicationStore } from '@/Store/useFlamApplicationStore.js'
import { router } from '@inertiajs/vue3'
const page = usePage()
const application = useFlamApplicationStore()

const showError = ref(false)
function validateForm() {
    if (!application.applicant_name || !application.gender || !application.designation || !application.contact) {
        return false;
    }

    for (const flam of application.flam_details) {
        if (!flam.flam_name || !flam.gender || !flam.designation || !flam.contact) {
            return false;
        }
    }

    for (const family of application.family_details) {
        if (!family.name || !family.relation) {
            return false;
        }
    }

    return true;
}
function next() {
    if (!validateForm()) {
        alert("Please fill all required fields before proceeding.");
        return;
    }

    router.visit(route('apply.flam.step-three'))
}


watch(
    () => page.props.errors,
    (errors) => {
        showError.value = Object.keys(errors).length > 0
    },
    { immediate: true }
)
function back() {
    router.visit('/apply/step-one')
}
</script>


<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>


