<template>
    <!-- Footer -->
    <div>
        <!-- Top Section -->
        <div class="flex flex-col items-center py-8">
            <img aria-hidden="true" alt="Government Emblem" src="/images/icons/emblem.svg" class="w-8 h-auto" />
            <h2 class="mt-4 text-lg font-semibold text-center">An initiative of</h2>
            <p class="mt-2 text-muted-foreground text-center px-4">Department of General Administrative Department, Government of Mizoram</p>
        </div>

        <!-- Bottom Section -->
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-background text-muted-foreground space-y-4 md:space-y-0">
                <!-- Left side: MSeGS Logo + Text -->
                <div class="flex items-center p-3">
                    <img aria-hidden="true" alt="MSeGS Logo" src="/images/icons/msegs_logo.svg" class="mr-2 w-10 h-auto" />
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm">Crafted with care by</span>
                        <strong>Mizoram State e-Governance Society (MSeGS)</strong>
                    </div>
                </div>

                <!-- Right side: Links -->
                <div class="flex flex-col md:flex-row md:space-x-4 items-center space-y-2 md:space-y-0">
                    <a href="#" class="text-muted-foreground hover:text-muted">About Us</a>
                    <a href="#" class="text-muted-foreground hover:text-muted">Contact Us</a>
                    <button @click="login" class="text-muted-foreground hover:text-muted">Login for Officials</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";

const login = () => {
    router.visit(route('login'));
}
</script>
