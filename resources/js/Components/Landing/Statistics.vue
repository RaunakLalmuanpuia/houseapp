<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";



const submitted = ref(0)
const approved = ref(0)

const categories = ref({
    flam: 0,
    on_duty: 0,
    not_on_duty: 0,
    medical: 0,
    private: 0,
    study_tour: 0
})


const fetchApplicationStats = async () => {
    try {
        const response = await axios.get('statistics') // Change URL accordingly
        submitted.value = response.data.submitted
        approved.value = response.data.approved
        categories.value = response.data.categories
    } catch (error) {
        console.error('Failed to fetch application stats:', error)
    }
}

onMounted(() => {
    fetchApplicationStats();
});
</script>

<template>

    <!-- Application Statistics -->
    <div class="w-full max-w-md bg-[#F8F8F8] p-4  flex flex-col">

        <div class="w-full max-w-5xl ">
            <h1 class="font-extrabold text-black text-xl leading-tight border-l-4 border-black pl-3">
                Application Statistics
            </h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="w-[196px] h-[88px] flex-shrink-0 rounded-[14px] bg-white p-4 shadow">
                    <p class="text-[rgba(2,2,2,0.87)] font-sans text-[20px] font-bold leading-[23px] tracking-[0.15px]">
                        {{ submitted }}
                    </p>
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">Submitted</p>
                </div>
                <div class="w-[196px] h-[88px] flex-shrink-0 rounded-[14px] bg-white p-4 shadow">
                    <p class="text-[rgba(2,2,2,0.87)] font-sans text-[20px] font-bold leading-[23px] tracking-[0.15px]">
                        {{ approved }}
                    </p>
                    <p class="text-[#262526] font-sans text-[12px] font-normal leading-[18px]">Approved</p>
                </div>
            </div>

        <div class="w-full max-w-5xl  mt-6 ">
            <h1 class="font-extrabold text-black text-xl leading-tight border-l-4 border-black pl-3">
                Category Statistics
            </h1>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-orange-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#733E15] font-sans">{{categories.flam.toLocaleString()}}</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#733E15] font-sans">FLAM</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#409B16] font-sans">{{ categories.on_duty }}</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#150D72] font-sans">On Duty</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#409B16] font-sans">{{categories.not_on_duty}}</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#409B16] font-sans">Not on Duty</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#0073FF] font-sans">{{ categories.medical }}</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#0073FF] font-sans">Medical</p>
                </div>
                <div class="bg-red-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#FF8C00] font-sans">{{ categories.private }}</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#FF8C00] font-sans">Private</p>
                </div>
                <div class="bg-pink-100 p-4 rounded-lg shadow">
                    <p class="text-[20px] font-bold leading-[23px] text-[#DD4939] font-sans">{{ categories.study_tour }}</p>
                    <p class="text-[12px] font-normal leading-[18px] text-[#DD4939] font-sans">Study Tour</p>
                </div>
            </div>
    </div>

</template>

<style scoped>

</style>
