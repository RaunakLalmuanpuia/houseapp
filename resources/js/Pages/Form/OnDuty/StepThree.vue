<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import DestinationStep from "@/Components/Common/DestinationStep.vue";


import { useOnDutyApplicationStore } from '@/Store/useOnDutyApplicationStore.js'
import {useForm, router, usePage} from '@inertiajs/vue3'
import {ref, watch} from "vue";

const application = useOnDutyApplicationStore()


const page = usePage()

const showError = ref(false)
const errorMessage = ref('')


const errors = ref({})
const agreement = ref(false)


function validateForm() {
    errors.value = {}

    if (!application.location || typeof application.location !== 'string') {
        errors.value.location = 'Location is required.'
    }

    if (!application.start_date) {
        errors.value.start_date = 'Start date is required.'
    } else if (isNaN(Date.parse(application.start_date))) {
        errors.value.start_date = 'Start date must be a valid date.'
    }

    if (!application.end_date) {
        errors.value.end_date = 'End date is required.'
    } else if (isNaN(Date.parse(application.end_date))) {
        errors.value.end_date = 'End date must be a valid date.'
    } else if (new Date(application.end_date) < new Date(application.start_date)) {
        errors.value.end_date = 'End date cannot be before start date.'
    }

    if (!agreement.value) {
        errors.value.agreement = 'You must agree to the terms.'
    }

    return Object.keys(errors.value).length === 0
}

function next() {
    if (!validateForm()) {
        showError.value = true
        return
    }
    router.get(route('apply.on-duty.verify'), {
        contact: application.contact,
        type: application.type,
    }, {
        preserveState: true,
        replace: true,
        onError: (errors) => {
            showError.value = true
            if (errors) {
                if (typeof errors === 'string') {
                    errorMessage.value = errors
                } else if (typeof errors === 'object') {
                    const firstError = Object.values(errors)[0]
                    if (Array.isArray(firstError)) {
                        errorMessage.value = firstError[0]
                    } else {
                        errorMessage.value = firstError
                    }
                } else {
                    errorMessage.value = 'An unexpected error occurred.'
                }
            }
        }
    })
}

function back() {
    router.visit(route('apply.on-duty.step-two'))
}

</script>

<template>
    <div class="min-h-screen flex flex-col">

        <Header/>

        <div class="flex-grow flex flex-col items-center w-[400px] p-3 mx-auto">
            <DestinationStep class="w-full" />

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


            <div class="max-w-md w-full rounded-xl border border-gray-200 overflow-hidden">
                <div class="bg-white p-6 space-y-6">
                    <h2 class="font-bold text-lg leading-6 border-l-4 border-black pl-2">Kal Duhna Hmun</h2>

                    <div>
                        <label for="applicant" class="block font-semibold text-sm leading-5 mb-1 text-black">Mizoram House Kal duhna</label>
                        <select
                            v-model="application.location"
                            id="gender"
                            class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black appearance-none"
                        >
                            <option disabled selected>Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                        <span v-if="errors.location" class="text-red-500 text-sm mt-1 block">{{ errors.location }}</span>
                    </div>
                    <h2 class="font-bold text-lg leading-6 border-l-4 border-black pl-2">Period</h2>
                    <div>
                        <label for="start_date" class="block font-semibold text-sm leading-5 mb-1 text-black">Arrival/Thlen ni</label>
                        <input
                            v-model="application.start_date" required
                            id="designation"
                            type="date"
                            placeholder="Ni leh thla thlanna"
                            class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors.start_date" class="text-red-500 text-sm mt-1 block">{{ errors.start_date }}</span>
                    </div>

                    <div>
                        <label for="end_date" class="block font-semibold text-sm leading-5 mb-1 text-black">Departure/Chhuah ni</label>
                        <input
                            v-model="application.end_date" required
                            id="designation"
                            type="date"
                            placeholder="Ni leh thla thlanna"
                            class="w-full rounded-md border border-gray-300 text-gray-400 placeholder-gray-400 px-4 py-2 text-base leading-6 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        />
                        <span v-if="errors.end_date" class="text-red-500 text-sm mt-1 block">{{ errors.end_date }}</span>
                    </div>

                    <div class="flex items-start space-x-3 pb-6 text-gray-600 text-sm font-semibold leading-relaxed">
                        <input
                            v-model="agreement"
                            type="checkbox"
                            id="agreement"
                            name="agreement"
                            class="mt-1 w-4 h-4 border border-gray-400 rounded-sm text-black focus:ring-0"
                            aria-describedby="agreement-desc"
                        />
                        <label for="agreement" id="agreement-desc" class="block max-w-prose">
                            I understand that all reservations are subject to seat availability, and GAD holds no
                            responsibility if accommodation is denied due to a lack of available rooms.
                        </label>

                    </div>
                    <span v-if="errors.agreement" class="text-red-500 text-sm  block">{{ errors.agreement }}</span>


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
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <Footer/>

    </div>

</template>

<style scoped>
</style>
