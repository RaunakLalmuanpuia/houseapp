<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";

function toggleFaq(index) {
    faq.value[index].open = !faq.value[index].open;
}
const faq = ref();
function getFaqs() {
    axios.get(route('faqs.json_index'))
        .then(res => {
            faq.value = res.data.faqs.map(f => ({ ...f, open: false }));
        })
        .catch(err => {
            console.error(err?.response?.data?.message);
        });
}

onMounted(() => {
    getFaqs();
});
</script>

<template>
    <!-- FAQ Section -->
    <div class="w-full max-w-md bg-white p-4 rounded-lg shadow-md flex flex-col h-[460px]">
        <p class="text-black font-sans text-[20px] font-bold leading-[24px] tracking-[0.15px]">
            Mizoram House Online Reservation chungchang a zawhna leh chhana tlanglawn
        </p>

        <!-- Scrollable area -->
        <div class="mt-4 overflow-y-auto">
            <div v-for="(item, index) in faq" :key="index" class="mb-5">
                <div class="flex justify-between items-center mb-2 cursor-pointer" @click="toggleFaq(index)">
                    <p class="text-sm font-normal">{{ index + 1 }}. {{ item.title }}</p>
                    <svg v-if="item.open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p v-if="item.open" class="text-gray-500 text-sm font-normal leading-relaxed px-4">
                    {{ item.content }}
                </p>
                <hr class="ml-2 mr-5">
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
