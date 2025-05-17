<template>
    <Head title="Register" />
    <Header />
    <div class="w-full sm:w-1/2 px-2">
        <div v-if="!!$page.props.auth?.user" class="flex flex-col gap-2">
            <p class="text-gray-800">You are logged in</p>
            <button
                @click="$inertia.get(route('dashboard'))"
                class="text-blue-600 underline"
            >
                Go to dashboard
            </button>
        </div>

        <div v-else class="flex flex-col gap-2 justify-center items-center">
            <!-- OTP Form -->
            <div v-if="state.sentOtp" class="w-full max-w-md">
                <form @submit.prevent="handleOtp" class="flex flex-col gap-4">
                    <p class="text-lg font-semibold text-left">OTP</p>

                    <!-- Mobile OTP -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Mobile OTP</label>
                        <input
                            type="text"
                            maxlength="4"
                            v-model="otpForm.mobile_otp"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <p v-if="otpForm.errors?.mobile_otp" class="text-red-600 text-sm mt-1">
                            {{ otpForm.errors.mobile_otp }}
                        </p>
                    </div>
                    <div class="text-blue-600 font-semibold cursor-pointer text-left">
                        Resend OTP
                    </div>



                    <div class="flex">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition"
                        >
                            Confirm
                        </button>
                    </div>
                </form>
            </div>

            <!-- Signup Form -->
            <form
                v-else
                @submit.prevent="handleSubmit"
                class="w-full max-w-md flex flex-col gap-4"
            >
                <div class="text-left">
                    <p class="text-lg font-semibold">Sign up</p>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input
                        type="text"
                        v-model="form.name"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.name" class="text-red-600 text-sm mt-1">
                        {{ form.errors.name }}
                    </p>
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-sm font-medium mb-1">Phone Number</label>
                    <input
                        type="text"
                        v-model="form.mobile"
                        maxlength="10"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.mobile" class="text-red-600 text-sm mt-1">
                        {{ form.errors.mobile }}
                    </p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input
                        type="email"
                        v-model="form.email"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.email" class="text-red-600 text-sm mt-1">
                        {{ form.errors.email }}
                    </p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <div class="relative">
                        <input
                            :type="state.visiblePassword ? 'text' : 'password'"
                            v-model="form.password"
                            class="w-full border rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <span
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 cursor-pointer"
                            @click="state.visiblePassword = !state.visiblePassword"
                        >
            {{ state.visiblePassword ? '👁' : '👁‍🗨' }}
          </span>
                    </div>
                    <p v-if="form.errors?.password" class="text-red-600 text-sm mt-1">
                        {{ form.errors.password }}
                    </p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input
                        :type="state.visiblePassword ? 'text' : 'password'"
                        v-model="form.password_confirmation"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.password_confirmation" class="text-red-600 text-sm mt-1">
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <div class="flex mt-2">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition"
                    >
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>

    <Footer />
</template>

<script setup>

import {Head, useForm} from "@inertiajs/vue3";
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import {reactive} from "vue";

const state=reactive({
    sentOtp:false,
    visiblePassword:false
})

const form=useForm({
    name: '',
    mobile: '',
    email:'',
    password:'',
    password_confirmation:''
})
const otpForm=useForm({
    mobile_otp: '',
    email_otp:'',
})

const handleOtp=e=>{
    otpForm.transform(data => ({...data,...form.data()}))
        .post(route('register.confirm-otp'),{
            onStart:params =>  {
            },
            onSuccess:params => {
                state.sentOtp = false;
            },
        })
}

const handleSubmit=e=>{
    axios.post(route('register.send-otp'),form.data())
        .then(res=>{
            if (res.data.status) {
                state.sentOtp = true;
            }
            form.setError({})
        })
        .catch(err=>{
            state.sentOtp = false;
            if (err?.response?.data?.errors) {
                form.setError(err.response.data.errors);
            }
        })

}
</script>
