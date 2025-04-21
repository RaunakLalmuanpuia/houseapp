<script setup>
defineProps({
    application: Object,
});
</script>

<template>
    <div class="w-full max-w-[412px] h-auto min-h-[472px] bg-white border border-[#EEE] rounded-[10px] shadow-lg p-6 mt-6 mx-auto overflow-hidden">
        <div class="mt-6 text-muted-foreground">
            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">
                Status: <span class="font-medium">Form Submitted; sending for verification</span>
            </p>

            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">
                Applied Date: <span class="text-black font-medium">{{ application.created_at }}</span>
            </p>

            <p class="text-[#313033] font-['Noto_Sans'] text-[12px] font-normal leading-none">
                Application ID: <span class="text-black font-medium">{{ application.application_id }}</span>
            </p>
            <!--            <p> <span class="font-medium"></span></p>-->
        </div>
        <h2 class="text-lg font-semibold text-zinc-800">Current Status</h2>
        <div class="container">
            <div class="flex flex-col md:grid grid-cols-12 text-gray-50">
                <div class="flex md:contents">
                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                        <div class="h-full w-6 flex items-center justify-center">
                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                        </div>
                        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                    <div class=" col-start-4 col-end-12 p-4  my-4 mr-auto w-full">
                        <h3 class="font-semibold text-lg mb-1 text-gray-400">Reservation Form Submitted</h3>
                        <p class="text-zinc-600">Your reservation form has been submitted. Please wait for confirmation.</p>
                        <span class="text-green-600">{{ application.created_at }} | 13:05</span>
                    </div>
                </div>

                <div class="flex md:contents">
                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                        <div class="h-full w-6 flex items-center justify-center">
                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                        </div>
                        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                    <div class="col-start-4 col-end-12 p-4  my-4 mr-auto w-full">
                        <h3 class="font-semibold text-lg mb-1 text-gray-400">Confirmed by Official</h3>
                        <p class="text-zinc-600">Your Reservation will be review by Mizoram House Staff.</p>
                        <span class="text-green-600">{{ application.created_at }} | 06:49</span>
                    </div>
                </div>

                <div class="flex md:contents">
                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                        <div class="h-full w-6 flex items-center justify-center">
                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                        </div>
                        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">
                            <i class="fas fa-times-circle text-white"></i>
                        </div>
                    </div>
                    <div class="col-start-4 col-end-12 p-4  my-4 mr-auto  w-full">
                        <h3 class="font-semibold text-lg mb-1 text-gray-400">Approved</h3>
                        <p class="text-zinc-600">Your Reservation is confirmed. Enjoy your stay!</p>
                        <span class="text-green-600">{{ application.created_at }} | 06:49</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="p-4">
            <hr>
            <button
                class="bg-secondary text-secondary-foreground hover:bg-secondary/80 w-full py-2 rounded-lg"
                @click="$inertia.get(route('home'))"
            >
                View Detail
            </button>
        </div>
    </div>

</template>

<style scoped>

</style>
