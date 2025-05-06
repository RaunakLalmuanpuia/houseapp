<script setup>
import {onMounted, ref} from "vue";

const faq = ref();

function toggleFaq(index) {
    faq.value[index].open = !faq.value[index].open;
}
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
    <div style="background: #F8F8F8;" class="flex flex-col md:flex-row justify-center items-stretch p-6 space-y-4 md:space-y-0 md:space-x-4">
        <!-- Application Statistics -->
        <div class="w-full max-w-md bg-[#F8F8F8] p-4  flex flex-col">
            <p class="text-black font-sans text-[20px] font-bold leading-[24px] tracking-[0.15px]">
                Application Statistics
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="w-[196px] h-[88px] flex-shrink-0 rounded-[14px] bg-white p-4 shadow">
                    <p class="text-[rgba(2,2,2,0.87)] font-sans text-[20px] font-bold leading-[23px] tracking-[0.15px]">
                        10,30,987
                    </p>
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">Submitted</p>
                </div>
                <div class="w-[196px] h-[88px] flex-shrink-0 rounded-[14px] bg-white p-4 shadow">
                    <p class="text-[rgba(2,2,2,0.87)] font-sans text-[20px] font-bold leading-[23px] tracking-[0.15px]">
                        6,12,340
                    </p>
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">Approved</p>
                </div>
            </div>


            <p class="text-[20px] font-bold leading-[24px] text-black font-sans mt-6">
                Category Statistics
            </p>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-orange-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#733E15] font-sans">10,30,987</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#733E15] font-sans">FLAM</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#409B16] font-sans">6,12,340</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#150D72] font-sans">On Duty</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#409B16] font-sans">1,007</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#409B16] font-sans">Not on Duty</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#0073FF] font-sans">987</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#0073FF] font-sans">Medical</p>
                </div>
                <div class="bg-red-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#FF8C00] font-sans">1,007</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#FF8C00] font-sans">Private</p>
                </div>
                <div class="bg-pink-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#DD4939] font-sans">987</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#DD4939] font-sans">Study Tour</p>
                </div>
            </div>
        </div>

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

    </div>

</template>

<style scoped>

</style>
