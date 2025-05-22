<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const stats = ref({
    incoming: 0,
    approved: 0,
    rejected: 0,
    all: 0,
})

const fetchStats = async () => {
    try {
        const response = await axios.get(route('house.statistics.status')) // adjust URL if needed
        stats.value = response.data
    } catch (error) {
        console.error('Failed to fetch stats:', error)
    }
}

onMounted(() => {
    fetchStats()
})
</script>

<template>
    <section class="flex flex-wrap gap-4 mb-4 text-[12px] font-semibold">
        <div class="w-[190px] h-[78px] bg-[#FFF4E5] text-[#F59E0B] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ stats.incoming }}</span>
            <span class="font-normal">Incoming</span>
        </div>
        <div class="w-[190px] h-[78px] bg-[#D9F7EE] text-[#10B981] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{ stats.approved }}</span>
            <span class="font-normal">Approved</span>
        </div>
        <div class="w-[190px] h-[78px] bg-[#FEE2E2] text-[#EF4444] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{stats.rejected}}</span>
            <span class="font-normal">Rejected</span>
        </div>
        <div class="w-[190px] h-[78px] bg-[#DBF2FF] text-[#3B82F6] rounded-md px-3 py-2 flex flex-col justify-center">
            <span class="text-[15px] font-bold leading-none">{{stats.all}}</span>
            <span class="font-normal">All Application</span>
        </div>
    </section>
</template>

<style scoped>

</style>
