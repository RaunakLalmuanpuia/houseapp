<script setup>
</script>

<template>
    <div class="flex flex-col">
        <h2 class="text-lg font-semibold mb-4">Medical (Referred Patients) & Private (Others)</h2>
        <hr class="border-b border-border mb-4" />

        <ol class="list-decimal list-inside space-y-4">
            <!-- C. Medical (Referred Patients) -->
            <li>
                <span class="font-medium">Medical (Referred Patients):</span>
                <ul class="list-disc list-inside ml-4 space-y-2 mt-2">
                    <li><span class="font-medium">Provisional Permission:</span> Issued by the Directorate of Hospital & Medical Education, Mizoram.</li>
                    <li><span class="font-medium">Medical Board Referral:</span> Official document from the Government Medical Board.</li>
                    <li><span class="font-medium">Attendant Approval:</span> Number of attendants allowed as per referral.</li>
                </ul>
                <div class="mt-2">
                    <span class="font-medium">Special Rules:</span>
                    <ul class="list-disc list-inside ml-4 space-y-1 mt-1">
                        <li>Only officially referred patients qualify.</li>
                        <li>Attendants are limited based on approval.</li>
                    </ul>
                </div>
            </li>

            <!-- D. Private (Others) -->
            <li>
                <span class="font-medium">Private (Others):</span>
                <ul class="list-disc list-inside ml-4 space-y-2 mt-2">
                    <li><span class="font-medium">Valid Identity Card:</span> Required for check-in and payment.</li>
                </ul>
                <div class="mt-2">
                    <span class="font-medium">Special Rules:</span>
                    <ul class="list-disc list-inside ml-4 space-y-1 mt-1">
                        <li>No official or medical referral needed.</li>
                        <li>Charged the highest room rates.</li>
                    </ul>
                </div>
            </li>
        </ol>
    </div>
</template>

<style scoped>
/* No extra styles needed */
</style>
