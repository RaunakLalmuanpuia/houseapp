
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
                            <li v-for="(message, field) in errors" :key="field">{{ message }}</li>
                        </ul>
                    </div>
                    <button @click="showError = false" class="ml-4 text-white font-bold text-xl leading-none">&times;</button>
                </div>
            </div>


            <div class="max-w-md w-full rounded-xl border border-gray-200 overflow-hidden">
                <header class="bg-[#E0F3FF] p-6 rounded-t-xl">
                    <h1 class="text-[#0073FF] font-extrabold text-xl leading-6">Medical</h1>
                    <p class="text-[#0073FF] font-semibold text-sm leading-5 mt-1">Patients referred for treatment</p>
                </header>
                <div class="bg-white p-6 space-y-6">
                    <h2 class="font-bold text-lg leading-6 border-l-4 border-black pl-2">Kal turte Information</h2>


                    <div>
                        <label for="applicant" class="block font-semibold text-sm leading-5 mb-1 text-black">Category</label>
                        <select
                            v-model="application.category"
                            id="applicant"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        >
                            <option disabled>Select Category</option>
                            <option value="Patient">Patient</option>
                            <option value="Attendant">Attendant</option>

                        </select>
                        <span v-if="errors['applicant_name']" class="text-red-500 text-sm">{{ errors['applicant_name'] }}</span>

                    </div>

                    <div>
                        <label for="service" class="block font-semibold text-sm leading-5 mb-1 text-black">Service</label>
                        <select
                            v-model="application.service"
                            id="applicant"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        >
                            <option disabled>Select Service</option>
                            <option value="Govt">Govt</option>
                            <option value="Non-Govt">Non-Govt</option>
                        </select>
                        <span v-if="errors['applicant_name']" class="text-red-500 text-sm">{{ errors['applicant_name'] }}</span>

                    </div>



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
                            <option disabled>Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                        <span v-if="errors['gender']" class="text-red-500 text-sm">{{ errors['gender'] }}</span>
                    </div>

                    <div v-if="application.service && application.service === 'Govt'">
                        <label for="department" class="block font-semibold text-sm leading-5 mb-1 text-black">Department</label>
                        <input
                            v-model="application.department"
                            id="designation"
                            type="text"
                            placeholder="Diltu Department"
                            class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['department']" class="text-red-500 text-sm">{{ errors['department'] }}</span>
                    </div>

                    <div v-if="application.service && application.service === 'Govt'">
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


                    <div v-if="application.patient_details && application.patient_details.length > 0">
                        <h2 class="font-bold text-lg leading-6 border-l-4 border-black pl-2">More Patient</h2>
                    </div>

                    <div v-for="(patient, index) in application.patient_details" :key="index">

                        <p class="text-muted-foreground text-s py-2">Other Patient</p>


                        <div>
                            <label for="service" class="block font-semibold text-sm leading-5 mb-1 text-black">Service</label>
                            <select
                                v-model="patient.service"
                                id="applicant"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            >
                                <option disabled>Select Service</option>
                                <option value="Govt">Govt</option>
                                <option value="Non-Govt">Non-Govt</option>
                            </select>
                            <span v-if="errors[`patient.${index}.service`]" class="text-red-500 text-sm">
                                  {{ errors[`patient.${index}.service`] }}
                            </span>
                        </div>

                        <div>
                            <label for="applicant" class="block font-semibold text-sm leading-5 mb-1 text-black">Applicant Name</label>
                            <input
                                v-model="patient.name"
                                id="applicant"
                                type="text"
                                placeholder="Diltu Hming"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`patient.${index}.name`]" class="text-red-500 text-sm">
                                  {{ errors[`patient.${index}.name`] }}
                            </span>
                        </div>

                        <div>
                            <label for="gender" class="block font-semibold text-sm leading-5 mb-1 text-black">Gender</label>
                            <select
                                v-model="patient.gender"
                                id="gender"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
                            >
                                <option disabled selected>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                            <span v-if="errors[`patient.${index}.gender`]" class="text-red-500 text-sm">
                                  {{ errors[`patient.${index}.gender`] }}
                            </span>
                        </div>

                        <div v-if="patient.service && patient.service === 'Govt'">
                            <label for="department" class="block font-semibold text-sm leading-5 mb-1 text-black">Department</label>
                            <input
                                v-model="patient.department"
                                id="designation"
                                type="text"
                                placeholder="Diltu Department"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`patient.${index}.department`]" class="text-red-500 text-sm">
                                  {{ errors[`patient.${index}.department`] }}
                            </span>
                        </div>

                        <div v-if="patient.service && patient.service === 'Govt'">
                            <label for="designation" class="block font-semibold text-sm leading-5 mb-1 text-black">Designation</label>
                            <input
                                v-model="patient.designation"
                                id="designation"
                                type="text"
                                placeholder="Diltu Hnathawh"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`patient.${index}.designation`]" class="text-red-500 text-sm">
                                  {{ errors[`patient.${index}.designation`] }}
                            </span>
                        </div>

                        <div>
                            <label for="contact" class="block font-semibold text-sm leading-5 mb-1 text-black">Contact Number</label>
                            <input
                                v-model="patient.contact"
                                id="contact"
                                type="tel"
                                placeholder="Phone Number"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`patient.${index}.contact`]" class="text-red-500 text-sm">
                                  {{ errors[`patient.${index}.contact`] }}
                            </span>
                        </div>

                        <button @click.prevent="application.removePatient(index)">Remove</button>
                    </div>


                    <div v-if="application.attendant_details && application.attendant_details.length > 0">
                        <h2 class="text-lg font-extrabold text-gray-800 mb-1 border-l-4 border-black pl-2">
                            Attendant
                        </h2>
                    </div>

                    <div v-for="(attendant, index) in application.attendant_details" :key="index">


                        <div>
                            <label for="service" class="block font-semibold text-sm leading-5 mb-1 text-black">Service</label>
                            <select
                                v-model="attendant.service"
                                id="applicant"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            >
                                <option disabled>Select Service</option>
                                <option value="Govt">Govt</option>
                                <option value="Non-Govt">Non-Govt</option>
                            </select>
                            <span v-if="errors[`attendant.${index}.service`]" class="text-red-500 text-sm">
                                  {{ errors[`attendant.${index}.service`] }}
                            </span>
                        </div>

                        <div>
                            <label for="applicant" class="block font-semibold text-sm leading-5 mb-1 text-black">Applicant Name</label>
                            <input
                                v-model="attendant.name"
                                id="applicant"
                                type="text"
                                placeholder="Diltu Hming"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`attendant.${index}.name`]" class="text-red-500 text-sm">
                                  {{ errors[`attendant.${index}.name`] }}
                            </span>
                        </div>

                        <div>
                            <label for="gender" class="block font-semibold text-sm leading-5 mb-1 text-black">Gender</label>
                            <select
                                v-model="attendant.gender"
                                id="gender"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
                            >
                                <option disabled selected>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                            <span v-if="errors[`attendant.${index}.attendant`]" class="text-red-500 text-sm">
                                  {{ errors[`attendant.${index}.attendant`] }}
                            </span>
                        </div>

                        <div v-if="attendant.service && attendant.service === 'Govt'">
                            <label for="department" class="block font-semibold text-sm leading-5 mb-1 text-black">Department</label>
                            <input
                                v-model="attendant.department"
                                id="designation"
                                type="text"
                                placeholder="Diltu Department"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`attendant.${index}.department`]" class="text-red-500 text-sm">
                                  {{ errors[`attendant.${index}.department`] }}
                            </span>
                        </div>

                        <div v-if="attendant.service && attendant.service === 'Govt'">
                            <label for="designation" class="block font-semibold text-sm leading-5 mb-1 text-black">Designation</label>
                            <input
                                v-model="attendant.designation"
                                id="designation"
                                type="text"
                                placeholder="Diltu Hnathawh"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`attendant.${index}.designation`]" class="text-red-500 text-sm">
                                  {{ errors[`attendant.${index}.designation`] }}
                            </span>
                        </div>



                        <div>
                            <label for="contact" class="block font-semibold text-sm leading-5 mb-1 text-black">Contact Number</label>
                            <input
                                v-model="attendant.contact"
                                id="contact"
                                type="tel"
                                placeholder="Phone Number"
                                class="w-full rounded-md border border-gray-300 text-gray-800 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`attendant.${index}.contact`]" class="text-red-500 text-sm">
                                  {{ errors[`attendant.${index}.contact`] }}
                            </span>
                        </div>
                        <button @click.prevent="application.removeAttendant(index)">Remove</button>





                    </div>


                    <div class="flex justify-between mt-4">
                        <button
                            @click.prevent="application.addPatient()"
                            type="button"
                            class="flex items-center gap-2 text-black text-base font-semibold leading-6"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22.5C6.21 22.5 1.5 17.79 1.5 12C1.5 6.21 6.21 1.5 12 1.5C17.79 1.5 22.5 6.21 22.5 12C22.5 17.79 17.79 22.5 12 22.5ZM12 3C7.035 3 3 7.035 3 12C3 16.965 7.035 21 12 21C16.965 21 21 16.965 21 12C21 7.035 16.965 3 12 3Z" fill="black"/>
                                <path d="M12 17.25C11.58 17.25 11.25 16.92 11.25 16.5V7.5C11.25 7.08 11.58 6.75 12 6.75C12.42 6.75 12.75 7.08 12.75 7.5V16.5C12.75 16.92 12.42 17.25 12 17.25Z" fill="black"/>
                                <path d="M16.5 12.75H7.5C7.08 12.75 6.75 12.42 6.75 12C6.75 11.58 7.08 11.25 7.5 11.25H16.5C16.92 11.25 17.25 11.58 17.25 12C17.25 12.42 16.92 12.75 16.5 12.75Z" fill="black"/>
                            </svg>

                            Add Patient
                        </button>
                        <button
                            @click.prevent="application.addAttendant()"
                            type="button"
                            class="flex items-center gap-2 text-black text-base font-semibold leading-6"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22.5C6.21 22.5 1.5 17.79 1.5 12C1.5 6.21 6.21 1.5 12 1.5C17.79 1.5 22.5 6.21 22.5 12C22.5 17.79 17.79 22.5 12 22.5ZM12 3C7.035 3 3 7.035 3 12C3 16.965 7.035 21 12 21C16.965 21 21 16.965 21 12C21 7.035 16.965 3 12 3Z" fill="black"/>
                                <path d="M12 17.25C11.58 17.25 11.25 16.92 11.25 16.5V7.5C11.25 7.08 11.58 6.75 12 6.75C12.42 6.75 12.75 7.08 12.75 7.5V16.5C12.75 16.92 12.42 17.25 12 17.25Z" fill="black"/>
                                <path d="M16.5 12.75H7.5C7.08 12.75 6.75 12.42 6.75 12C6.75 11.58 7.08 11.25 7.5 11.25H16.5C16.92 11.25 17.25 11.58 17.25 12C17.25 12.42 16.92 12.75 16.5 12.75Z" fill="black"/>
                            </svg>

                            Add Attendant
                        </button>
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

import { ref} from 'vue';
import {useMedicalApplicationStore} from "@/Store/useMedicalApplicationStore.js";

import {Head, router} from '@inertiajs/vue3'

const application = useMedicalApplicationStore()


const showError = ref(false)

const errors = ref({})
function validateForm() {
    errors.value = {}

    // Simple fields
    const requiredFields = ['type', 'status', 'applicant_name', 'gender', 'contact']
    requiredFields.forEach(field => {
        if (!application[field] || typeof application[field] !== 'string') {
            errors.value[field] = `${field.replace('_', ' ')} is required.`
        }
    })

    // Contact number (main applicant)
    if (application.contact && !/^\d{10}$/.test(application.contact)) {
        errors.value['contact'] = 'Contact must be a 10-digit number.'
    }


    // flam_details validation
    // if (application.flam_details?.length) {
    //     application.flam_details.forEach((flam, index) => {
    //         if (!flam.flam_name) {
    //             errors.value[`flam_details.${index}.flam_name`] = 'FLAM name is required.'
    //         }
    //         if (!flam.gender) {
    //             errors.value[`flam_details.${index}.gender`] = 'FLAM gender is required.'
    //         }
    //         if (!flam.designation) {
    //             errors.value[`flam_details.${index}.designation`] = 'FLAM designation is required.'
    //         }
    //         if (!flam.contact) {
    //             errors.value[`flam_details.${index}.contact`] = 'Contact is required.'
    //         } else if (!/^\d{10}$/.test(flam.contact)) {
    //             errors.value[`flam_details.${index}.contact`] = 'Contact must be a 10-digit number.'
    //         }
    //     })
    // }
    //
    // // family_details validation
    // if (application.family_details?.length) {
    //     application.family_details.forEach((fam, index) => {
    //         if (!fam.name) {
    //             errors.value[`family_details.${index}.name`] = 'Family name is required.'
    //         }
    //         if (!fam.relation) {
    //             errors.value[`family_details.${index}.relation`] = 'Family relation is required.'
    //         }
    //     })
    // }
    return Object.keys(errors.value).length === 0
}

function next() {
    if (!validateForm()) {
        showError.value = true;
        return;
    }
    router.visit(route('apply.medical.step-three'))
}

function back() {
    router.visit('/apply/step-one')
}
</script>


<style scoped>
</style>
