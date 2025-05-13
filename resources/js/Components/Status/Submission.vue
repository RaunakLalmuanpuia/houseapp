<script setup>
import { computed } from 'vue';
import {router} from "@inertiajs/vue3";

const props = defineProps({
    application: Object,
})

function formatDateToDDMMMYYYY(datetime) {
    const date = new Date(datetime);
    const day = String(date.getDate()).padStart(2, '0');
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const month = monthNames[date.getMonth()];
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
}


// Format functions
function formatDate(dateTime) {
    const date = new Date(dateTime);
    return date.toLocaleDateString('en-IN'); // DD/MM/YYYY
}

function formatTime(dateTime) {
    const date = new Date(dateTime);
    return date.toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit' }); // HH:MM
}

// Computed entries for submitted and forwarded actions
const submittedEntry = computed(() =>
    props.application.status_histories?.find(item => item.action === 'submitted')
)

const submittedDate = computed(() =>
    submittedEntry.value ? formatDate(submittedEntry.value.created_at) : 'N/A'
)

const submittedTime = computed(() =>
    submittedEntry.value ? formatTime(submittedEntry.value.created_at) : 'N/A'
)

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
    <div class="mt-4 max-w-md w-full border border-gray-200 rounded-xl p-6 font-sans text-gray-700">
        <p class="mb-1">
            <span class="font-normal">Status:</span>
            <span class="font-semibold">Form Submitted; sending for verification</span>
        </p>
        <p class="mb-1">
            <span class="font-normal">Applied Date:</span>
            <span class="font-semibold">{{formatDateToDDMMMYYYY(application.created_at)}}</span>
        </p>
        <p class="mb-6">
            <span class="font-normal">Application ID:</span>
            <span class="font-semibold">{{ application.application_id }}</span>
        </p>

        <h3 class="text-gray-600 mb-6 text-lg font-normal">Current Status</h3>

        <div class="flex items-start space-x-4 ml-6">
            <!-- SVG Icon -->
            <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16.3501" r="15" transform="rotate(90 16 16.3501)" stroke="#2CB027" stroke-width="2"/>
                <circle cx="16" cy="16.3501" r="5" transform="rotate(90 16 16.3501)" fill="#2CB027"/>
            </svg>


            <!-- Step Content -->
            <div class="mb-10">
                <h4 class="font-bold text-gray-900 mb-1 text-base">Reservation Form Submitted</h4>
                <p class="text-gray-500 mb-1 text-sm leading-relaxed">
                    Your reservation form has been submitted. Please wait for confirmation.
                </p>
                <p class="text-green-700 text-sm font-normal">{{ submittedDate }} | {{ submittedTime }}</p>
            </div>
        </div>

        <hr class="border-gray-300 my-6" />

        <button
            @click="viewApplication(application.application_id)"
            type="button"
            class="w-full text-center text-black font-semibold text-base focus:outline-none"
        >
            View Detail
        </button>
    </div>




</template>

<style scoped>

</style>
