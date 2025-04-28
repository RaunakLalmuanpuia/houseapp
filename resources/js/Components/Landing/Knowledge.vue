<script setup>
import GeneralRequirement from "@/Components/Knowledge/GeneralRequirement.vue";
import OnDutyNotOnDuty from "@/Components/Knowledge/OnDutyNotOnDuty.vue";
import MedicalStudyPrivate from "@/Components/Knowledge/MedicalStudyPrivate.vue";
import SpecialCondition from "@/Components/Knowledge/SpecialCondition.vue";
import BeforeEntering from "@/Components/Knowledge/BeforeEntering.vue";
import {ref, computed} from "vue";

// State to track the selected option
const selectedOption = ref('general');

// Method to select the component based on the selected option
const selectOption = (option) => {
    selectedOption.value = option;
};

// Compute the selected component based on the selected option
const selectedComponent = computed(() => {
    switch (selectedOption.value) {
        case 'onDutyNotOnDuty':
            return OnDutyNotOnDuty;
        case 'medicalStudyPrivate':
            return MedicalStudyPrivate;
        case 'general':
            return GeneralRequirement;
        case 'specialConcessions':
            return SpecialCondition;
        case 'beforeEntering':
            return BeforeEntering;
        default:
            return GeneralRequirement;
    }
});

</script>

<template>
    <div class="p-6 flex flex-col items-center">
        <!-- HEADING -->
        <div class="w-full max-w-5xl ml-8">
            <h1 class="font-extrabold text-black text-xl leading-tight border-l-4 border-black pl-3">
                Mizoram House Reservation a<br />Hriattur te
            </h1>
        </div>

        <!-- FLEX ROW -->
        <div class="flex flex-col md:flex-row justify-center items-stretch gap-2 md:gap-4 p-6 h-[600px] w-full max-w-5xl">
            <!-- LEFT SIDE -->
            <div class="w-full max-w-md p-4 flex flex-col h-full">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-grow">
                    <!-- On Duty & Not On Duty Option -->
                    <div
                        class="p-4 border rounded-lg bg-card text-foreground"
                        :class="{'border-red-500': selectedOption === 'onDutyNotOnDuty'}"
                        @click="selectOption('onDutyNotOnDuty')"
                    >
                        <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                            On Duty & Not On Duty
                        </p>
                    </div>

                    <!-- Medical Study Tour Private Option -->
                    <div
                        class="p-4 border rounded-lg bg-card text-foreground"
                        :class="{'border-red-500': selectedOption === 'medicalStudyPrivate'}"
                        @click="selectOption('medicalStudyPrivate')"
                    >
                        <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                            Medical Study Tour Private
                        </p>
                    </div>

                    <!-- General Requirements Option (Spans two columns on larger screens) -->
                    <div
                        class="col-span-1 md:col-span-2 p-4 border rounded-lg bg-card text-foreground"
                        :class="{'border-red-500': selectedOption === 'general'}"
                        @click="selectOption('general')"
                    >
                        <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                            General Requirements (For All Applicants)
                        </p>
                    </div>

                    <!-- Special Concessions & Conditions Option -->
                    <div
                        class="p-4 border rounded-lg bg-card text-foreground"
                        :class="{'border-red-500': selectedOption === 'specialConcessions'}"
                        @click="selectOption('specialConcessions')"
                    >
                        <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                            Special Concessions & Conditions
                        </p>
                    </div>

                    <!-- Before Entering Mizoram House Option -->
                    <div
                        class="p-4 border rounded-lg bg-card text-foreground"
                        :class="{'border-red-500': selectedOption === 'beforeEntering'}"
                        @click="selectOption('beforeEntering')"
                    >
                        <p class="text-[#1F3652] font-sans text-[18px] font-bold leading-[23px] tracking-[0.15px]">
                            Before Entering Mizoram House
                        </p>
                    </div>
                </div>
            </div>


            <!-- RIGHT SIDE -->
            <div class="w-full max-w-md p-6 bg-card rounded-lg shadow-md flex flex-col h-[528px] border border-red-500 mt-3 ">
                <div class="flex-grow overflow-auto">
                    <!-- Render the selected component dynamically -->
                    <component :is="selectedComponent" />
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
