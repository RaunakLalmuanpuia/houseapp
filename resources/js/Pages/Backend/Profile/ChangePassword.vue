<template>
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="flex items-center justify-between bg-white p-4  rounded">
            <div>
                <h2 class="text-2xl font-semibold">Change Password</h2>
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

        <div class="mt-6 flex justify-center">
            <form @submit.prevent="handleSubmit" class="w-full max-w-xl bg-white p-6 rounded shadow space-y-4">
                <!-- Old Password -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Old Password</label>
                    <input
                        v-model="form.old_password"
                        type="password"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.old_password }"
                        placeholder="Enter your old password"
                    />
                    <p v-if="form.errors.old_password" class="text-red-500 text-sm mt-1">{{ form.errors.old_password }}</p>
                </div>

                <!-- New Password -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">New Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.password }"
                        placeholder="Enter new password"
                    />
                    <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.password_confirmation }"
                        placeholder="Re-enter new password"
                    />
                    <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 pt-4">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                    >
                        Update
                    </button>
                    <button
                        type="button"
                        @click="handleBack"
                        class="border border-red-500 text-red-500 px-4 py-2 rounded hover:bg-red-100 transition"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { useForm } from "@inertiajs/vue3";

defineOptions({
    layout: AuthLayout,
});

const form = useForm({
    old_password: '',
    password: '',
    password_confirmation: '',
});

const handleSubmit = () => {
    form.put(route('profile.update-password'), {
        onStart: () => console.log('Submitting...'),
        onFinish: () => console.log('Finished'),
    });
};

const handleBack = () => {
    window.history.back();
};
</script>
