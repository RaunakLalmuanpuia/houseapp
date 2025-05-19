<template>
    <Head title="Edit Profile" />

    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="flex items-center justify-between bg-white p-4  rounded">
            <div>
                <h2 class="text-2xl font-semibold">Edit Profile</h2>
                <nav class="text-sm text-gray-600 mt-2 space-x-2">
                  <span @click="$inertia.get(route('dashboard'))" class="cursor-pointer  hover:underline">
                    Dashboard
                  </span>
                    <span>/</span>
                    <span @click="$inertia.get(route('profile.edit'))" class="cursor-pointer  hover:underline">
                        Profile
                    </span>
                </nav>
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <form @submit.prevent="handleSubmit" class="w-full max-w-lg bg-white p-6 rounded shadow space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">User Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mobile</label>
                    <input
                        v-model="form.mobile"
                        type="text"
                        class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.mobile" class="text-red-500 text-sm mt-1">{{ form.errors.mobile }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p v-if="form.errors?.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                </div>

                <div class="flex space-x-4 mt-4">
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update
                    </button>
                    <button type="button" @click="handleBack" class="border border-red-500 text-red-500 px-4 py-2 rounded hover:bg-red-50">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {Head, useForm, usePage} from "@inertiajs/vue3";

defineOptions({
    layout: AuthLayout,
});

const form = useForm({
    name: usePage().props.auth?.user?.name,
    mobile: usePage().props.auth?.user?.mobile,
    email: usePage().props.auth?.user?.email,
});

const handleSubmit = () => {
    form.put(route("profile.update"));
};

const handleBack = () => {
    window.history.back();
};
</script>
