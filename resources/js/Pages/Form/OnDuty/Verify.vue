<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import {onMounted, ref} from "vue";

import { useOnDutyApplicationStore } from '@/Store/useOnDutyApplicationStore.js'
import {router, useForm} from "@inertiajs/vue3";

const application = useOnDutyApplicationStore()

const form = useForm({
    ...application.$state,
    otp: '',
})



const digits = ref(['', '', '', '']);
const combineOtp = () => {
    form.otp = digits.value.join('');
};

const showError = ref(false)
const errorMessage = ref('')


const resendDisabled = ref(true);
const timer = ref(120);

const startTimer = () => {
    timer.value = 120;
    resendDisabled.value = true;
    const interval = setInterval(() => {
        if (--timer.value <= 0) {
            resendDisabled.value = false;
            clearInterval(interval);
        }
    }, 1000);
};


onMounted(() => {
    startTimer();
});
function submit() {
    form.post(route('apply.on-duty.submit'), {
        onSuccess: () => {
            application.reset()
        },
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
        },
    })
}

function resendOtp(){
    router.get(route('apply.on_duty.verify'), {
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
        },
        onSuccess: (response) => {
            startTimer();
        },
    })
}
</script>

<template>

    <div class="min-h-screen flex flex-col">
        <Header/>

        <div
            v-if="showError"
            class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white p-4 rounded-lg shadow-lg w-[90%] max-w-md z-50"
        >
            <div class="flex justify-between items-start">
                <div>
                    <b class="block">Please correct the following error(s):</b>
                    {{ errorMessage }}
                </div>
                <button @click="showError = false" class="ml-4 text-white font-bold text-xl leading-none">&times;</button>
            </div>
        </div>

        <div class="flex-grow flex flex-col items-center bg-background mt-4">
            <div class="max-w-md w-full">
                <div class="bg-white border border-gray-300 rounded-xl p-8">
                    <h2 class="text-gray-900 font-semibold text-xl mb-2">Enter OTP to verify</h2>
                    <p class="text-gray-500 text-sm mb-6">
                        An OTP has been sent to {{ application.contact }}
                        <span @click="$inertia.get(route('apply.on_duty.step-two'))" class="text-green-600 cursor-pointer">(Edit)</span>
                    </p>
                    <div class="flex justify-center space-x-4 mb-6">
                        <input
                            v-for="(digit, index) in digits"
                            :key="index"
                            v-model="digits[index]"
                            type="text"
                            maxlength="1"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            class="w-12 h-12 border border-gray-300 rounded-lg text-center text-lg font-normal text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-600"
                            @input="combineOtp"
                        />

                    </div>
                    <div class="flex justify-between text-sm text-gray-700">
                        <p>
                            Did not get the OTP?
                            <span
                                :class="{'text-gray-400 cursor-not-allowed': resendDisabled, 'text-blue-600 cursor-pointer': !resendDisabled}"
                                @click="!resendDisabled && resendOtp()">
                            Resend</span>
                        </p>
                        <p>{{ Math.floor(timer / 60) }}:{{ (timer % 60).toString().padStart(2, '0') }}</p>
                    </div>
                </div>
                <button
                    @click="submit"
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


