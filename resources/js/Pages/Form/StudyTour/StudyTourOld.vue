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

                <h1 class="text-xl font-semibold text-primary">STUDY TOUR</h1>
                <p class="text-muted-foreground">Educational Group Travel</p>
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

                <label class="block mt-4 text-sm font-medium text-primary">Designation</label>
                <input v-model="application.designation"  type="text" placeholder="Diltu Hnathawh" class="mt-1 p-2 border border-border rounded w-full" />


                <label class="block mt-4 text-sm font-medium text-primary">Institution</label>
                <input v-model="application.study_tour_details.institute"  type="text" placeholder="Name of Institution" class="mt-1 p-2 border border-border rounded w-full" />


                <label class="block mt-4 text-sm font-medium text-primary">Institute Approval</label>
                <input
                    type="file"
                    @change="handleFileUpload"
                    class="mt-1 p-2 border border-border rounded w-full"
                />



                <label class="block mt-4 text-sm font-medium text-primary">No. of Male Student</label>
                <input v-model="application.study_tour_details.male"  type="number" placeholder="Zirlai Mipa zat" class="mt-1 p-2 border border-border rounded w-full" />

                <label class="block mt-4 text-sm font-medium text-primary">No. of Female Student</label>
                <input v-model="application.study_tour_details.female"  type="number" placeholder="Zirlai Hmeichhia zat" class="mt-1 p-2 border border-border rounded w-full" />


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
import { useStudyTourApplicationStore } from '@/Store/useStudyTourApplicationStore.js'
import { router } from '@inertiajs/vue3'

const application = useStudyTourApplicationStore()
const page = usePage()

const showError = ref(false)
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        application.study_tour_details.institute_approval = file;
    }
}
function next() {
    router.visit(route('apply.study-tour.step-three'))
}

function back() {
    router.visit('/apply/step-one')
}

watch(
    () => page.props.errors,
    (errors) => {
        showError.value = Object.keys(errors).length > 0
    },
    { immediate: true }
)
</script>
