<template>
    <Head title="Login" />
    <Header />


    <div class=" flex justify-center items-start mt-12">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-3xl">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/2 flex flex-col items-start justify-center space-y-6">
                    <div v-if="$page.props.auth?.user">
                        <p class="text-gray-800">You are logged in</p>
                        <button
                            @click="$inertia.get(route('dashboard'))"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Go to dashboard
                        </button>
                    </div>

                    <div>
                        <p class="text-2xl font-bold text-gray-900 mb-4">Forgot Password</p>

                        <!-- Step 1 -->
                        <div v-show="step === 1" class="space-y-4">
                            <p class="text-gray-600 text-sm">Enter your registered mobile no</p>
                            <input
                                v-model="form.userId"
                                type="text"
                                placeholder="Email/Mobile"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <p v-if="form.errors?.userId" class="text-red-500 text-sm">{{ form.errors.userId }}</p>
                            <button
                                @click="handleSend"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Send OTP
                            </button>
                        </div>

                        <!-- Step 2 -->
                        <div v-show="step === 2" class="space-y-4">
                            <p class="text-gray-600 text-sm">Verify OTP</p>
                            <input
                                v-model="verifyForm.otp"
                                type="text"
                                placeholder="OTP"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <p v-if="verifyForm.errors?.otp" class="text-red-500 text-sm">{{ verifyForm.errors.otp }}</p>
                            <button
                                @click="handleVerify"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Verify OTP
                            </button>
                        </div>

                        <!-- Step 3 -->
                        <div v-show="step === 3" class="space-y-4">
                            <p class="text-gray-600 text-sm">Set Password</p>
                            <input
                                v-model="resetForm.password"
                                type="password"
                                placeholder="New Password"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <p v-if="resetForm.errors?.password" class="text-red-500 text-sm">{{ resetForm.errors.password }}</p>
                            <input
                                v-model="resetForm.password_confirmation"
                                type="password"
                                placeholder="Confirm Password"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <p v-if="resetForm.errors?.password_confirmation" class="text-red-500 text-sm">
                                {{ resetForm.errors.password_confirmation }}
                            </p>
                            <button
                                @click="handleConfirm"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <Footer />
</template>
<script setup>

import {Head, router} from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";



const step = ref(1);

const form = reactive({
    userId: "",
    errors: {},
});

const verifyForm = reactive({
    otp: "",
    errors: {},
});

const resetForm = reactive({
    password: "",
    password_confirmation: "",
    errors: {},
});

const handleSend = () => {
    axios
        .post(route("forgot.send"), { ...form })
        .then(() => {
            step.value = 2;
        })
        .catch((err) => {
            form.errors = err?.response?.data?.errors || {};
        });
};

const handleVerify = () => {
    axios
        .post(route("forgot.verify"), {
            userId: form.userId,
            ...verifyForm,
        })
        .then((res) => {
            const { data } = res.data;
            if (data) {
                step.value = 3;
            } else {
                verifyForm.errors.otp = ["Invalid OTP"];
            }
        })
        .catch((err) => {
            verifyForm.errors = err?.response?.data?.errors || {};
        });
};

const handleConfirm = () => {
    axios
        .post(route("forgot.password"), {
            ...resetForm,
            userId: form.userId,
        })
        .then((res) => {
            const { message } = res.data;
            alert(message); // or integrate with your preferred notification system
            router.get(route("login"));
        })
        .catch((err) => {
            resetForm.errors = err?.response?.data?.errors || {};
        });
};
</script>

<style scoped>
.login-title {
    font-size: 28px;
    font-weight: bold;
    color: #191c51;
}
</style>
