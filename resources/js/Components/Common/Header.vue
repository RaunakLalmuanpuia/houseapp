<script setup>
</script>

<template>
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between p-4">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <img @click="$inertia.get(route('home'))" src="/images/icons/app_logo.svg" alt="Mizoram House Emblem" class="w-48 h-auto cursor-pointer" />
            </div>

            <!-- Mobile Menu Button (Optional for later if needed)
            <div class="block md:hidden">
              <button class="text-black">Menu</button>
            </div> -->

            <!-- Navigation -->
            <nav class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 mt-4 md:mt-0">
                <button @click="$inertia.get(route('home'))" class="text-black font-medium text-[16px] leading-[24px] tracking-[0.15px] font-sans hover:text-blue-500">
                    Home
                </button>
                <button @click="$inertia.get(route('apply.step-one'))" class="text-black font-medium text-[16px] leading-[24px] tracking-[0.15px] font-sans hover:text-blue-500">
                    Reservation Form
                </button>
                <button @click="$inertia.get(route('status.index'))" class="text-black font-medium text-[16px] leading-[24px] tracking-[0.15px] font-sans hover:text-blue-500">
                    Status
                </button>
                <button @click="$inertia.get(route('status.index'))" class="text-black font-medium text-[16px] leading-[24px] tracking-[0.15px] font-sans hover:text-blue-500">
                    FAQs
                </button>
                <button @click="$inertia.get(route('status.index'))" class="text-black font-medium text-[16px] leading-[24px] tracking-[0.15px] font-sans hover:text-blue-500">
                    Download
                </button>
            </nav>
        </div>
        <div class="border-b border-zinc-300"></div>
    </div>
</template>

<style scoped>
</style>
