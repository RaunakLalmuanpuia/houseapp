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
                            <li v-for="(message, field) in errors" :key="field">
                                {{ message }}
                            </li>
                        </ul>
                    </div>
                    <button @click="showError = false" class="ml-4 text-white font-bold text-xl leading-none">&times;</button>
                </div>
            </div>


            <div class="max-w-md w-full rounded-xl border border-gray-200 overflow-hidden">
                <header class="bg-[#FFF6E0] p-6 rounded-t-xl">
                    <h1 class="text-[#FF8C00] font-extrabold text-xl leading-6">Private</h1>
                    <p class="text-[#FF8C00] font-semibold text-sm leading-5 mt-1">Non-official personal stay</p>
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
                            class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['applicant_name']" class="text-red-500 text-sm">{{ errors['applicant_name'] }}</span>
                        <p class="text-gray-400 text-xs leading-4 mt-1 flex items-center gap-1">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.3335 10.3333H7.66683V6.33333H6.3335V10.3333ZM7.00016 4.99999C7.18905 4.99999 7.3475 4.93599 7.4755 4.80799C7.60305 4.68044 7.66683 4.52222 7.66683 4.33333C7.66683 4.14444 7.60305 3.98599 7.4755 3.85799C7.3475 3.73044 7.18905 3.66666 7.00016 3.66666C6.81127 3.66666 6.65305 3.73044 6.5255 3.85799C6.3975 3.98599 6.3335 4.14444 6.3335 4.33333C6.3335 4.52222 6.3975 4.68044 6.5255 4.80799C6.65305 4.93599 6.81127 4.99999 7.00016 4.99999ZM7.00016 13.6667C6.07794 13.6667 5.21127 13.4915 4.40016 13.1413C3.58905 12.7915 2.8835 12.3167 2.2835 11.7167C1.6835 11.1167 1.20861 10.4111 0.858829 9.59999C0.508607 8.78888 0.333496 7.92222 0.333496 6.99999C0.333496 6.07777 0.508607 5.21111 0.858829 4.39999C1.20861 3.58888 1.6835 2.88333 2.2835 2.28333C2.8835 1.68333 3.58905 1.20822 4.40016 0.857995C5.21127 0.508217 6.07794 0.333328 7.00016 0.333328C7.92238 0.333328 8.78905 0.508217 9.60016 0.857995C10.4113 1.20822 11.1168 1.68333 11.7168 2.28333C12.3168 2.88333 12.7917 3.58888 13.1415 4.39999C13.4917 5.21111 13.6668 6.07777 13.6668 6.99999C13.6668 7.92222 13.4917 8.78888 13.1415 9.59999C12.7917 10.4111 12.3168 11.1167 11.7168 11.7167C11.1168 12.3167 10.4113 12.7915 9.60016 13.1413C8.78905 13.4915 7.92238 13.6667 7.00016 13.6667ZM7.00016 12.3333C8.48905 12.3333 9.75016 11.8167 10.7835 10.7833C11.8168 9.74999 12.3335 8.48888 12.3335 6.99999C12.3335 5.51111 11.8168 4.24999 10.7835 3.21666C9.75016 2.18333 8.48905 1.66666 7.00016 1.66666C5.51127 1.66666 4.25016 2.18333 3.21683 3.21666C2.1835 4.24999 1.66683 5.51111 1.66683 6.99999C1.66683 8.48888 2.1835 9.74999 3.21683 10.7833C4.25016 11.8167 5.51127 12.3333 7.00016 12.3333Z" fill="#94979E"/>
                            </svg>
                            Must be Government Official
                        </p>
                    </div>

                    <div>
                        <label for="gender" class="block font-semibold text-sm leading-5 mb-1 text-black">Gender</label>
                        <select
                            v-model="application.gender"
                            id="gender"
                            class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
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
                            class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors['contact']" class="text-red-500 text-sm">{{ errors['contact'] }}</span>
                    </div>



                    <div v-if="application.non_official_details && application.non_official_details.length > 0">
                        <h2 class="font-bold text-lg leading-6 border-l-4 border-black pl-2">Non Official</h2>
                    </div>

                    <div v-for="(non_official, index) in application.non_official_details" :key="index">

                        <p class="text-muted-foreground text-s py-2">Other Officials</p>

                        <div>
                            <label for="applicant" class="block font-semibold text-sm leading-5 mb-1 text-black">Applicant Name</label>
                            <input
                                v-model="non_official.name"
                                id="applicant"
                                type="text"
                                placeholder="Diltu Hming"
                                class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`non_official_details.${index}.name`]" class="text-red-500 text-sm">
                                  {{ errors[`non_official_details.${index}.name`] }}
                            </span>
<!--                            <p class="text-gray-400 text-xs leading-4 mt-1 flex items-center gap-1">-->
<!--                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                    <path d="M6.3335 10.3333H7.66683V6.33333H6.3335V10.3333ZM7.00016 4.99999C7.18905 4.99999 7.3475 4.93599 7.4755 4.80799C7.60305 4.68044 7.66683 4.52222 7.66683 4.33333C7.66683 4.14444 7.60305 3.98599 7.4755 3.85799C7.3475 3.73044 7.18905 3.66666 7.00016 3.66666C6.81127 3.66666 6.65305 3.73044 6.5255 3.85799C6.3975 3.98599 6.3335 4.14444 6.3335 4.33333C6.3335 4.52222 6.3975 4.68044 6.5255 4.80799C6.65305 4.93599 6.81127 4.99999 7.00016 4.99999ZM7.00016 13.6667C6.07794 13.6667 5.21127 13.4915 4.40016 13.1413C3.58905 12.7915 2.8835 12.3167 2.2835 11.7167C1.6835 11.1167 1.20861 10.4111 0.858829 9.59999C0.508607 8.78888 0.333496 7.92222 0.333496 6.99999C0.333496 6.07777 0.508607 5.21111 0.858829 4.39999C1.20861 3.58888 1.6835 2.88333 2.2835 2.28333C2.8835 1.68333 3.58905 1.20822 4.40016 0.857995C5.21127 0.508217 6.07794 0.333328 7.00016 0.333328C7.92238 0.333328 8.78905 0.508217 9.60016 0.857995C10.4113 1.20822 11.1168 1.68333 11.7168 2.28333C12.3168 2.88333 12.7917 3.58888 13.1415 4.39999C13.4917 5.21111 13.6668 6.07777 13.6668 6.99999C13.6668 7.92222 13.4917 8.78888 13.1415 9.59999C12.7917 10.4111 12.3168 11.1167 11.7168 11.7167C11.1168 12.3167 10.4113 12.7915 9.60016 13.1413C8.78905 13.4915 7.92238 13.6667 7.00016 13.6667ZM7.00016 12.3333C8.48905 12.3333 9.75016 11.8167 10.7835 10.7833C11.8168 9.74999 12.3335 8.48888 12.3335 6.99999C12.3335 5.51111 11.8168 4.24999 10.7835 3.21666C9.75016 2.18333 8.48905 1.66666 7.00016 1.66666C5.51127 1.66666 4.25016 2.18333 3.21683 3.21666C2.1835 4.24999 1.66683 5.51111 1.66683 6.99999C1.66683 8.48888 2.1835 9.74999 3.21683 10.7833C4.25016 11.8167 5.51127 12.3333 7.00016 12.3333Z" fill="#94979E"/>-->
<!--                                </svg>-->
<!--                                Must be Government Official-->
<!--                            </p>-->
                        </div>

                        <div>
                            <label for="gender" class="block font-semibold text-sm leading-5 mb-1 text-black">Gender</label>
                            <select
                                v-model="non_official.gender"
                                id="gender"
                                class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
                            >
                                <option disabled selected>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                            <span v-if="errors[`non_official_details.${index}.gender`]" class="text-red-500 text-sm">
                                  {{ errors[`non_official_details.${index}.gender`] }}
                            </span>
                        </div>




                        <div>
                            <label for="contact" class="block font-semibold text-sm leading-5 mb-1 text-black">Contact Number</label>
                            <input
                                v-model="non_official.contact"
                                id="contact"
                                type="tel"
                                placeholder="Phone Number"
                                class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`non_official_details.${index}.contact`]" class="text-red-500 text-sm">
                                  {{ errors[`non_official_details.${index}.contact`] }}
                            </span>
                        </div>



                        <button @click.prevent="application.removeNonOfficial(index)">Remove</button>
                    </div>


                    <div v-if="application.family_details && application.family_details.length > 0">
                        <h2 class="text-lg font-extrabold text-gray-900 mb-1 border-l-4 border-black pl-2">
                            Family Member
                        </h2>
                    </div>

                    <div v-for="(family, index) in application.family_details" :key="index">

                        <p class="text-gray-400 text-sm mb-4 flex items-center gap-1">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.3335 10.3333H7.66683V6.33333H6.3335V10.3333ZM7.00016 4.99999C7.18905 4.99999 7.3475 4.93599 7.4755 4.80799C7.60305 4.68044 7.66683 4.52222 7.66683 4.33333C7.66683 4.14444 7.60305 3.98599 7.4755 3.85799C7.3475 3.73044 7.18905 3.66666 7.00016 3.66666C6.81127 3.66666 6.65305 3.73044 6.5255 3.85799C6.3975 3.98599 6.3335 4.14444 6.3335 4.33333C6.3335 4.52222 6.3975 4.68044 6.5255 4.80799C6.65305 4.93599 6.81127 4.99999 7.00016 4.99999ZM7.00016 13.6667C6.07794 13.6667 5.21127 13.4915 4.40016 13.1413C3.58905 12.7915 2.8835 12.3167 2.2835 11.7167C1.6835 11.1167 1.20861 10.4111 0.858829 9.59999C0.508607 8.78888 0.333496 7.92222 0.333496 6.99999C0.333496 6.07777 0.508607 5.21111 0.858829 4.39999C1.20861 3.58888 1.6835 2.88333 2.2835 2.28333C2.8835 1.68333 3.58905 1.20822 4.40016 0.857995C5.21127 0.508217 6.07794 0.333328 7.00016 0.333328C7.92238 0.333328 8.78905 0.508217 9.60016 0.857995C10.4113 1.20822 11.1168 1.68333 11.7168 2.28333C12.3168 2.88333 12.7917 3.58888 13.1415 4.39999C13.4917 5.21111 13.6668 6.07777 13.6668 6.99999C13.6668 7.92222 13.4917 8.78888 13.1415 9.59999C12.7917 10.4111 12.3168 11.1167 11.7168 11.7167C11.1168 12.3167 10.4113 12.7915 9.60016 13.1413C8.78905 13.4915 7.92238 13.6667 7.00016 13.6667ZM7.00016 12.3333C8.48905 12.3333 9.75016 11.8167 10.7835 10.7833C11.8168 9.74999 12.3335 8.48888 12.3335 6.99999C12.3335 5.51111 11.8168 4.24999 10.7835 3.21666C9.75016 2.18333 8.48905 1.66666 7.00016 1.66666C5.51127 1.66666 4.25016 2.18333 3.21683 3.21666C2.1835 4.24999 1.66683 5.51111 1.66683 6.99999C1.66683 8.48888 2.1835 9.74999 3.21683 10.7833C4.25016 11.8167 5.51127 12.3333 7.00016 12.3333Z" fill="#94979E"/>
                            </svg> Must be family of {{application.applicant_name }}
                        </p>

                        <div>
                            <label for="familyName" class="block text-gray-900 font-semibold mb-1"
                            >Name</label
                            >
                            <input
                                v-model="family.name"
                                id="familyName"
                                name="familyName"
                                type="text"
                                placeholder="Hming"
                                class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            />
                            <span v-if="errors[`family_details.${index}.name`]" class="text-red-500 text-sm">
                                  {{ errors[`family_details.${index}.name`] }}
                            </span>

                        </div>

                        <div>
                            <label
                                for="relationship"
                                class="block text-gray-900 font-semibold mt-6 mb-1"
                            >Relationship</label
                            >
                            <select
                                v-model="family.relation"
                                id="relationship"
                                name="relationship"
                                class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
                            >
                                <option>Wife</option>
                                <option>Husband</option>
                                <option>Child</option>
                                <option>Other</option>
                            </select>

                            <span v-if="errors[`family_details.${index}.relation`]" class="text-red-500 text-sm">
                                  {{ errors[`family_details.${index}.relation`] }}
                            </span>
                        </div>
                        <button @click.prevent="application.removeFamilyMember(index)">Remove</button>

                    </div>


                    <div class="flex justify-between mt-4">
                        <button
                            @click.prevent="application.addNonOfficial()"
                            type="button"
                            class="flex items-center gap-2 text-black text-base font-semibold leading-6"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22.5C6.21 22.5 1.5 17.79 1.5 12C1.5 6.21 6.21 1.5 12 1.5C17.79 1.5 22.5 6.21 22.5 12C22.5 17.79 17.79 22.5 12 22.5ZM12 3C7.035 3 3 7.035 3 12C3 16.965 7.035 21 12 21C16.965 21 21 16.965 21 12C21 7.035 16.965 3 12 3Z" fill="black"/>
                                <path d="M12 17.25C11.58 17.25 11.25 16.92 11.25 16.5V7.5C11.25 7.08 11.58 6.75 12 6.75C12.42 6.75 12.75 7.08 12.75 7.5V16.5C12.75 16.92 12.42 17.25 12 17.25Z" fill="black"/>
                                <path d="M16.5 12.75H7.5C7.08 12.75 6.75 12.42 6.75 12C6.75 11.58 7.08 11.25 7.5 11.25H16.5C16.92 11.25 17.25 11.58 17.25 12C17.25 12.42 16.92 12.75 16.5 12.75Z" fill="black"/>
                            </svg>

                            Add Others
                        </button>
                        <button
                            @click.prevent="application.addFamilyMember()"
                            type="button"
                            class="flex items-center gap-2 text-black text-base font-semibold leading-6"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22.5C6.21 22.5 1.5 17.79 1.5 12C1.5 6.21 6.21 1.5 12 1.5C17.79 1.5 22.5 6.21 22.5 12C22.5 17.79 17.79 22.5 12 22.5ZM12 3C7.035 3 3 7.035 3 12C3 16.965 7.035 21 12 21C16.965 21 21 16.965 21 12C21 7.035 16.965 3 12 3Z" fill="black"/>
                                <path d="M12 17.25C11.58 17.25 11.25 16.92 11.25 16.5V7.5C11.25 7.08 11.58 6.75 12 6.75C12.42 6.75 12.75 7.08 12.75 7.5V16.5C12.75 16.92 12.42 17.25 12 17.25Z" fill="black"/>
                                <path d="M16.5 12.75H7.5C7.08 12.75 6.75 12.42 6.75 12C6.75 11.58 7.08 11.25 7.5 11.25H16.5C16.92 11.25 17.25 11.58 17.25 12C17.25 12.42 16.92 12.75 16.5 12.75Z" fill="black"/>
                            </svg>

                            Add Family
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

import { useNonOfficialApplicationStore } from '@/Store/useNonOfficialApplicationStore.js'
import {router, usePage} from '@inertiajs/vue3'
import {ref, watch} from "vue";

const page = usePage()
const application = useNonOfficialApplicationStore()


const errors = ref({})
const showError = ref(false)
function validateForm() {
    errors.value = {}

    // Simple fields
    const requiredFields = [
        'type', 'status', 'applicant_name', 'gender', 'contact',
    ]
    requiredFields.forEach(field => {
        if (!application[field] || typeof application[field] !== 'string') {
            errors.value[field] = `${field.replace('_', ' ')} is required.`
        }
    })

    // Gender specific values
    const allowedGenders = ['Male', 'Female', 'Other']
    if (application.gender && !allowedGenders.includes(application.gender)) {
        errors.value['gender'] = 'Gender must be Male, Female, or Other.'
    }
    // Contact number (main applicant)
    if (application.contact && !/^\d{10}$/.test(application.contact)) {
        errors.value['contact'] = 'Contact must be a 10-digit number.'
    }

    // on_duty_details validation
    if (application.non_official_details?.length) {
        application.non_official_details.forEach((item, index) => {
            if (!item.name) {
                errors.value[`non_official_details.${index}.name`] = 'Person Name is required.'
            }
            if (!item.gender || !allowedGenders.includes(item.gender)) {
                errors.value[`non_official_details.${index}.gender`] = 'Valid gender is required.'
            }
            if (!item.contact) {
                errors.value[`non_official_details.${index}.contact`] = 'Contact is required.'
            } else if (!/^\d{10}$/.test(item.contact)) {
                errors.value[`non_official_details.${index}.contact`] = 'Contact must be a 10-digit number.'
            }
        })
    }

    // family_details validation
    if (application.family_details?.length) {
        application.family_details.forEach((fam, index) => {
            if (!fam.name) {
                errors.value[`family_details.${index}.name`] = 'Family member name is required.'
            }
            if (!fam.relation) {
                errors.value[`family_details.${index}.relation`] = 'Family relation is required.'
            }
        })
    }

    return Object.keys(errors.value).length === 0
}


function next() {
    if (!validateForm()) {
        showError.value = true;
        return;
    }
    router.visit(route('apply.non-official.step-three'))
}



function back() {
    router.visit('/apply/step-one')
}


</script>
