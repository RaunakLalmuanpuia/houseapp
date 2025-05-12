<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import axios from "axios";
import {Head, router} from "@inertiajs/vue3";
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
    <Head title="Status" />
    <div class="min-h-screen flex flex-col">
        <Header />

        <!-- Main Content: make it grow -->
        <div class="flex-grow flex flex-col items-center">
            <div
                class="bg-[#6B4A2B] rounded-xl p-8 w-full max-w-md text-white mt-4"
                style="font-feature-settings: 'liga' 0"
            >
                <h2 class="text-center text-2xl font-semibold mb-8">Check for Status</h2>
                <div class="space-y-6">
                    <div>
                        <label
                            for="applicationId"
                            class="block mb-2 text-base font-normal text-white"
                        >Application ID</label>
                        <input
                            v-model="applicationId"
                            id="applicationId"
                            type="text"
                            placeholder="Enter Application ID"
                            class="w-full rounded-md border border-white bg-transparent px-4 py-2 placeholder-white placeholder-opacity-70 text-white focus:outline-none focus:ring-1 focus:ring-white"
                        />
                    </div>
                    <div class="flex space-x-6">
                        <button
                            @click="viewApplication(applicationId)"
                            type="button"
                            class="w-32 border border-white rounded-lg py-3 text-white text-lg font-normal"
                        >
                            View
                        </button>
                        <button
                            @click="fetchApplication(applicationId)"
                            type="submit"
                            class="flex-1 bg-white rounded-lg py-3 text-[#1F1F1F] text-lg font-normal"
                        >
                            Submit
                        </button>
                    </div>
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
