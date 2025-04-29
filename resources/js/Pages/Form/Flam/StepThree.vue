<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import DestinationStep from "@/Components/Common/DestinationStep.vue";
import {usePage} from "@inertiajs/vue3";
import {watch, ref} from "vue";
import { useFlamApplicationStore } from '@/Store/useFlamApplicationStore.js'
import { useForm, router } from '@inertiajs/vue3'

const application = useFlamApplicationStore()

const page = usePage()

const showError = ref(false)

watch(
    () => page.props.errors,
    (errors) => {
        showError.value = Object.keys(errors).length > 0
    },
    { immediate: true }
)

function next() {
    router.visit(route('apply.flam.verify'))
}

function submit() {
    form.post(route('apply.flam.submit'), {
        onSuccess: () => {
            application.reset()
        },
    })
}
function back() {
    router.visit(route('apply.flam.step-two'))
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
                    </div>

                    <div class="flex items-start space-x-3 pb-6 text-gray-600 text-sm font-semibold leading-relaxed">
                        <input
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

<!--            <div class="p-6 bg-card rounded-lg shadow-md w-full">-->
<!--                <h2 class="text-lg font-semibold">Kal Duhna Hmun</h2>-->
<!--                <p class="text-muted-foreground">Mizoram House Kal duhna</p>-->
<!--                <select v-model="form.location" required class="mt-2 w-full border border-border rounded-md p-2">-->
<!--                    <option value="">Select</option>-->
<!--                    <option value="Aizawl">Aizawl</option>-->
<!--                    <option value="Delhi">Delhi</option>-->
<!--                    <option value="Guwahati">Guwahati</option>-->
<!--                </select>-->

<!--                <h3 class="mt-6 text-lg font-semibold">Period</h3>-->
<!--                <label class="block mt-4">Arrival/Thlen ni</label>-->
<!--                <input v-model="form.start_date" required type="date" class="mt-1 w-full border border-border rounded-md p-2" />-->

<!--                <label class="block mt-4">Departure/Chhuah ni</label>-->
<!--                <input v-model="form.end_date" required type="date" class="mt-1 w-full border border-border rounded-md p-2" />-->

<!--                <div class="flex items-center mt-4">-->
<!--                <span class="text-muted-foreground">-->
<!--                I understand that all reservations are subject to seat availability, and GAD holds no responsibility if accommodation is denied due to a lack of available rooms.-->
<!--                </span>-->
<!--                </div>-->

<!--                <div class="mt-6 flex justify-between">-->
<!--                    <button @click="back" class="border border-border text-primary p-2 rounded-md">Back</button>-->
<!--                    &lt;!&ndash;                <button @click="$inertia.get(route('verify', { id: application.id }))" class="bg-primary text-primary-foreground p-2 rounded-md">Submit</button>&ndash;&gt;-->
<!--                    <button @click="submit" class="bg-primary text-primary-foreground p-2 rounded-md">Submit</button>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <Footer/>

    </div>

</template>

<style scoped>
</style>


