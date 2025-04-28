<template>
    <div class="max-w-5xl mx-auto px-4 py-10">
        <h2 class="text-center font-bold text-black text-lg mb-6">{{ house.name }}</h2>

        <div class="relative w-full flex items-center justify-center">

            <!-- Previous Button -->
            <button
                v-if="rooms.length > (isMobile ? 1 : 4)"
                aria-label="Previous"
                class="absolute -left-4 sm:-left-8 md:-left-12 z-20 bg-white w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:shadow-lg"
                @click="scrollLeft"
            >
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.54801 12.42L6.48701 13.48L0.708012 7.70301C0.614858 7.61044 0.540929 7.50037 0.490481 7.37912C0.440033 7.25787 0.414062 7.12784 0.414062 6.99651C0.414062 6.86518 0.440033 6.73515 0.490481 6.6139C0.540929 6.49265 0.614858 6.38258 0.708012 6.29001L6.48701 0.51001L7.54701 1.57001L2.12301 6.99501L7.54801 12.42Z" fill="black"/>
                </svg>
            </button>

            <!-- Scrollable Items -->
            <div class="relative w-full overflow-hidden px-8 md:px-0">
                <div
                    ref="scrollContainer"
                    class="flex overflow-x-auto scrollbar-hide scroll-smooth items-stretch"
                    :class="rooms.length <= (isMobile ? 1 : 4) ? 'justify-center' : 'justify-start'"
                >
                    <div
                        v-for="(room, index) in rooms"
                        :key="index"
                        class="flex-shrink-0 w-[280px] md:w-[240px] mx-2 bg-white rounded-xl py-6 px-6 text-center flex flex-col snap-center"
                    >
                        <h3 class="font-semibold text-black text-sm mb-2 whitespace-nowrap relative after:block after:w-12 after:h-1 after:bg-[#2bb6bc] after:rounded after:mx-auto after:mt-1">
                            {{ room.name }}
                        </h3>

                        <div class="text-gray-600 text-xs leading-5 mt-2">
                            <div v-for="(price, key) in room.prices" :key="key" class="mb-2">
                                <p>{{ key }}</p>
                                <p class="font-bold text-black text-base mt-1">{{ price }}</p>
                                <hr class="my-2 border-gray-300" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Next Button -->
            <button
                v-if="rooms.length > (isMobile ? 1 : 4)"
                aria-label="Next"
                class="absolute -right-4 sm:-right-8 md:-right-14 z-20 bg-white w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:shadow-lg"
                @click="scrollRight"
            >
                <svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.45199 6.57999L3.51299 5.51999L9.29199 11.297C9.38514 11.3896 9.45907 11.4996 9.50952 11.6209C9.55997 11.7421 9.58594 11.8722 9.58594 12.0035C9.58594 12.1348 9.55997 12.2648 9.50952 12.3861C9.45907 12.5073 9.38514 12.6174 9.29199 12.71L3.51299 18.49L2.45299 17.43L7.87699 12.005L2.45199 6.57999Z" fill="black"/>
                </svg>
            </button>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps(['house', 'rooms']);
const scrollContainer = ref(null)

const isMobile = ref(false);

const detectMobile = () => {
    isMobile.value = window.innerWidth < 768; // you can adjust the breakpoint if needed
};

onMounted(() => {
    detectMobile();
    window.addEventListener('resize', detectMobile);
});

// Scroll settings
const CARD_WIDTH_DESKTOP = 240 + 16; // 240px + 16px (8px left and right margin)
const CARD_WIDTH_MOBILE = 280 + 16; // 280px card on small screen

const scrollLeft = () => {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({
            left: -(isMobile.value ? CARD_WIDTH_MOBILE : CARD_WIDTH_DESKTOP),
            behavior: 'smooth'
        });
    }
};

const scrollRight = () => {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({
            left: (isMobile.value ? CARD_WIDTH_MOBILE : CARD_WIDTH_DESKTOP),
            behavior: 'smooth'
        });
    }
};
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>








