<script setup>
</script>

<template>
    <div class="flex flex-col">
        <h2 class="text-lg font-semibold mb-4">Officials On Duty & Not On Duty</h2>
        <hr class="border-b border-border mb-4" />

        <ol class="list-decimal list-inside space-y-4">
            <!-- A. Officials On Duty -->
            <li>
                <span class="font-medium">Officials On Duty:</span>
                <ul class="list-disc list-inside ml-4 space-y-2 mt-2">
                    <li><span class="font-medium">Detailment Order:</span> Approved by the concerned department.</li>
                    <li><span class="font-medium">Tour Programme:</span> Official schedule.</li>
                    <li><span class="font-medium">Approval from Administrative Head:</span> Confirmation of the official tour.</li>
                </ul>
                <div class="mt-2">
                    <span class="font-medium">Special Rules:</span>
                    <ul class="list-disc list-inside ml-4 space-y-1 mt-1">
                        <li>Only the official gets the "On Duty" rate.</li>
                        <li>Family members will be charged as "Officials Not On Duty."</li>
                    </ul>
                </div>
            </li>

            <!-- B. Officials Not On Duty -->
            <li>
                <span class="font-medium">Officials Not On Duty:</span>
                <ul class="list-disc list-inside ml-4 space-y-2 mt-2">
                    <li><span class="font-medium">Valid Identity Card:</span> Proof of identity.</li>
                </ul>
                <div class="mt-2">
                    <span class="font-medium">Special Rules:</span>
                    <ul class="list-disc list-inside ml-4 space-y-1 mt-1">
                        <li>Government officials traveling for personal reasons.</li>
                        <li>Charged higher rates than "On Duty" officials.</li>
                    </ul>
                </div>
            </li>
        </ol>
    </div>
</template>

<style scoped>
/* No extra styles needed, inherited from parent */
</style>
