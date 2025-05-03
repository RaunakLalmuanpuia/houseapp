<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";
import ApplicationStep from "@/Components/Common/ApplicationStep.vue";
import { router } from '@inertiajs/vue3'

import { onMounted } from 'vue'
import { useFlamApplicationStore } from '@/Store/useFlamApplicationStore'
import { useOnDutyApplicationStore } from '@/Store/useOnDutyApplicationStore'
import { useNotOnDutyApplicationStore } from '@/Store/useNotOnDutyApplicationStore'
import { useNonOfficialApplicationStore } from '@/Store/useNonOfficialApplicationStore'
import { useStudyTourApplicationStore } from '@/Store/useStudyTourApplicationStore'

// Initialize stores
const flamStore = useFlamApplicationStore()
const onDutyStore = useOnDutyApplicationStore()
const notOnDutyStore = useNotOnDutyApplicationStore()
const nonOfficialStore = useNonOfficialApplicationStore()
const studyTourStore = useStudyTourApplicationStore()

// Reset all stores on mount
onMounted(() => {
    flamStore.reset()
    onDutyStore.reset()
    notOnDutyStore.reset()
    nonOfficialStore.reset()
    studyTourStore.reset()
})
function nextFlam() {

    router.visit(route('apply.flam.step-two'))
}
function nextOnDuty() {
    router.visit(route('apply.on-duty.step-two'))
}

function nextNotOnDuty() {
    router.visit(route('apply.not-on-duty.step-two'))
}
function nextNonOfficial() {
    router.visit(route('apply.non-official.step-two'))
}

function nextStudyTour() {
    router.visit(route('apply.study-tour.step-two'))
}



</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Header />

        <!-- Main content -->
        <div class="flex-grow flex flex-col items-center w-[400px] p-3 mx-auto">
            <ApplicationStep class="w-full" />

            <div class="p-6 bg-background rounded-lg shadow-md w-full">
                <h1 class="text-[16px] font-semibold leading-6 tracking-[0.15px] text-black">Kal Chhan</h1>

                <p class="text-[#B0B0B0] text-[12px] font-medium leading-[18px] tracking-[0.5px] mt-2">
                    All reservations are made subject to availability of seats and GAD has no responsibility if accommodation is denied due to non-availability of seats.
                </p>

                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div @click="nextFlam" class="bg-orange-100 p-4 cursor-pointer hover:bg-orange-200 transition rounded-[14px]">
                        <h2 class="mt-6 text-[18px] font-bold leading-[24px] tracking-[0.15px] text-[#733E15]">FLAM</h2>
                        <p class="text-[12px] font-medium leading-normal text-[#733E15]">Former Legislators Association of Mizoram</p>
                    </div>

                    <div @click="nextOnDuty" class="bg-purple-100 p-4 cursor-pointer hover:bg-purple-200 transition rounded-[14px]">
                        <h2 class="mt-6 text-[18px] font-bold leading-[24px] tracking-[0.15px] text-[#150D72]">ON DUTY</h2>
                        <p class="text-[12px] font-medium text-[#150D72]">Officials traveling for work</p>
                    </div>

                    <div @click="nextNotOnDuty" class="bg-green-100 p-4 cursor-pointer hover:bg-green-200 transition rounded-[14px]">
                        <h2 class="mt-6 text-[18px] font-bold leading-[24px] tracking-[0.15px] text-[#409B16]">NOT ON DUTY</h2>
                        <p class="text-[12px] font-medium text-[#409B16]">Officials traveling for personal reasons</p>
                    </div>

                    <div class="bg-blue-100 p-4 cursor-pointer hover:bg-blue-200 transition rounded-[14px]">
                        <h2 class="mt-6 text-[18px] font-bold leading-[24px] tracking-[0.15px] text-[#0073FF]">MEDICAL</h2>
                        <p class="text-[12px] font-medium text-[#0073FF]">Patients referred for treatment</p>
                    </div>

                    <div @click="nextNonOfficial" class="bg-yellow-100 p-4 cursor-pointer hover:bg-yellow-200 transition rounded-[14px]">
                        <h2 class="mt-6 text-[18px] font-bold leading-[24px] tracking-[0.15px] text-[#FF8C00]">PRIVATE</h2>
                        <p class="text-[12px] font-medium text-[#FF8C00]">Non-official personal stay</p>
                    </div>

                    <div @click="nextStudyTour" class="bg-red-100 p-4 cursor-pointer hover:bg-red-200 transition rounded-[14px]">
                        <h2 class="mt-6 text-[18px] font-bold leading-[24px] tracking-[0.15px] text-[#DD4939]">STUDY TOUR</h2>
                        <p class="text-[12px] font-medium text-[#DD4939]">Educational group travel</p>
                    </div>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>


<style scoped>

</style>
