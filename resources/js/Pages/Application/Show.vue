

<template>

    <OnDuty
        v-if="application.type === 'ON DUTY'"
        :application="application"
    />

    <Flam
        v-if="application.type === 'FLAM'"
        :application="application"
    />

    <NotOnDuty
        v-if="application.type === 'NOT ON DUTY'"
        :application="application"
    />

    <NonOfficial
        v-if="application.type === 'PRIVATE'"
        :application="application"
    />

    <StudyTour
        v-if="application.type === 'STUDY TOUR'"
        :application="application"
    />

<!--    Application History-->

    <ApplicationHistory
    :application="application"
    />




    <div class="bg-white mt-4 flex justify-center items-center ">
        <div class="flex space-x-4">
            <button
                @click="showRejectDialog = true"
                class="px-6 py-2 rounded-lg border border-gray-300 text-gray-800 text-base font-normal"
                type="button"
            >
                Reject
            </button>
            <button
                @click="showForwardDialog = true"
                class="px-6 py-2 rounded-lg bg-black text-white text-base font-normal"
                type="button"
            >
                Forward
            </button>
         </div>
    </div>

    <!--    Forward Dialog-->
    <div v-if="showForwardDialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <h2 class="text-[20px] font-extrabold text-[#0B146B] mb-4">Approve Note:</h2>
            <label for="statement" class="block text-base font-normal text-black mb-2">Write your statement</label>
            <textarea
                id="statement"
                maxlength="200"
                v-model="forwardForm.note"
                placeholder="Type here"
                class="w-full h-24 p-3 border border-gray-300 rounded-md text-gray-700 placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-[#0B146B] focus:border-transparent"
            ></textarea>
            <p class="text-gray-600 text-sm mt-1 mb-6">{{ forwardForm.note.length }}/200</p>

            <!-- Priority Selection -->
            <label for="priority" class="block text-base font-normal text-black mb-2">Select Priority</label>
            <select
                id="priority"
                v-model="forwardForm.priority"
                class="w-full p-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0B146B] focus:border-transparent mb-6"
            >
                <option value="" disabled>Select priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <div class="flex space-x-6">
                <button
                    @click="showForwardDialog = false"
                    type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 text-base font-normal hover:bg-gray-100 transition"
                >
                    Cancel
                </button>
                <button
                    @click="handleForward"
                    type="button"
                    class="px-8 py-2 bg-black text-white rounded-lg text-base font-normal hover:opacity-90 transition"
                >
                    Confirm Forward
                </button>
            </div>
        </div>
    </div>


<!--    Reject Dialog-->
    <div v-if="showRejectDialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <h2 class="text-[20px] font-extrabold text-[#0B146B] mb-4">Reasons of Reject</h2>
            <label for="statement" class="block text-base font-normal text-black mb-2">Write your statement</label>
            <textarea
                id="statement"
                maxlength="200"
                v-model="form.reject_reason"
                placeholder="Type here"
                class="w-full h-24 p-3 border border-gray-300 rounded-md text-gray-700 placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-[#0B146B] focus:border-transparent"
            ></textarea>
            <p class="text-gray-600 text-sm mt-1 mb-6">{{ form.reject_reason.length }}/200</p>
            <div class="flex space-x-6">
                <button
                    @click="showRejectDialog = false"
                    type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 text-base font-normal hover:bg-gray-100 transition"
                >
                    Cancel
                </button>
                <button
                    @click="handleReject"
                    type="button"
                    class="px-8 py-2 bg-black text-white rounded-lg text-base font-normal hover:opacity-90 transition"
                >
                    Confirm Reject
                </button>
            </div>
        </div>
    </div>


    <!--    Forward pop up-->
    <div
        v-if="showApprovePopup"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 lg:-translate-x-[22%] z-50 w-[90%] sm:w-auto"
    >
        <div
            class="w-full sm:max-w-md bg-green-300 rounded-lg shadow-md flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4 p-4"
            role="alert"
        >
            <div class="flex-shrink-0 mt-1">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_708_1780" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="21">
                        <rect y="0.5" width="20" height="20" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_708_1780)">
                        <path d="M4.41675 17.5837C4.00008 17.5837 3.64591 17.4378 3.35425 17.1462C3.06258 16.8545 2.91675 16.5003 2.91675 16.0837V4.91699C2.91675 4.50033 3.06258 4.14616 3.35425 3.85449C3.64591 3.56283 4.00008 3.41699 4.41675 3.41699H15.5834C16.0001 3.41699 16.3542 3.56283 16.6459 3.85449C16.9376 4.14616 17.0834 4.50033 17.0834 4.91699V16.0837C17.0834 16.5003 16.9376 16.8545 16.6459 17.1462C16.3542 17.4378 16.0001 17.5837 15.5834 17.5837H4.41675ZM4.41675 16.3337H15.5834C15.639 16.3337 15.6945 16.3059 15.7501 16.2503C15.8056 16.1948 15.8334 16.1392 15.8334 16.0837V4.91699C15.8334 4.86144 15.8056 4.80588 15.7501 4.75033C15.6945 4.69477 15.639 4.66699 15.5834 4.66699H4.41675C4.36119 4.66699 4.30564 4.69477 4.25008 4.75033C4.19453 4.80588 4.16675 4.86144 4.16675 4.91699V16.0837C4.16675 16.1392 4.19453 16.1948 4.25008 16.2503C4.30564 16.3059 4.36119 16.3337 4.41675 16.3337ZM5.62508 14.4587H14.4376L11.7084 10.8128L9.35425 13.8545L7.68758 11.7087L5.62508 14.4587Z" fill="#34A853"/>
                    </g>
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-extrabold text-green-900 text-lg leading-6">Forwarded</p>
                <p class="text-green-900 text-base leading-6 mt-1">
                    Reservation forwarded successfully!
                </p>
            </div>
            <button
                @click="showApprovePopup = false"
                aria-label="Close notification"
                class="text-green-900 hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 rounded mt-2 sm:mt-1 sm:ml-4"
            >
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_708_1788)">
                        <rect width="14" height="14" transform="translate(4 3.5)" fill="white" fill-opacity="0.01"/>
                        <g clip-path="url(#clip1_708_1788)">
                            <path d="M4.25594 3.75541C4.42003 3.59137 4.64255 3.49922 4.87457 3.49922C5.10659 3.49922 5.32911 3.59137 5.49319 3.75541L10.9996 9.26178L16.5059 3.75541C16.5867 3.67184 16.6832 3.60518 16.79 3.55932C16.8967 3.51346 17.0115 3.48932 17.1277 3.48831C17.2439 3.4873 17.3591 3.50944 17.4667 3.55344C17.5742 3.59744 17.6719 3.66241 17.754 3.74456C17.8362 3.82672 17.9012 3.92441 17.9452 4.03195C17.9892 4.13948 18.0113 4.2547 18.0103 4.37088C18.0093 4.48707 17.9851 4.60188 17.9393 4.70864C17.8934 4.81539 17.8268 4.91194 17.7432 4.99266L12.2368 10.499L17.7432 16.0054C17.9026 16.1704 17.9908 16.3915 17.9888 16.6209C17.9868 16.8503 17.8948 17.0698 17.7325 17.232C17.5703 17.3942 17.3508 17.4863 17.1214 17.4882C16.892 17.4902 16.671 17.402 16.5059 17.2427L10.9996 11.7363L5.49319 17.2427C5.32817 17.402 5.10714 17.4902 4.87772 17.4882C4.6483 17.4863 4.42883 17.3942 4.2666 17.232C4.10437 17.0698 4.01235 16.8503 4.01035 16.6209C4.00836 16.3915 4.09656 16.1704 4.25594 16.0054L9.76232 10.499L4.25594 4.99266C4.09191 4.82857 3.99976 4.60605 3.99976 4.37403C3.99976 4.14201 4.09191 3.9195 4.25594 3.75541Z" fill="#1C1D1F"/>
                        </g>
                    </g>
                    <defs>
                        <clipPath id="clip0_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                        <clipPath id="clip1_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                    </defs>
                </svg>

            </button>
        </div>
    </div>


    <!--    Reject pop up-->
    <div
        v-if="showRejectPopup"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 lg:-translate-x-[22%] z-50 w-[90%] sm:w-auto"
    >
        <div
            class="w-full sm:max-w-md bg-red-300 rounded-lg shadow-md flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4 p-4"
            role="alert"
        >
            <div class="flex-shrink-0 mt-1">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_708_1780" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="21">
                        <rect y="0.5" width="20" height="20" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_708_1780)">
                        <path d="M4.41675 17.5837C4.00008 17.5837 3.64591 17.4378 3.35425 17.1462C3.06258 16.8545 2.91675 16.5003 2.91675 16.0837V4.91699C2.91675 4.50033 3.06258 4.14616 3.35425 3.85449C3.64591 3.56283 4.00008 3.41699 4.41675 3.41699H15.5834C16.0001 3.41699 16.3542 3.56283 16.6459 3.85449C16.9376 4.14616 17.0834 4.50033 17.0834 4.91699V16.0837C17.0834 16.5003 16.9376 16.8545 16.6459 17.1462C16.3542 17.4378 16.0001 17.5837 15.5834 17.5837H4.41675ZM4.41675 16.3337H15.5834C15.639 16.3337 15.6945 16.3059 15.7501 16.2503C15.8056 16.1948 15.8334 16.1392 15.8334 16.0837V4.91699C15.8334 4.86144 15.8056 4.80588 15.7501 4.75033C15.6945 4.69477 15.639 4.66699 15.5834 4.66699H4.41675C4.36119 4.66699 4.30564 4.69477 4.25008 4.75033C4.19453 4.80588 4.16675 4.86144 4.16675 4.91699V16.0837C4.16675 16.1392 4.19453 16.1948 4.25008 16.2503C4.30564 16.3059 4.36119 16.3337 4.41675 16.3337ZM5.62508 14.4587H14.4376L11.7084 10.8128L9.35425 13.8545L7.68758 11.7087L5.62508 14.4587Z" fill="#34A853"/>
                    </g>
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-extrabold text-red-900 text-lg leading-6">Rejected</p>
                <p class="text-red-900 text-base leading-6 mt-1">
                    Reservation rejected successfully!
                </p>
            </div>
            <button
                @click="showRejectPopup = false"
                aria-label="Close notification"
                class="text-red-900 hover:text-red-800 focus:outline-none focus:ring-2 focus:ring-green-600 rounded mt-2 sm:mt-1 sm:ml-4"
            >
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_708_1788)">
                        <rect width="14" height="14" transform="translate(4 3.5)" fill="white" fill-opacity="0.01"/>
                        <g clip-path="url(#clip1_708_1788)">
                            <path d="M4.25594 3.75541C4.42003 3.59137 4.64255 3.49922 4.87457 3.49922C5.10659 3.49922 5.32911 3.59137 5.49319 3.75541L10.9996 9.26178L16.5059 3.75541C16.5867 3.67184 16.6832 3.60518 16.79 3.55932C16.8967 3.51346 17.0115 3.48932 17.1277 3.48831C17.2439 3.4873 17.3591 3.50944 17.4667 3.55344C17.5742 3.59744 17.6719 3.66241 17.754 3.74456C17.8362 3.82672 17.9012 3.92441 17.9452 4.03195C17.9892 4.13948 18.0113 4.2547 18.0103 4.37088C18.0093 4.48707 17.9851 4.60188 17.9393 4.70864C17.8934 4.81539 17.8268 4.91194 17.7432 4.99266L12.2368 10.499L17.7432 16.0054C17.9026 16.1704 17.9908 16.3915 17.9888 16.6209C17.9868 16.8503 17.8948 17.0698 17.7325 17.232C17.5703 17.3942 17.3508 17.4863 17.1214 17.4882C16.892 17.4902 16.671 17.402 16.5059 17.2427L10.9996 11.7363L5.49319 17.2427C5.32817 17.402 5.10714 17.4902 4.87772 17.4882C4.6483 17.4863 4.42883 17.3942 4.2666 17.232C4.10437 17.0698 4.01235 16.8503 4.01035 16.6209C4.00836 16.3915 4.09656 16.1704 4.25594 16.0054L9.76232 10.499L4.25594 4.99266C4.09191 4.82857 3.99976 4.60605 3.99976 4.37403C3.99976 4.14201 4.09191 3.9195 4.25594 3.75541Z" fill="#1C1D1F"/>
                        </g>
                    </g>
                    <defs>
                        <clipPath id="clip0_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                        <clipPath id="clip1_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                    </defs>
                </svg>

            </button>
        </div>
    </div>
</template>


<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import OnDuty from "@/Components/Applications/OnDuty.vue";
import Flam from "@/Components/Applications/Flam.vue";
import NotOnDuty from "@/Components/Applications/NotOnDuty.vue";
import NonOfficial from "@/Components/Applications/NonOfficial.vue";
import StudyTour from "@/Components/Applications/StudyTour.vue";
import ApplicationHistory from "@/Components/Applications/ApplicationHistory.vue";

import {useForm, router} from "@inertiajs/vue3";
import {ref} from "vue";

defineOptions({layout:AuthLayout})

const props = defineProps(['application']);

const form = useForm({
    reject_reason:'',
})

const forwardForm = useForm({
    note:'',
    priority:'',
})

const showApprovePopup = ref(false)
const showRejectPopup = ref(false)
const showRejectDialog = ref(false);

const showForwardDialog = ref(false);
const handleForward = e => {
    forwardForm.post(route('applications.forward', props.application), {
        // onStart: params => q.loading.show({
        //     boxClass: 'bg-grey-2 text-grey-9',
        //     spinnerColor: 'primary', message: ' Forwarding...'
        // }),
        onFinish: () => {
            showForwardDialog.value = false
            showApprovePopup.value = true
        },
    })
}

// const handleApprove = e => {
//     router.post(route('admin.application.approve', props.application), {}, {
//         onSuccess: () => {
//             showApprovePopup.value = true
//
//             // auto-hide after 3 seconds
//             // setTimeout(() => {
//             //     showApprovePopup.value = false
//             // }, 3000)
//         },
//         onError: err => console.log(err.toString()),
//     })
// }


const handleReject = e => {
    form.post(route('applications.reject', props.application), {
            // onStart: params => q.loading.show({
            //     boxClass: 'bg-grey-2 text-grey-9',
            //     spinnerColor: 'primary', message: ' Forwarding...'
            // }),
            onFinish: () => {
                showRejectDialog.value = false
                showRejectPopup.value = true

            },
        })
}

// const handleApprove = e => {
//     q.dialog({
//         title: 'Confirmation',
//         message: 'Do you want to approve? Please Confirm',
//         ok: 'Confirm',
//         cancel: 'Cancel'
//     }).onOk(function () {
//         router.post(route('admin.application.approve', props.application), {}, {
//             onStart: params => q.loading.show({
//                 boxClass: 'bg-grey-2 text-grey-9',
//                 spinnerColor: 'primary', message: ' Approving...'
//             }),
//             onError: err => console.log(err.toString()),
//             onFinish: params => q.loading.hide()
//         })
//     });
// }

</script>


<style scoped>

</style>



