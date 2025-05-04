<script setup>
defineProps({
    application: Object,
});
</script>

<template>
    <div class="bg-white font-sans text-black px-4 sm:px-6 md:px-10 lg:px-16 py-6">

        <div class="space-y-6">
            <h2 class="text-2xl font-semibold text-[#0B146B]">Application History</h2>

            <div class="relative pl-6 border-l-2 border-blue-200 space-y-8">
                <div
                    v-for="(history, index) in application.status_histories"
                    :key="history.id"
                    class="relative group"
                >
                    <!-- Timeline Dot -->


                    <!-- Card Content -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition p-5">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm text-gray-500 font-medium">#{{ index + 1 }}</p>
                            <span class="text-xs text-gray-400 italic">{{ new Date(history.created_at).toLocaleString() }}</span>
                        </div>

                        <div class="space-y-1 text-sm text-gray-700">
                            <p><span class="font-semibold">Role:</span> {{ history.role || 'N/A' }}</p>
                            <p><span class="font-semibold">Action:</span> {{ history.action }}</p>
                            <p><span class="font-semibold">Note:</span> {{ history.note || 'No note' }}</p>
                            <p><span class="font-semibold">Priority:</span> {{ history.priority || 'N/A' }}</p>
                            <p v-if="history.handled_by"><span class="font-semibold">Handled By:</span> {{ history.handler.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
