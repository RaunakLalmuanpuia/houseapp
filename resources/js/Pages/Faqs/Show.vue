<template>
    <div class="min-h-screen flex flex-col">
        <Header />
        <div class="bg-white font-sans flex-grow flex flex-col items-center p-3 mx-auto">
            <div class="max-w-md mx-auto p-4">
                <div class="bg-blue-100 rounded-lg p-6 mb-6">
                    <h1 class="text-2xl font-extrabold leading-tight mb-2">Frequently Asked Questions</h1>
                    <p class="text-gray-600 text-base font-normal">
                        Mizoram House Online Reservation chungchuang a zawhna leh chhanna tlanglawn i tan chawpchhuah a ni e
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h2 class="text-center text-xl font-extrabold mb-4 leading-tight">
                        Mizoram House Online Reservation a zawhna leh chhana tlanglawn
                    </h2>
                    <p class="font-semibold mb-4">FAQs</p>

                    <div v-for="(faq, index) in faqs" :key="index" class="mb-6">
                        <div class="flex justify-between items-center mb-2 cursor-pointer" @click="toggleFaq(index)">
                            <p class="text-sm font-normal">{{ index + 1 }}. {{ faq.title }}</p>
                            <svg v-if="faq.open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <p v-if="faq.open" class="text-gray-500 text-sm font-normal leading-relaxed px-4">
                            {{ faq.content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>


</template>

<script setup>

import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
const props = defineProps(['faqs']);



function toggleFaq(index) {
    props.faqs[index].open = !props.faqs[index].open
}
</script>
