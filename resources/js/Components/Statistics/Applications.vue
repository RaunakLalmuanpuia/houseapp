<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const counts = ref({
    'FLAM': 0,
    'ON DUTY': 0,
    'NOT ON DUTY': 0,
    'MEDICAL': 0,
    'PRIVATE': 0,
    'STUDY TOUR': 0,
})

const fetchCounts = async () => {
    try {
        const response = await axios.get(route('statistics.application-count'))
        counts.value = response.data
    } catch (error) {
        console.error(error)
    }
}

onMounted(() => {
    fetchCounts()
})
</script>


<template>
    <section class="flex flex-wrap gap-2 mb-6 text-[12px] font-semibold">
        <div class="w-[150px] h-[78px] bg-[#F9F0D9] text-[#B27F00] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ counts['FLAM'] }}</span>
            <span class="font-normal">FLAM</span>
        </div>
        <div class="w-[150px] h-[78px] bg-[#D9D9F9] text-[#3B3B8F] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ counts['ON DUTY'] }}</span>
            <span class="font-normal">ON DUTY</span>
        </div>
        <div class="w-[150px] h-[78px] bg-[#D9F9D9] text-[#3B8F3B] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ counts['NOT ON DUTY'] }}</span>
            <span class="font-normal">NOT ON DUTY</span>
        </div>
        <div class="w-[150px] h-[78px] bg-[#D9E9F9] text-[#3B8FF9] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ counts['MEDICAL'] }}</span>
            <span class="font-normal">MEDICAL</span>
        </div>
        <div class="w-[150px] h-[78px] bg-[#F9E9D9] text-[#B27F00] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ counts['PRIVATE'] }}</span>
            <span class="font-normal">PRIVATE</span>
        </div>
        <div class="w-[150px] h-[78px] bg-[#F9D9D9] text-[#B23B3B] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ counts['STUDY TOUR'] }}</span>
            <span class="font-normal">STUDY TOUR</span>
        </div>
    </section>
</template>

<style scoped>

</style>
