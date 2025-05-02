<script setup>

</script>

<template>
    <div class="bg-[#1F3652] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center md:items-start justify-between gap-4 md:gap-20">
            <div class="flex-1 w-full md:max-w-xl text-white">
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">
                    Chibai! Kan lo lawm a che!
                </h1>
                <p class="text-base md:text-lg font-normal leading-relaxed max-w-md mb-20">
                    Effortless Reservations, Peaceful Stays
                    <br/>
                    Mizoram House for You
                </p>
            </div>

            <div class="flex gap-6">
                <a @click="$inertia.visit(route('apply.step-one'))" class="flex flex-col justify-center rounded-xl bg-[#0059d9] px-8 py-10 w-40 md:w-48 text-white cursor-pointer hover:brightness-110 transition">
                    <div class="flex items-center justify-between text-xl font-bold mb-1">
                        <span>Form</span>
                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.6 6L0 1.4L1.4 0L7.4 6L1.4 12L0 10.6L4.6 6Z" fill="white"/>
                        </svg>

                    </div>
                    <span class="text-sm font-normal">Reservation Form</span>
                </a>

                <a @click="$inertia.visit(route('status.index'))" class="flex flex-col justify-center rounded-xl bg-[#df8a0f] px-8 py-10 w-40 md:w-48 text-white cursor-pointer hover:brightness-110 transition" href="#">
                    <div class="flex items-center justify-between text-xl font-bold mb-1">
                        <span>Status</span>
                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.6 6L0 1.4L1.4 0L7.4 6L1.4 12L0 10.6L4.6 6Z" fill="white"/>
                        </svg>
                    </div>
                    <span class="text-sm font-normal">Check for Status</span>
                </a>
            </div>
        </div>



        <!-- Now shifted towards right -->
        <img
            src="/images/icons/dance.png"
            alt="Outline drawing of people dancing"
            class="absolute bottom-0 left-20 md:left-20 w-72 md:w-96 opacity-300  pointer-events-none select-none"
        />
    </div>
</template>

<style scoped>

</style>
