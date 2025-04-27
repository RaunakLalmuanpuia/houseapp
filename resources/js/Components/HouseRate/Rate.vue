<template>
    <div class="max-w-5xl mx-auto px-4 py-10">
        <h2 class="text-center font-bold text-black text-lg mb-6">{{ house.name }}</h2>

        <!-- Scroll Container Wrapper -->
        <div class="relative w-full flex items-center justify-center px-2">

            <!-- Previous Button -->
            <button
                v-if="rooms.length > 4"
                aria-label="Previous"
                class="absolute left-[-40px] z-20 bg-white w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:shadow-lg"
                @click="scrollLeft"
            >
                <i class="fas fa-chevron-left text-black"></i>
            </button>

            <!-- Scrollable Items -->
            <div class="relative w-full overflow-hidden px-3">
                <div
                    ref="scrollContainer"
                    class="flex space-x-5 overflow-x-auto scrollbar-hide w-full snap-x snap-mandatory scroll-smooth px-[8px]"
                    :class="{ 'justify-start pl-22': rooms.length < 3, 'justify-center': rooms.length >= 3 }"
                >
                    <!-- Start Spacer -->
                    <div class="flex-shrink-0 w-[8px]"></div>

                    <div
                        v-for="(room, index) in rooms"
                        :key="index"
                        class="bg-white rounded-xl flex-shrink-0 w-[220px] snap-start py-6 px-6 text-center flex flex-col"
                    >
                        <h3
                            class="font-semibold text-black text-sm mb-2 whitespace-nowrap w-full relative after:block after:w-12 after:h-1 after:bg-[#2bb6bc] after:rounded after:mx-auto after:mt-1"
                        >
                            {{ room.name }}
                        </h3>

                        <div class="text-gray-600 text-xs leading-5">
                            <div v-for="(price, key) in room.prices" :key="key">
                                <p>{{ key }}</p>
                                <p class="font-bold text-black text-base mt-1">{{ price }}</p>
                                <hr class="my-3 border-gray-300" />
                            </div>
                        </div>
                    </div>

                    <!-- End Spacer -->
                    <div class="flex-shrink-0 w-[8px]"></div>
                </div>
            </div>

            <!-- Next Button -->
            <button
                v-if="rooms.length > 4"
                aria-label="Next"
                class="absolute right-[-40px] z-20 bg-white w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:shadow-lg"
                @click="scrollRight"
            >
                <i class="fas fa-chevron-right text-black"></i>
            </button>


        </div>
    </div>

<!--    New-->


</template>

<script setup>


import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

// const { props } = usePage()
// const rooms = ref(props.rooms)

const props = defineProps(['house', 'rooms']);
const scrollContainer = ref(null)

// Scroll one card at a time (220px + 20px spacing)
const scrollLeft = () => {
    scrollContainer.value.scrollBy({ left: -(220 + 20), behavior: 'smooth' })
}
const scrollRight = () => {
    scrollContainer.value.scrollBy({ left: (220 + 20), behavior: 'smooth' })
}
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
