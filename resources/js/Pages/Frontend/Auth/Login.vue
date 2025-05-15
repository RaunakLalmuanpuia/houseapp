

<template>
    <Head title="Login" />
    <Header />

    <div class="max-w-md mx-auto p-6  mt-4 mb-3 bg-card rounded-lg shadow-md">

        <div v-if="error" class="text-red-600 mb-4">
            {{ error }}
        </div>


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

        <form
            ref="digilockerRef"
            class="hidden"
            method="get"
            action="https://digilocker.meripehchaan.gov.in/public/oauth2/1/authorize"
            id="digilockerForm"
        >
            <input v-model="signerForm.response_type" type="hidden" name="response_type" />
            <input v-model="signerForm.client_id" type="hidden" name="client_id" />
            <input v-model="signerForm.redirect_uri" type="hidden" name="redirect_uri" />
            <input v-model="signerForm.state" type="hidden" name="state" />
            <input v-model="signerForm.scope" type="hidden" name="scope" />
            <input v-model="signerForm.code_challenge" type="hidden" name="code_challenge" />
            <input v-model="signerForm.code_challenge_method" type="hidden" name="code_challenge_method" />
        </form>





        <button @click="handleDigilocker" class=" mt-5 bg-blue-700 text-white flex ml-10 items-center p-3 rounded-lg shadow-md hover:bg-primary/80 whitespace-nowrap">
            <img aria-hidden="true" alt="DigiLocker icon" src="/images/icons/Digilocker_logo.png" class="mr-3 w-[120px]" />
            Continue with DigiLocker
        </button>


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
import { nextTick } from 'vue'

const form=useForm({
    email:'',
    password:''
})
const page = usePage()
const state=reactive({
    visiblePassword:false
})

defineProps({
    error: String
});


const digilockerRef = ref(null);

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
const signerForm=reactive({
    response_type: null,
    client_id: null,
    redirect_uri: null,
    state: null,
    scope: null,
    code_challenge: null,
    code_challenge_method: null,
})

const handleDigilocker = async () => {
    try {
        const res = await axios.get(route('digilocker.params'))
        const {
            response_type,
            client_id,
            redirect_uri,
            state,
            scope,
            code_challenge,
            code_challenge_method,
        } = res.data

        signerForm.response_type=  (response_type);
        signerForm.client_id=(client_id);
        signerForm.redirect_uri=(redirect_uri);
        signerForm.state=(state);
        signerForm.scope=(scope);
        signerForm.code_challenge=(code_challenge);
        signerForm.code_challenge_method=(code_challenge_method);

        // Wait for DOM updates to apply form data
        await nextTick()

        digilockerRef.value.submit();

    } catch (error) {
        console.error('Error getting Digilocker params:', error)
    }
}

</script>



<style scoped>

</style>
