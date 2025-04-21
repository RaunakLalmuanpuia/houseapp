<script setup>
defineProps({
    application: Object,
});
</script>

<template>
<!--    {{application}}-->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32" >
        <!-- Div 1 -->
        <div class="rounded-lg shadow-md mt-4">
            <div class="p-4 rounded-lg shadow-md" style="background: #E8E5FF">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-primary font-bold text-xl">ON DUTY</h2>
                        <p class="text-muted-foreground">Officials traveling for work</p>
                    </div>
                    <div class="text-right">
                        <span class="text-muted">Application ID</span><br />
                        <span class="font-bold">{{ application.application_id }}</span>
                    </div>
                </div>
            </div>

            <div class="p-4  text-foreground mt-4">
                <div class="flex justify-between items-center mb-2">
                    <h1 class="text-xl font-bold">
                        {{ application.applicant_name }},
                        <span class="font-light">{{ application.gender }}</span>
                    </h1>
                    <span class="inline-block bg-accent text-accent-foreground text-sm rounded-full px-3 py-1 ml-4 whitespace-nowrap bg-yellow-200 text-zinc-700">
                    {{ application.status }}
                </span>
                    <!--                    <span class="bg-zinc-200 text-zinc-700 px-2 py-1 rounded-full text-sm">Estimated Amount</span>-->
                </div>

                <p class="text-lg">{{ application.department }},,</p>
                <p class="text-lg">{{ application.designation }}</p>
                <p class="text-lg font-medium">{{ application.contact }}</p>
            </div>

            <hr class="m-2" />
            <div class="p-6  flex items-start justify-between">
                <!-- Period -->
                <div class="flex items-start space-x-2">
                    <!-- Icon -->
                    <div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5855 5.65034H16.1575V4.61287C16.1575 4.41982 15.9881 4.2356 15.7891 4.24445C15.692 4.24633 15.5994 4.28575 15.5307 4.35444C15.462 4.42313 15.4226 4.51575 15.4207 4.61287V5.65034H10.2628V4.61287C10.2628 4.41982 10.0933 4.2356 9.89439 4.24445C9.79726 4.24633 9.70465 4.28575 9.63596 4.35444C9.56727 4.42313 9.52785 4.51575 9.52596 4.61287V5.65034H8.09796C7.60959 5.65093 7.14138 5.84519 6.79605 6.19053C6.45071 6.53586 6.25644 7.00407 6.25586 7.49245V15.5977C6.25586 16.6138 7.0826 17.4398 8.09796 17.4398H17.5848C18.6009 17.4398 19.4269 16.6138 19.4269 15.5977V7.49245C19.4269 7.00402 19.2329 6.53558 18.8876 6.19014C18.5423 5.8447 18.074 5.65054 17.5855 5.65034ZM8.09796 6.38718H9.52596V6.82339C9.52596 7.01645 9.69544 7.20066 9.89439 7.19181C10.0941 7.18297 10.2628 7.02971 10.2628 6.82339V6.38718H15.4207V6.82339C15.4207 7.01645 15.5902 7.20066 15.7891 7.19181C15.9888 7.18297 16.1575 7.02971 16.1575 6.82339V6.38718H17.5848C18.1942 6.38718 18.6901 6.88308 18.6901 7.49245V8.6596H6.9927V7.49245C6.9927 6.88308 7.4886 6.38718 8.09796 6.38718ZM17.5855 16.703H8.09796C7.4886 16.703 6.9927 16.2071 6.9927 15.5977V9.39645H18.6901V15.5977C18.6901 15.8907 18.5737 16.1717 18.3666 16.379C18.1595 16.5862 17.8785 16.7028 17.5855 16.703Z" fill="black"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-muted-foreground block">Period</span>
                        <span class="font-bold">{{ application.start_date }} - <br> {{ application.end_date }}</span>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex items-start space-x-2 text-right">
                    <div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6996 11.1C14.6996 11.8161 14.4151 12.5028 13.9088 13.0092C13.4025 13.5155 12.7157 13.8 11.9996 13.8C11.2835 13.8 10.5968 13.5155 10.0904 13.0092C9.58407 12.5028 9.29961 11.8161 9.29961 11.1C9.29961 10.3839 9.58407 9.69713 10.0904 9.19078C10.5968 8.68443 11.2835 8.39997 11.9996 8.39997C12.7157 8.39997 13.4025 8.68443 13.9088 9.19078C14.4151 9.69713 14.6996 10.3839 14.6996 11.1ZM13.7996 11.1C13.7996 10.6226 13.61 10.1647 13.2724 9.82718C12.9348 9.48961 12.477 9.29997 11.9996 9.29997C11.5222 9.29997 11.0644 9.48961 10.7268 9.82718C10.3893 10.1647 10.1996 10.6226 10.1996 11.1C10.1996 11.5774 10.3893 12.0352 10.7268 12.3728C11.0644 12.7103 11.5222 12.9 11.9996 12.9C12.477 12.9 12.9348 12.7103 13.2724 12.3728C13.61 12.0352 13.7996 11.5774 13.7996 11.1ZM16.4546 15.5595C17.6362 14.3772 18.3 12.7742 18.3 11.1027C18.3 9.43118 17.6362 7.8281 16.4546 6.64587C15.8696 6.06079 15.1751 5.59668 14.4107 5.28004C13.6463 4.96339 12.827 4.80042 11.9996 4.80042C11.1722 4.80042 10.3529 4.96339 9.58856 5.28004C8.82416 5.59668 8.12963 6.06079 7.54461 6.64587C6.36299 7.8281 5.69922 9.43118 5.69922 11.1027C5.69922 12.7742 6.36299 14.3772 7.54461 15.5595L8.91351 16.9086L10.7522 18.6951L10.8719 18.8013C11.5694 19.3665 12.5909 19.3305 13.2479 18.6951L15.4394 16.5621L16.4546 15.5595ZM8.17911 7.28037C8.68062 6.7783 9.27618 6.38 9.93173 6.10825C10.5873 5.8365 11.29 5.69662 11.9996 5.69662C12.7093 5.69662 13.4119 5.8365 14.0675 6.10825C14.723 6.38 15.3186 6.7783 15.8201 7.28037C16.8049 8.2665 17.3711 9.5947 17.4007 10.9881C17.4302 12.3814 16.9207 13.7324 15.9785 14.7594L15.8201 14.925L14.6312 16.0986L12.6242 18.0507L12.5396 18.1227C12.3837 18.2394 12.1942 18.3024 11.9995 18.3022C11.8047 18.3021 11.6153 18.2387 11.4596 18.1218L11.3759 18.0498L8.69391 15.4353L8.17911 14.925L8.02071 14.7603C7.07851 13.7333 6.56906 12.3823 6.59857 10.989C6.62808 9.5956 7.19427 8.2665 8.17911 7.28037Z" fill="black"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-muted-foreground block">Destination</span>
                        <span class="font-bold">{{ application.location }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Div 2 -->
        <div>
            <div class="p-4 space-y-4">
                <div class="border border-zinc-300 rounded-lg p-4">
                    <span class="bg-zinc-200 text-zinc-700 px-2 py-1 rounded-full text-sm">Estimated Amount</span>
                    <div class="text-xl font-bold">₹ 1,800</div>
                </div>
                <div class="border border-zinc-300 rounded-lg p-4">
                    <span class="bg-zinc-200 text-zinc-700 px-2 py-1 rounded-full text-sm">Document Upload</span>
                    <div class="flex items-center mt-2">
                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79297 19.25H13.209C14.1372 19.25 15.0275 18.8813 15.6838 18.2249C16.3402 17.5685 16.709 16.6783 16.709 15.75V10.22C16.7093 9.29186 16.341 8.40159 15.685 7.745L9.71597 1.775C9.39094 1.45 9.00508 1.19221 8.58041 1.01634C8.15575 0.840469 7.70061 0.749967 7.24097 0.75H4.79297C3.86471 0.75 2.97447 1.11875 2.3181 1.77513C1.66172 2.4315 1.29297 3.32174 1.29297 4.25V15.75C1.29297 16.6783 1.66172 17.5685 2.3181 18.2249C2.97447 18.8813 3.86471 19.25 4.79297 19.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.68945 1.11V6.77C8.68945 7.30043 8.90017 7.80914 9.27524 8.18421C9.65031 8.55929 10.159 8.77 10.6895 8.77H16.3515" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.25 14.5V13.5M4.25 13.5V11.5H5.25C5.51522 11.5 5.76957 11.6054 5.95711 11.7929C6.14464 11.9804 6.25 12.2348 6.25 12.5C6.25 12.7652 6.14464 13.0196 5.95711 13.2071C5.76957 13.3946 5.51522 13.5 5.25 13.5H4.25ZM12.25 14.5V13.25M12.25 13.25V11.5H13.75M12.25 13.25H13.75M8.25 14.5V11.5H8.75C9.14782 11.5 9.52936 11.658 9.81066 11.9393C10.092 12.2206 10.25 12.6022 10.25 13C10.25 13.3978 10.092 13.7794 9.81066 14.0607C9.52936 14.342 9.14782 14.5 8.75 14.5H8.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <span class="text-zinc-700 px-2">Approval from Administrative Head</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    Other Official Table-->
    <div class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32 mt-4">
        <h2 class="text-2xl font-bold mb-4">Another Officials</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-zinc-300">
                <thead class="bg-zinc-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b text-left">NAME</th>
                    <th class="py-2 px-4 border-b text-left">GENDER</th>
                    <th class="py-2 px-4 border-b text-left">DESIGNATION</th>
                    <th class="py-2 px-4 border-b text-left">DEPARTMENT</th>
                    <th class="py-2 px-4 border-b text-left">CONTACT NO.</th>
                    <th class="py-2 px-4 border-b text-left">DOCUMENT</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-zinc-100" v-for="member in application.on_duty_details" :key="member.id" >
                    <td class="py-2 px-4 border-b text-left">{{member.name}}</td>
                    <td class="py-2 px-4 border-b text-left">{{member.gender}}</td>
                    <td class="py-2 px-4 border-b text-left">{{member.designation}}</td>
                    <td class="py-2 px-4 border-b text-left">{{member.department}}</td>
                    <td class="py-2 px-4 border-b text-left">{{member.contact}}</td>
                    <td class="py-2 px-4 border-b text-left">
                        <a href="#" class="text-blue-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.79297 21.25H16.209C17.1372 21.25 18.0275 20.8813 18.6838 20.2249C19.3402 19.5685 19.709 18.6783 19.709 17.75V12.22C19.7093 11.2919 19.341 10.4016 18.685 9.745L12.716 3.775C12.3909 3.45 12.0051 3.19221 11.5804 3.01634C11.1558 2.84047 10.7006 2.74997 10.241 2.75H7.79297C6.86471 2.75 5.97447 3.11875 5.3181 3.77513C4.66172 4.4315 4.29297 5.32174 4.29297 6.25V17.75C4.29297 18.6783 4.66172 19.5685 5.3181 20.2249C5.97447 20.8813 6.86471 21.25 7.79297 21.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.6895 3.10999V8.76999C11.6895 9.30042 11.9002 9.80913 12.2752 10.1842C12.6503 10.5593 13.159 10.77 13.6895 10.77H19.3515" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.25 16.5V15.5M7.25 15.5V13.5H8.25C8.51522 13.5 8.76957 13.6054 8.95711 13.7929C9.14464 13.9804 9.25 14.2348 9.25 14.5C9.25 14.7652 9.14464 15.0196 8.95711 15.2071C8.76957 15.3946 8.51522 15.5 8.25 15.5H7.25ZM15.25 16.5V15.25M15.25 15.25V13.5H16.75M15.25 15.25H16.75M11.25 16.5V13.5H11.75C12.1478 13.5 12.5294 13.658 12.8107 13.9393C13.092 14.2206 13.25 14.6022 13.25 15C13.25 15.3978 13.092 15.7794 12.8107 16.0607C12.5294 16.342 12.1478 16.5 11.75 16.5H11.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>


    <!--    Other Family Table-->
    <div class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32 mt-4">
        <h2 class="text-2xl font-bold mb-4">Family</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-zinc-300">
                <thead class="bg-zinc-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b text-left">NAME</th>
                    <th class="py-2 px-4 border-b text-left">GENDER</th>
                    <th class="py-2 px-4 border-b text-left">RELATIONSHIP</th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-zinc-100" v-for="member in application.family_members" :key="member.id">
                    <td class="py-2 px-4 border-b text-left">{{ member.name }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ member.gender || 'N/A' }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ member.relation }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
