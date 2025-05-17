<template>

    <!-- Application Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Application ID</label>
            <input type="text" v-model="form.application_id" class="w-full border px-3 py-2 rounded" disabled>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <input type="text" v-model="form.type" class="w-full border px-3 py-2 rounded" disabled>
        </div>
        <div>
            <label class="block mb-1">Applicant Name</label>
            <input v-model="form.applicant_name" type="text" class="input" />
        </div>
        <div>
            <label class="block mb-1">Gender</label>
            <select v-model="form.gender" class="input">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Contact</label>
            <input v-model="form.contact" type="text" class="input" />
        </div>
        <div>
            <label class="block mb-1">Designation</label>
            <input v-model="form.designation" type="text" class="input" />
        </div>
        <div>
            <label class="block mb-1">Department</label>
            <input v-model="form.department" type="text" class="input" />
        </div>
        <div>
            <label class="block mb-1">Location</label>
            <select v-model="form.location" class="w-full border px-3 py-2 rounded">
                <option value="">Select Location</option>
                <option
                    v-for="loc in house"
                    :key="loc.id"
                    :value="loc.id"
                >
                    {{ loc.name }}
                </option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Start Date</label>
            <input v-model="form.start_date" type="date" class="input" />
        </div>
        <div>
            <label class="block mb-1">End Date</label>
            <input v-model="form.end_date" type="date" class="input" />
        </div>
        <div>
            <label class="block mb-1">Department Approval (PDF)</label>

            <div v-if="props.application.department_approval" class="mb-2">
                <a
                    :href="props.application.department_approval"
                    target="_blank"
                    class="text-blue-600 underline"
                >
                    View Current File
                </a>
            </div>

            <input type="file" class="input" @change="handleFileUpload" />
        </div>
    </div>

    <!-- On Duty Details -->
    <div>
        <h3 class="text-lg font-semibold mb-2">On Duty Details</h3>
        <div v-for="(duty, index) in form.on_duty_details" :key="index" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 border p-4 rounded-md">
            <input v-model="duty.name" placeholder="Name" class="input" />
            <input v-model="duty.designation" placeholder="Designation" class="input" />
            <input v-model="duty.contact" placeholder="Contact" class="input" />
            <input v-model="duty.department" placeholder="Department" class="input" />
            <select v-model="duty.gender" class="input">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
            <div>
                <label class="block mb-1">Dept Approval (PDF)</label>

                <div v-if="duty.department_approval" class="mb-2">
                    <a
                        :href="duty.department_approval"
                        target="_blank"
                        class="text-blue-600 underline"
                    >
                        View Current File
                    </a>
                </div>

                <input type="file" class="input" @change="e => handleDutyFileUpload(e, index)" />
            </div>
            <button @click="removeDuty(index)" class="text-red-500">Remove</button>
        </div>
        <button @click="addDuty" class="btn-blue">Add Duty Member</button>
    </div>

    <!-- Family Members -->
    <div>
        <h3 class="text-lg font-semibold mb-2">Family Members</h3>
        <div v-for="(member, index) in form.family_members" :key="index" class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 border p-4 rounded-md">
            <input v-model="member.name" placeholder="Name" class="input" />
            <input v-model="member.relation" placeholder="Relation" class="input" />
            <button @click="removeFamily(index)" class="text-red-500">Remove</button>
        </div>
        <button @click="addFamily" class="btn-blue">Add Family Member</button>
    </div>

    <!-- Submit -->
    <div class="mt-6">
        <button @click="update(application)" class="btn-green">Update Application</button>
    </div>

</template>

<script setup>

import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    application: Object,
    house: Array
})

const form = useForm({
    id: props.application.id,
    type: props.application.type,
    status: props.application.status,
    application_id: props.application.application_id,
    applicant_name: props.application.applicant_name,
    gender: props.application.gender,
    contact: props.application.contact,
    designation: props.application.designation,
    department: props.application.department,
    department_approval: props.application.department_approval, // Keep original value
    department_approval_file: null, // New field for file upload
    location: props.application.location,
    start_date: props.application.start_date,
    end_date: props.application.end_date,
    on_duty_details: props.application.on_duty_details.map(duty => ({
        ...duty,
        department_approval_file: null // New field for file upload
    })),
    family_members: props.application.family_members
})

const handleFileUpload = (e) => {
    form.department_approval_file = e.target.files[0] // Assign to the new field
}

const handleDutyFileUpload = (e, index) => {
    const file = e.target.files[0]
    if (file) {
        form.on_duty_details[index].department_approval_file = file
    }
}
const addDuty = () => {
    form.on_duty_details.push({
        name: '',
        gender: '',
        contact: '',
        designation: '',
        department: '',
        department_approval: null
    })
}

const removeDuty = (index) => {
    form.on_duty_details.splice(index, 1)
}

const addFamily = () => {
    form.family_members.push({
        name: '',
        relation: ''
    })
}

const removeFamily = (index) => {
    form.family_members.splice(index, 1)
}

const update =(item) => {
    form.post(route('applications.on-duty.update', item), {
        preserveScroll: true,

        onStart: () => {

        },
        onSuccess: (response) => {
            // showUpdatePopup.value = true
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
            // showUpdatePopup.value = false
        },
        onFinish: () => {

        },
    })
}
</script>

<style scoped>
.input {
    @apply w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500;
}
.btn-blue {
    @apply bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600;
}
.btn-green {
    @apply bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700;
}
</style>
