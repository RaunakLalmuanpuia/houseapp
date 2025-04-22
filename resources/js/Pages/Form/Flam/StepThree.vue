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
const form = useForm({
    ...application.$state,
})
const showError = ref(false)

watch(
    () => page.props.errors,
    (errors) => {
        showError.value = Object.keys(errors).length > 0
    },
    { immediate: true }
)


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


            <div class="p-6 bg-card rounded-lg shadow-md w-full">
                <h2 class="text-lg font-semibold">Kal Duhna Hmun</h2>
                <p class="text-muted-foreground">Mizoram House Kal duhna</p>
                <select v-model="form.location" required class="mt-2 w-full border border-border rounded-md p-2">
                    <option value="">Select</option>
                    <option value="Aizawl">Aizawl</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Guwahati">Guwahati</option>
                </select>

                <h3 class="mt-6 text-lg font-semibold">Period</h3>
                <label class="block mt-4">Arrival/Thlen ni</label>
                <input v-model="form.start_date" required type="date" class="mt-1 w-full border border-border rounded-md p-2" />

                <label class="block mt-4">Departure/Chhuah ni</label>
                <input v-model="form.end_date" required type="date" class="mt-1 w-full border border-border rounded-md p-2" />

                <div class="flex items-center mt-4">
                <span class="text-muted-foreground">
                I understand that all reservations are subject to seat availability, and GAD holds no responsibility if accommodation is denied due to a lack of available rooms.
                </span>
                </div>

                <div class="mt-6 flex justify-between">
                    <button @click="back" class="border border-border text-primary p-2 rounded-md">Back</button>
                    <!--                <button @click="$inertia.get(route('verify', { id: application.id }))" class="bg-primary text-primary-foreground p-2 rounded-md">Submit</button>-->
                    <button @click="submit" class="bg-primary text-primary-foreground p-2 rounded-md">Submit</button>
                </div>
            </div>
        </div>
        <Footer/>

    </div>

</template>

<style scoped>
</style>
