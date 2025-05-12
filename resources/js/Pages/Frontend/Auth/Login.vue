

<template>
    <Head title="Login" />
    <Header />

    <div class="max-w-md mx-auto p-6  mt-4 mb-3 bg-card rounded-lg shadow-md">
        <h2 class="text-2xl font-bold">Login</h2>
        <p class="text-muted-foreground">Enter your credentials to login</p>
        <form @submit.prevent="handleSubmit" class="mt-4">
            <label class="block text-sm font-medium text-zinc-700" for="email">Email ID/Phone No.</label>
            <input v-model="form.email" required type="email" id="email" placeholder="Enter your email-ID/Phone No." class="mt-1 block w-full border border-border rounded-md p-2 focus:outline-none focus:ring focus:ring-ring" />

            <label  v-if="showError"  class="block text-sm font-medium text-red-700">{{page.props.errors.email}}</label>

            <label class="block text-sm font-medium text-zinc-700 mt-4" for="password">Password</label>

            <div class="relative">
                <input
                    v-model="form.password"
                    required id="password" placeholder="Enter your password"
                    :type="state.visiblePassword ? 'text' : 'password'"
                    class="mt-1 block w-full border border-border rounded-md p-2 focus:outline-none focus:ring focus:ring-ring pr-10"
                />
                <button
                    type="button"
                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500"
                    @click="state.visiblePassword = !state.visiblePassword"
                >
                    <span v-if="state.visiblePassword">🙈</span>
                    <span v-else>👁️</span>
                </button>
            </div>
            <!-- Centered Button -->
            <button  type="submit" class="mt-6 w-60 bg-black text-white py-2 rounded-md hover:bg-black mx-auto block">Login</button>
        </form>

        <div class="mt-4 flex items-center justify-between">
            <a href="#" class="text-muted-foreground text-start">Register New Account!</a>

            <a href="#" class="text-muted-foreground text-end">Forgot Password?</a>
        </div>

    </div>
    <Footer />


</template>


<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import {Head,useForm, usePage} from "@inertiajs/vue3";
import {reactive, ref, watch} from "vue";

const form=useForm({
    email:'',
    password:''
})
const page = usePage()
const state=reactive({
    visiblePassword:false
})
const showError = ref(false)
const handleSubmit=e=>{
    form.post(route('login.store'),{
    })
}

watch(
    () => page.props.errors,
    (errors) => {
        showError.value = Object.keys(errors).length > 0
    },
    { immediate: true }
)

</script>



<style scoped>

</style>
