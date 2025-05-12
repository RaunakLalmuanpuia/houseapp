<template>
    <Head title="Form" />
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
                            <li v-for="(message, field) in errors" :key="field">
                                {{ message }}
                            </li>
                        </ul>
                    </div>
                    <button @click="showError = false" class="ml-4 text-white font-bold text-xl leading-none">&times;</button>
                </div>
            </div>

            <div class="max-w-md w-full rounded-xl border border-gray-200 overflow-hidden">
                <header class="bg-[#FFE6E3] p-6 rounded-t-xl">
                    <h1 class="text-[#DD4939] font-extrabold text-xl leading-6">STUDY TOUR</h1>
                    <p class="text-[#DD4939] font-semibold text-sm leading-5 mt-1">Educational Group Travel</p>
                </header>
                <div class="bg-white p-6 space-y-6">
                    <h2 class="font-bold text-lg leading-6 border-l-4 border-black pl-2">Kal turte Information</h2>

                    <div>
                        <label for="applicant" class="block font-semibold text-sm leading-5 mb-1 text-black">Applicant Name</label>
                        <input
                            v-model="application.applicant_name"
                            id="applicant"
                            type="text"
                            placeholder="Diltu Hming"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['applicant_name']" class="text-red-500 text-sm">{{ errors['applicant_name'] }}</span>

                    </div>

                    <div>
                        <label for="gender" class="block font-semibold text-sm leading-5 mb-1 text-black">Gender</label>
                        <select
                            v-model="application.gender"
                            id="gender"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
                        >
                            <option disabled selected>Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                        <span v-if="errors['gender']" class="text-red-500 text-sm">{{ errors['gender'] }}</span>
                    </div>

                    <div>
                        <label for="contact" class="block font-semibold text-sm leading-5 mb-1 text-black">Contact Number</label>
                        <input
                            v-model="application.contact"
                            id="contact"
                            type="tel"
                            placeholder="Phone Number"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['contact']" class="text-red-500 text-sm">{{ errors['contact'] }}</span>
                    </div>

                    <div>
                        <label for="designation" class="block font-semibold text-sm leading-5 mb-1 text-black">Designation</label>
                        <input
                            v-model="application.designation"
                            id="designation"
                            type="text"
                            placeholder="Diltu Hnathawh"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['designation']" class="text-red-500 text-sm">{{ errors['designation'] }}</span>
                    </div>


                    <div>
                        <label for="institution" class="block font-semibold text-sm leading-5 mb-1 text-black">Institution</label>
                        <input
                            v-model="application.study_tour_details.institute"
                            id="institution"
                            type="text"
                            placeholder="Name of Institution"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />

                        <span v-if="errors['study_tour_details.institute']" class="text-red-500 text-sm">
                          {{ errors['study_tour_details.institute'] }}
                        </span>

                    </div>



                    <div>
                        <label for="approval" class="block font-semibold text-sm leading-5 mb-1 text-black">Institute Approval</label>
                        <input
                            id="approval"
                            type="file"
                            @change="handleFileUpload"
                           placeholder="Institute Approval"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['study_tour_details.institute_approval']" class="text-red-500 text-sm">
                          {{ errors['study_tour_details.institute_approval'] }}
                        </span>
                    </div>

                    <div>
                        <label class="block font-semibold text-sm leading-5 mb-1 text-black">No. of Male Student</label>
                        <input v-model="application.study_tour_details.male"  type="number" placeholder="Zirlai Mipa zat"
                               class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black" />

                        <span v-if="errors['study_tour_details.male']" class="text-red-500 text-sm">
                          {{ errors['study_tour_details.male'] }}
                        </span>

                    </div>

                    <div>
                        <label class="block font-semibold text-sm leading-5 mb-1 text-black">No. of Female Student</label>
                        <input v-model="application.study_tour_details.female"  type="number" placeholder="Zirlai Hmeichhia zat"
                               class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black" />
                        <span v-if="errors['study_tour_details.female']" class="text-red-500 text-sm">
                          {{ errors['study_tour_details.female'] }}
                        </span>
                    </div>



                    <hr class="border-t border-gray-200 mt-6" />

                    <div class="flex gap-4 mt-6">
                        <button
                            @click="back"
                            type="button"
                            class="border border-black rounded-lg py-3 text-base font-normal leading-6 text-black flex-grow"
                        >
                            Back
                        </button>
                        <button
                            @click="next"
                            type="submit"
                            class="bg-black rounded-lg py-3 text-base font-normal leading-6 text-white flex-grow-[2]"
                        >
                            Save & Next
                        </button>
                    </div>
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


import {Head, usePage} from '@inertiajs/vue3';
import {ref} from 'vue';
import { useStudyTourApplicationStore } from '@/Store/useStudyTourApplicationStore.js'
import { router } from '@inertiajs/vue3'

const application = useStudyTourApplicationStore()
const page = usePage()

const errors = ref({})
const showError = ref(false)
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        application.study_tour_details.institute_approval = file;
    }
}
function next() {
    if (!validateForm()) {
        showError.value = true;
        return;
    }
    router.visit(route('apply.study-tour.step-three'))
}

function back() {
    router.visit('/apply/step-one')
}
function validateForm() {
    errors.value = {}

    const allowedGenders = ['Male', 'Female', 'Other']

    // Basic required fields
    const requiredFields = [
        'type', 'status', 'applicant_name',
        'gender', 'designation', 'contact'
    ]
    requiredFields.forEach(field => {
        if (!application[field] || typeof application[field] !== 'string') {
            errors.value[field] = `${field.replace('_', ' ')} is required.`
        }
    })

    // Gender validation
    if (application.gender && !allowedGenders.includes(application.gender)) {
        errors.value['gender'] = 'Gender must be Male, Female, or Other.'
    }

    // Contact number validation (10 digits)
    if (application.contact && !/^\d{10}$/.test(application.contact)) {
        errors.value['contact'] = 'Contact must be a 10-digit number.'
    }


    // Study tour details
    const details = application.study_tour_details || {}

    if (!details.institute || typeof details.institute !== 'string') {
        errors.value['study_tour_details.institute'] = 'Institute name is required.'
    }

    if (details.male === '' || details.male === null || isNaN(details.male) || parseInt(details.male) < 0) {
        errors.value['study_tour_details.male'] = 'Male must be a non-negative number.'
    }

    if (details.female === '' || details.female === null || isNaN(details.female) || parseInt(details.female) < 0) {
        errors.value['study_tour_details.female'] = 'Female must be a non-negative number.'
    }

    if (!details.institute_approval) {
        errors.value['study_tour_details.institute_approval'] = 'Institute approval file is required.'
    }

    return Object.keys(errors.value).length === 0
}


</script>
