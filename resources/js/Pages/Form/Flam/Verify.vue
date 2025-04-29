<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";


import { useFlamApplicationStore } from '@/Store/useFlamApplicationStore.js'
import {useForm} from "@inertiajs/vue3";

const application = useFlamApplicationStore()

const form = useForm({
    ...application.$state,
    otp: '',
})


</script>

<template>

    <div class="min-h-screen flex flex-col">
        <Header/>
        <div class="flex-grow flex flex-col items-center bg-background mt-4">
            <div class="max-w-md w-full">
            <div class="bg-white border border-gray-300 rounded-xl p-8">
                <h2 class="text-gray-900 font-semibold text-xl mb-2">Enter OTP to verify</h2>
                <p class="text-gray-500 text-sm mb-6">
                    An OTP has been sent to {{ application.contact }}
                    <span class="text-green-600 cursor-pointer">(Edit)</span>
                </p>
                <div class="flex justify-center space-x-4 mb-6">
                    <input
                        type="text"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        class="w-12 h-12 border border-gray-300 rounded-lg text-center text-lg font-normal text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-600"
                        autofocus
                    />
                    <input
                        type="text"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        class="w-12 h-12 border border-gray-300 rounded-lg text-center text-lg font-normal text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-600"
                    />
                    <input
                        type="text"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        class="w-12 h-12 border border-gray-300 rounded-lg text-center text-lg font-normal text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-600"
                    />
                    <input
                        type="text"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        class="w-12 h-12 border border-gray-300 rounded-lg text-center text-lg font-normal text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-600"
                    />
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <p>
                        Did not get the OTP?
                        <span class="text-gray-400 cursor-default select-none">Resend</span>
                    </p>
                    <p>2:00</p>
                </div>
            </div>
            <button
                type="submit"
                class="mt-6 w-full bg-black text-white py-3 rounded-lg text-center text-base font-normal "
            >
                Verify
            </button>
        </div>
        </div>
        <Footer/>

    </div>



</template>

<style scoped>

</style>


