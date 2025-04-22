<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import axios from "axios";
import {router} from "@inertiajs/vue3";
import {ref} from "vue";
import Submitted from "@/Components/Status/Submission.vue";
import Confirmed from "@/Components/Status/Confirm.vue";
import Approved from "@/Components/Status/Approved.vue";
import Rejected from "@/Components/Status/Rejected.vue";

// Reactive reference to store the fetched application data
const application = ref(null);
const applicationId = ref('')


const fetchApplication = (applicationId) => {
    if (!applicationId || applicationId.trim() === '') {

        // Optionally, you can show an error message to the user here, e.g.:
        alert('Please enter a valid Application ID');
        return; // Prevent further execution
    }

    axios.get(route('status.application', applicationId))
        .then(res => {
            const { data } = res.data;
            application.value = data;
            console.log('Fetched Application:', application.value); // Log the fetched application data
        })
        .catch(err => {
            alert(`Error fetching application: ${err.message || err}`);
            console.log('Error fetching application:', err);
        });
};

const viewApplication = (applicationId) => {
    if (!applicationId || applicationId.trim() === '') {

        // Optionally, you can show an error message to the user here, e.g.:
        alert('Please enter a valid Application ID');
        return; // Prevent further execution
    }

    // Navigate to the view route
    router.visit(route('status.show-application', applicationId));
};


</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Header />

        <!-- Main Content: make it grow -->
        <div class="flex-grow flex flex-col items-center">
            <div class="w-full max-w-[412px] bg-[#654829] border border-[#EEE] rounded-[10px] shadow-lg p-6 mt-4 mx-auto overflow-hidden">
                <p class="text-[18px] sm:text-[20px] font-semibold leading-[20px] tracking-[0.25px] text-white font-['Noto_Sans'] text-center">
                    Check for Status
                </p>

                <div class="mt-4 py-4">
                    <label class="block text-[14px] font-medium leading-[20px] tracking-[0.1px] text-white py-2" for="application-id">
                        Application ID
                    </label>

                    <input v-model="applicationId"
                           type="text" id="application-id" placeholder="Enter Application ID"
                           class="w-full p-2 border border-[#DCDCDC] rounded-[4px]
           bg-[rgba(255,255,255,0.08)] text-[#EEE] font-['Noto_Sans'] text-[14px]
           font-normal leading-[20px] tracking-[0.25px] placeholder:text-[#EEE]" />
                </div>

                <div class="flex flex-col sm:flex-row justify-between mt-4 gap-4">
                    <button @click="viewApplication(applicationId)"
                            class="flex justify-center items-center gap-2 w-full sm:w-auto min-w-[104px] px-4 py-2
             border border-[#EFF6FF] rounded-lg bg-secondary text-[#EFF6FF]
             hover:bg-secondary/80 text-center font-['Noto_Sans'] text-[14px]
             font-medium leading-[20px] tracking-[0.1px]">
                        View
                    </button>

                    <button @click="fetchApplication(applicationId)"
                            class="flex justify-center items-center gap-2 px-6 py-2 w-full sm:w-auto min-w-[104px]
             bg-white text-[#2B2B2B] border border-[#EFF6FF] rounded-lg
             hover:bg-gray-100 text-center font-['Noto_Sans'] text-[14px]
             font-medium leading-[20px] tracking-[0.1px]">
                        Submit
                    </button>
                </div>
            </div>

            <!-- Conditional Status Components -->
            <Submitted v-if="application && application.status === 'Pending'" :application="application" />
            <Confirmed v-if="application && application.status === 'Confirmed'" :application="application" />
            <Approved v-if="application && application.status === 'Approved'" :application="application" />
            <Rejected v-if="application && application.status === 'Rejected'" :application="application" />
        </div>

        <!-- Footer stays at the bottom -->
        <Footer />
    </div>
</template>


<style scoped>

</style>
