<script setup>

import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
const props = defineProps(['notices']);

const navigateToPage = (url) => {
    // Append the perPage parameter to pagination URLs
    if (url) {
        router.get(url, {
        });
    }
};

function formatDate(created_at) {
    const dateObj = new Date(created_at)
    return new Intl.DateTimeFormat('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    }).format(dateObj)
}

function formatTime(created_at) {
    const dateObj = new Date(created_at)
    return new Intl.DateTimeFormat('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    }).format(dateObj)
}

const handleOpenDocument = (item) => {
    let a = document.createElement("a");
    a.target = "_blank";
    a.href = `/storage/${item}`;
    a.click();
};

</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Header />

        <div class="bg-white font-sans flex-grow flex flex-col items-center p-6 mx-auto">
            <div class="max-w-md mx-auto rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-blue-100 p-6 rounded-t-lg">
                    <h1 class="text-2xl font-extrabold mb-2 leading-tight">Download Notice</h1>
                    <p class="text-gray-600 text-base font-normal leading-relaxed">
                        Mizoram House Online Reservation mipui te hriattur chhuahna
                    </p>
                </div>

                <div class="divide-y divide-gray-300">
                    <div v-for="(notice, index) in notices.data" :key="index" class="flex items-center justify-between p-4">
                        <div>
                            <p class="text-gray-900 text-base font-normal mb-1 leading-tight">
                                {{ notice.title }}
                            </p>
                            <div class="flex space-x-4 text-gray-400 text-xs font-normal leading-tight">
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ formatDate(notice.created_at) }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ formatTime(notice.created_at) }}</span>
                                </div>
                            </div>
                        </div>
                        <button  @click="handleOpenDocument(notice.document)" :aria-label="`Download ${notice.title}`" class="text-black text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                            </svg>
                        </button>
                    </div>
                </div>

                <nav
                    class="flex items-center justify-center space-x-2 p-4 text-gray-600 text-sm font-normal"
                    aria-label="Pagination"
                >
                    <button
                        v-for="(link, index) in notices.links"
                        :key="index"
                        :disabled="!link.url"
                        @click="navigateToPage(link.url)"
                        v-html="link.label"
                        :class="[
                          'min-w-[32px] h-8 px-2 border rounded-sm flex items-center justify-center cursor-pointer select-none',
                          link.active ? 'bg-gray-900 text-white border-gray-900' : 'hover:underline border-gray-300 text-gray-700',
                          !link.url ? 'opacity-50 cursor-not-allowed' : ''
                        ]"
                    />
                </nav>
            </div>
        </div>
        <Footer />
    </div>

</template>

<style scoped>

</style>
