<script setup>
defineProps({
    application: Object,
});
</script>

<template>
    <div class="max-w-md w-full border border-gray-200 rounded-xl p-6 font-sans text-gray-700">
        <p class="mb-1">
            <span class="font-normal">Status:</span>
            <span class="font-semibold">Form Submitted; sending for verification</span>
        </p>
        <p class="mb-1">
            <span class="font-normal">Applied Date:</span>
            <span class="font-semibold">07-Feb-2025</span>
        </p>
        <p class="mb-6">
            <span class="font-normal">Application ID:</span>
            <span class="font-semibold">1635716371</span>
        </p>

        <h3 class="text-gray-600 mb-6 text-lg font-normal">Current Status</h3>

        <div class="relative ml-6">
            <!-- Vertical line through circle centers -->
            <div class="absolute top-9 left-1.5 h-[calc(100%-4.5rem)] w-0.5 bg-green-600"></div>

            <!-- Step 1 -->
            <div class="relative mb-10 pl-6">
        <span
            class="absolute -left-6 top-6 h-6 w-6 rounded-full border-2 border-green-600 flex items-center justify-center bg-white"
            aria-hidden="true"
        >
          <span class="h-3.5 w-3.5 rounded-full bg-green-600"></span>
        </span>
                <h4 class="font-bold text-gray-900 mb-1 text-base">Reservation Form Submitted</h4>
                <p class="text-gray-500 mb-1 text-sm leading-relaxed">
                    Your reservation form has been submitted. Please wait for confirmation.
                </p>
                <p class="text-green-700 text-sm font-normal">2025-02-07 | 13:05</p>
            </div>

            <!-- Step 2 -->
            <div class="relative mb-10 pl-6">
        <span
            class="absolute -left-6 top-6 h-6 w-6 rounded-full border-2 border-green-600 flex items-center justify-center bg-white"
            aria-hidden="true"
        >
          <span class="h-3.5 w-3.5 rounded-full bg-green-600"></span>
        </span>
                <h4 class="font-bold text-gray-900 mb-1 text-base">Confirmed by Official</h4>
                <p class="text-gray-500 mb-1 text-sm leading-relaxed">
                    Your Reservation will be review by Mizoram House Staff.
                </p>
                <p class="text-green-700 text-sm font-normal">2025-02-08 | 06:49</p>
            </div>

            <!-- Step 3 -->
            <div class="relative pl-6">
        <span
            class="absolute -left-6 top-6 h-6 w-6 rounded-full border-2 border-green-600 flex items-center justify-center bg-white"
            aria-hidden="true"
        >
          <span class="h-3.5 w-3.5 rounded-full bg-green-600"></span>
        </span>
                <h4 class="font-bold text-gray-900 mb-1 text-base">Approved</h4>
                <p class="text-gray-500 mb-1 text-sm leading-relaxed">
                    Your Reservation is confirmed. Enjoy your stay!
                </p>
                <p class="text-green-700 text-sm font-normal">2025-02-08 | 15:38</p>
            </div>
        </div>

        <hr class="border-gray-300 my-6" />

        <button
            type="button"
            class="w-full text-center text-black font-semibold text-base focus:outline-none"
        >
            View Detail
        </button>
    </div>

<!--    <div class="w-full max-w-[412px] h-auto min-h-[472px] bg-white border border-[#EEE] rounded-[10px] shadow-lg p-6 mt-6 mx-auto overflow-hidden">-->
<!--        <div class="mt-6 text-muted-foreground">-->
<!--            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">-->
<!--                Status: <span class="font-medium">Form Submitted; sending for verification</span>-->
<!--            </p>-->

<!--            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">-->
<!--                Applied Date: <span class="text-black font-medium">{{ application.created_at }}</span>-->
<!--            </p>-->

<!--            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">-->
<!--                Application ID: <span class="text-black font-medium">{{ application.application_id }}</span>-->
<!--            </p>-->

<!--        </div>-->
<!--        <h2 class="text-lg font-semibold text-zinc-800">Current Status</h2>-->
<!--        <div class="container">-->
<!--            <div class="flex flex-col md:grid grid-cols-12 text-gray-50">-->
<!--                <div class="flex md:contents">-->
<!--                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">-->
<!--                        <div class="h-full w-6 flex items-center justify-center">-->
<!--                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>-->
<!--                        </div>-->
<!--                        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">-->
<!--                            <i class="fas fa-check-circle text-white"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class=" col-start-4 col-end-12 p-4  my-4 mr-auto w-full">-->
<!--                        <h3 class="font-semibold text-lg mb-1 text-gray-400">Reservation Form Submitted</h3>-->
<!--                        <p class="text-zinc-600">Your reservation form has been submitted. Please wait for confirmation.</p>-->
<!--                        <span class="text-green-600">{{ application.created_at }}| 13:05</span>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="flex md:contents">-->
<!--                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">-->
<!--                        <div class="h-full w-6 flex items-center justify-center">-->
<!--                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>-->
<!--                        </div>-->
<!--                        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">-->
<!--                            <i class="fas fa-check-circle text-white"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-start-4 col-end-12 p-4  my-4 mr-auto w-full">-->
<!--                        <h3 class="font-semibold text-lg mb-1 text-gray-400">Confirmed by Official</h3>-->
<!--                        <p class="text-zinc-600">Your Reservation will be review by Mizoram House Staff.</p>-->
<!--                        <span class="text-green-600">{{ application.created_at }} | 06:49</span>-->
<!--                    </div>-->
<!--                </div>-->




<!--            </div>-->
<!--        </div>-->

<!--        <div class="p-4">-->
<!--            <hr>-->
<!--            <button-->
<!--                class="bg-secondary text-secondary-foreground hover:bg-secondary/80 w-full py-2 rounded-lg"-->
<!--                @click="$inertia.get(route('home'))"-->
<!--            >-->
<!--                View Detail-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
</template>

<style scoped>

</style>
