

<template>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Application Form</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Basic Fields -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Type</label>
                <input v-model="form.type" disabled class="w-full border border-gray-300 p-3 rounded-md bg-gray-100" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Application ID</label>
                <input v-model="form.application_id" disabled class="w-full border border-gray-300 p-3 rounded-md bg-gray-100" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Applicant Name</label>
                <input v-model="form.applicant_name" class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Gender</label>
                <select v-model="form.gender" class="w-full border border-gray-300 p-3 rounded-md bg-white focus:ring-2 focus:ring-blue-500">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Contact</label>
                <input v-model="form.contact" class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Designation</label>
                <input v-model="form.designation" class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Department</label>
                <select
                    v-model="form.department"
                    id="department"
                    class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Department</option>
                    <option v-for="dept in departments" :key="dept.id" :value="dept.id">
                        {{ dept.name }}
                    </option>
                </select>

            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Location</label>
                <select v-model="form.location" class="w-full border border-gray-300 p-3 rounded-md bg-white focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Location</option>
                    <option v-for="loc in house" :key="loc.id" :value="loc.id">{{ loc.name }}</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Start Date</label>
                <input type="date" v-model="form.start_date" class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">End Date</label>
                <input type="date" v-model="form.end_date" class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500" />
            </div>


            <!-- Not On Duty Members -->
            <div class="md:col-span-2 mt-6">
                <h2 class="text-lg font-bold mb-2">Other Not On Duty Details</h2>
                <div v-for="(person, index) in form.not_on_duty_details" :key="index" class="border p-4 mb-4 rounded-md grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-gray-700 font-medium mb-2">Name</label><input v-model="person.name" class="w-full border p-3 rounded-md" /></div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Gender</label>
                        <select v-model="person.gender" class="w-full border p-3 rounded-md bg-white focus:ring-2 focus:ring-blue-500">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div><label class="block text-gray-700 font-medium mb-2">Contact</label><input v-model="person.contact" class="w-full border p-3 rounded-md" /></div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Designation</label>
                        <input v-model="person.designation" class="w-full border p-3 rounded-md" />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Department</label>
                        <select
                            v-model="person.department"
                            id="department"
                            class="w-full border p-3 rounded-md"
                        >
                            <option disabled value="">Select Department</option>
                            <option v-for="dept in departments" :key="dept.id" :value="dept.id">
                                {{ dept.name }}
                            </option>
                        </select>

                    </div>

                    <div class="md:col-span-2 text-right">
                        <button type="button" @click="removeNotOnDuty(index)" class="text-red-500 hover:underline">Remove</button>
                    </div>
                </div>
                <button type="button" @click="addNotOnDuty" class="bg-blue-200 text-blue-800 px-3 py-2 rounded-md hover:bg-blue-300 transition">+ Add On Duty</button>
            </div>

            <!-- Family Members -->
            <div class="md:col-span-2 mt-6">
                <h2 class="text-lg font-bold mb-2">Family Members</h2>
                <div v-for="(member, index) in form.family_members" :key="index" class="border p-4 mb-4 rounded-md grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-gray-700 font-medium mb-2">Name</label><input v-model="member.name" class="w-full border p-3 rounded-md" /></div>
                    <div><label class="block text-gray-700 font-medium mb-2">Relation</label><input v-model="member.relation" class="w-full border p-3 rounded-md" /></div>
                    <div class="md:col-span-2 text-right">
                        <button type="button" @click="removeFamilyMember(index)" class="text-red-500 hover:underline">Remove</button>
                    </div>
                </div>
                <button type="button" @click="addFamilyMember" class="bg-blue-200 text-blue-800 px-3 py-2 rounded-md hover:bg-blue-300 transition">+ Add Family Member</button>
            </div>

            <div class="md:col-span-2 mt-6 flex justify-center">
                <button
                    @click="update(application)"
                    type="submit"
                    class="w-1/2 text-center bg-black text-white px-6 py-3 rounded-md hover:bg-blue-700 transition"
                >
                    Update Application
                </button>
            </div>
        </div>
    </div>

    <!--    Update pop up-->
    <div
        v-if="showUpdatePopup"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 lg:-translate-x-[22%] z-50 w-[90%] sm:w-auto"
    >
        <div
            class="w-full sm:max-w-md bg-yellow-300 rounded-lg shadow-md flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4 p-4"
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
                <p class="font-extrabold text-yellow-900 text-lg leading-6">Success</p>
                <p class="text-yellow-900 text-base leading-6 mt-1">
                    Application updated successfully!
                </p>
            </div>
            <button
                @click="showUpdatePopup = false"
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
</template>
<script setup>
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
const props = defineProps({
    application: Object,
    house: Array,
    departments: Array,
})
const form = useForm({

    type: props.application.type,

    application_id: props.application.application_id,
    applicant_name: props.application.applicant_name,
    gender: props.application.gender,
    contact: props.application.contact,
    designation: props.application.designation,
    department: props.application.department_id,
    location: props.application.location,
    start_date: props.application.start_date,
    end_date: props.application.end_date,

    not_on_duty_details: props.application.not_on_duty_details.map(person => ({
        id: person.id,
        name: person.name,
        gender: person.gender,
        contact: person.contact,
        designation: person.designation,
        department: person.department_id,
        department_approval: null,
        existing_approval: person.department_approval
    })),

    // not_on_duty_details: props.application.not_on_duty_details ?? [],
    family_members: props.application.family_members ?? []
})
const showUpdatePopup = ref(false)
// Add/Remove Not On Duty
const addNotOnDuty = () => {
    form.not_on_duty_details.push({ name: '', gender: '', designation: '', department: '', contact: '' })
}
const removeNotOnDuty = index => {
    form.not_on_duty_details.splice(index, 1)
}

// Add/Remove Family Member
const addFamilyMember = () => {
    form.family_members.push({ name: '', relation: '' })
}
const removeFamilyMember = index => {
    form.family_members.splice(index, 1)
}

const update =(item) => {
    form.put(route('applications.not-on-duty.update', item), {
        onStart: () => {

        },
        onSuccess: (response) => {
            showUpdatePopup.value = true
        },
        onError: (errors) => {
            if (errors) {
                if (typeof errors === 'string') {
                    // If backend sends a simple string error
                    alert(errors);
                } else if (typeof errors === 'object') {
                    // If it's a validation bag or object
                    const firstError = Object.values(errors)[0];
                    if (Array.isArray(firstError)) {
                        alert(firstError[0]); // validation errors usually come as arrays
                    } else {
                        alert(firstError);
                    }
                } else {
                    alert('An unexpected error occurred.');
                }
            }
            showUpdatePopup.value = false
        },
        onFinish: () => {

        },
    })
}
</script>
<style scoped>

</style>
