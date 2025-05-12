<script setup>
import { computed } from 'vue';

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
            type="button"
            class="w-full text-center text-black font-semibold text-base focus:outline-none"
        >
            View Detail
        </button>
    </div>


<!--    <div class="w-full max-w-[412px] h-auto bg-white border border-[#EEE] rounded-[10px] shadow-lg p-4 mt-6 mx-auto overflow-hidden">-->
<!--        <div class="mt-6 text-muted-foreground">-->
<!--            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">-->
<!--                Status: <span class="font-medium">Form Submitted; sending for verification</span>-->
<!--            </p>-->

<!--            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">-->
<!--                Applied Date: <span class="text-black font-medium">{{ application.created_at }}</span>-->
<!--            </p>-->

<!--            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">-->
<!--                Application ID: <span class="text-black font-medium">{{ application.application_id }}</span>-->
<!--            </p>-->
<!--            &lt;!&ndash;            <p> <span class="font-medium"></span></p>&ndash;&gt;-->
<!--        </div>-->
<!--        <h2 class="text-lg font-semibold text-zinc-800">Current Status</h2>-->
<!--        <div class="container">-->
<!--            <div class="flex flex-col md:grid grid-cols-12 text-gray-50">-->
<!--                <div class="flex md:contents">-->
<!--                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">-->
<!--                        <div class="h-full w-6 flex items-center justify-center">-->
<!--                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>-->
<!--                        </div>-->
<!--                        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">-->
<!--                            <i class="fas fa-check-circle text-white"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class=" col-start-4 col-end-12 p-4  my-4 mr-auto w-full">-->
<!--                        <h3 class="font-semibold text-lg mb-1 text-gray-400">Reservation Form Submitted</h3>-->
<!--                        <p class="text-zinc-600">The Mizoram House reservation form has been submitted. Please wait for confirmation.</p>-->
<!--                        <span class="text-green-600">{{ application.created_at }} | 13:05</span>-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->
<!--        </div>-->

<!--        <div class="p-4">-->
<!--            <hr>-->
<!--            <button-->
<!--                class="bg-secondary text-secondary-foreground hover:bg-secondary/80 w-full py-2 rounded-lg"-->
<!--                @click="$inertia.get(route('home'))"-->
<!--            >-->
<!--                View Detail-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->


</template>

<style scoped>

</style>
