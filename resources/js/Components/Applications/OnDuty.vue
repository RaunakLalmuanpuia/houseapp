<script setup>
defineProps({
    application: Object,
});
</script>

<template>
<!--    {{application}}-->
<!--    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32" >-->
<!--        &lt;!&ndash; Div 1 &ndash;&gt;-->
<!--        <div class="rounded-lg shadow-md mt-4">-->
<!--            <div class="p-4 rounded-lg shadow-md" style="background: #E8E5FF">-->
<!--                <div class="flex justify-between items-center">-->
<!--                    <div>-->
<!--                        <h2 class="text-primary font-bold text-xl">ON DUTY</h2>-->
<!--                        <p class="text-muted-foreground">Officials traveling for work</p>-->
<!--                    </div>-->
<!--                    <div class="text-right">-->
<!--                        <span class="text-muted">Application ID</span><br />-->
<!--                        <span class="font-bold">{{ application.application_id }}</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="p-4  text-foreground mt-4">-->
<!--                <div class="flex justify-between items-center mb-2">-->
<!--                    <h1 class="text-xl font-bold">-->
<!--                        {{ application.applicant_name }},-->
<!--                        <span class="font-light">{{ application.gender }}</span>-->
<!--                    </h1>-->
<!--                    <span class="inline-block bg-accent text-accent-foreground text-sm rounded-full px-3 py-1 ml-4 whitespace-nowrap bg-yellow-200 text-zinc-700">-->
<!--                    {{ application.status }}-->
<!--                </span>-->
<!--                    &lt;!&ndash;                    <span class="bg-zinc-200 text-zinc-700 px-2 py-1 rounded-full text-sm">Estimated Amount</span>&ndash;&gt;-->
<!--                </div>-->

<!--                <p class="text-lg">{{ application.department }},</p>-->
<!--                <p class="text-lg">{{ application.designation }}</p>-->
<!--                <p class="text-lg font-medium">{{ application.contact }}</p>-->
<!--            </div>-->

<!--            <hr class="m-2" />-->
<!--            <div class="p-6  flex items-start justify-between">-->
<!--                &lt;!&ndash; Period &ndash;&gt;-->
<!--                <div class="flex items-start space-x-2">-->
<!--                    &lt;!&ndash; Icon &ndash;&gt;-->
<!--                    <div>-->
<!--                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <path d="M17.5855 5.65034H16.1575V4.61287C16.1575 4.41982 15.9881 4.2356 15.7891 4.24445C15.692 4.24633 15.5994 4.28575 15.5307 4.35444C15.462 4.42313 15.4226 4.51575 15.4207 4.61287V5.65034H10.2628V4.61287C10.2628 4.41982 10.0933 4.2356 9.89439 4.24445C9.79726 4.24633 9.70465 4.28575 9.63596 4.35444C9.56727 4.42313 9.52785 4.51575 9.52596 4.61287V5.65034H8.09796C7.60959 5.65093 7.14138 5.84519 6.79605 6.19053C6.45071 6.53586 6.25644 7.00407 6.25586 7.49245V15.5977C6.25586 16.6138 7.0826 17.4398 8.09796 17.4398H17.5848C18.6009 17.4398 19.4269 16.6138 19.4269 15.5977V7.49245C19.4269 7.00402 19.2329 6.53558 18.8876 6.19014C18.5423 5.8447 18.074 5.65054 17.5855 5.65034ZM8.09796 6.38718H9.52596V6.82339C9.52596 7.01645 9.69544 7.20066 9.89439 7.19181C10.0941 7.18297 10.2628 7.02971 10.2628 6.82339V6.38718H15.4207V6.82339C15.4207 7.01645 15.5902 7.20066 15.7891 7.19181C15.9888 7.18297 16.1575 7.02971 16.1575 6.82339V6.38718H17.5848C18.1942 6.38718 18.6901 6.88308 18.6901 7.49245V8.6596H6.9927V7.49245C6.9927 6.88308 7.4886 6.38718 8.09796 6.38718ZM17.5855 16.703H8.09796C7.4886 16.703 6.9927 16.2071 6.9927 15.5977V9.39645H18.6901V15.5977C18.6901 15.8907 18.5737 16.1717 18.3666 16.379C18.1595 16.5862 17.8785 16.7028 17.5855 16.703Z" fill="black"/>-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <span class="text-muted-foreground block">Period</span>-->
<!--                        <span class="font-bold">{{ application.start_date }} - <br> {{ application.end_date }}</span>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Location &ndash;&gt;-->
<!--                <div class="flex items-start space-x-2 text-right">-->
<!--                    <div>-->
<!--                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <path d="M14.6996 11.1C14.6996 11.8161 14.4151 12.5028 13.9088 13.0092C13.4025 13.5155 12.7157 13.8 11.9996 13.8C11.2835 13.8 10.5968 13.5155 10.0904 13.0092C9.58407 12.5028 9.29961 11.8161 9.29961 11.1C9.29961 10.3839 9.58407 9.69713 10.0904 9.19078C10.5968 8.68443 11.2835 8.39997 11.9996 8.39997C12.7157 8.39997 13.4025 8.68443 13.9088 9.19078C14.4151 9.69713 14.6996 10.3839 14.6996 11.1ZM13.7996 11.1C13.7996 10.6226 13.61 10.1647 13.2724 9.82718C12.9348 9.48961 12.477 9.29997 11.9996 9.29997C11.5222 9.29997 11.0644 9.48961 10.7268 9.82718C10.3893 10.1647 10.1996 10.6226 10.1996 11.1C10.1996 11.5774 10.3893 12.0352 10.7268 12.3728C11.0644 12.7103 11.5222 12.9 11.9996 12.9C12.477 12.9 12.9348 12.7103 13.2724 12.3728C13.61 12.0352 13.7996 11.5774 13.7996 11.1ZM16.4546 15.5595C17.6362 14.3772 18.3 12.7742 18.3 11.1027C18.3 9.43118 17.6362 7.8281 16.4546 6.64587C15.8696 6.06079 15.1751 5.59668 14.4107 5.28004C13.6463 4.96339 12.827 4.80042 11.9996 4.80042C11.1722 4.80042 10.3529 4.96339 9.58856 5.28004C8.82416 5.59668 8.12963 6.06079 7.54461 6.64587C6.36299 7.8281 5.69922 9.43118 5.69922 11.1027C5.69922 12.7742 6.36299 14.3772 7.54461 15.5595L8.91351 16.9086L10.7522 18.6951L10.8719 18.8013C11.5694 19.3665 12.5909 19.3305 13.2479 18.6951L15.4394 16.5621L16.4546 15.5595ZM8.17911 7.28037C8.68062 6.7783 9.27618 6.38 9.93173 6.10825C10.5873 5.8365 11.29 5.69662 11.9996 5.69662C12.7093 5.69662 13.4119 5.8365 14.0675 6.10825C14.723 6.38 15.3186 6.7783 15.8201 7.28037C16.8049 8.2665 17.3711 9.5947 17.4007 10.9881C17.4302 12.3814 16.9207 13.7324 15.9785 14.7594L15.8201 14.925L14.6312 16.0986L12.6242 18.0507L12.5396 18.1227C12.3837 18.2394 12.1942 18.3024 11.9995 18.3022C11.8047 18.3021 11.6153 18.2387 11.4596 18.1218L11.3759 18.0498L8.69391 15.4353L8.17911 14.925L8.02071 14.7603C7.07851 13.7333 6.56906 12.3823 6.59857 10.989C6.62808 9.5956 7.19427 8.2665 8.17911 7.28037Z" fill="black"/>-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <span class="text-muted-foreground block">Destination</span>-->
<!--                        <span class="font-bold">{{ application.location }}</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; Div 2 &ndash;&gt;-->
<!--        <div>-->
<!--            <div class="p-4 space-y-4">-->
<!--&lt;!&ndash;                <div class="border border-zinc-300 rounded-lg p-4">&ndash;&gt;-->
<!--&lt;!&ndash;                    <span class="bg-zinc-200 text-zinc-700 px-2 py-1 rounded-full text-sm">Estimated Amount</span>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="text-xl font-bold">₹ 1,800</div>&ndash;&gt;-->
<!--&lt;!&ndash;                </div>&ndash;&gt;-->
<!--                <div class="border border-zinc-300 rounded-lg p-4">-->
<!--                    <span class="bg-zinc-200 text-zinc-700 px-2 py-1 rounded-full text-sm">Document Upload</span>-->
<!--                    <div class="flex items-center mt-2">-->
<!--                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <path d="M4.79297 19.25H13.209C14.1372 19.25 15.0275 18.8813 15.6838 18.2249C16.3402 17.5685 16.709 16.6783 16.709 15.75V10.22C16.7093 9.29186 16.341 8.40159 15.685 7.745L9.71597 1.775C9.39094 1.45 9.00508 1.19221 8.58041 1.01634C8.15575 0.840469 7.70061 0.749967 7.24097 0.75H4.79297C3.86471 0.75 2.97447 1.11875 2.3181 1.77513C1.66172 2.4315 1.29297 3.32174 1.29297 4.25V15.75C1.29297 16.6783 1.66172 17.5685 2.3181 18.2249C2.97447 18.8813 3.86471 19.25 4.79297 19.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M8.68945 1.11V6.77C8.68945 7.30043 8.90017 7.80914 9.27524 8.18421C9.65031 8.55929 10.159 8.77 10.6895 8.77H16.3515" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M4.25 14.5V13.5M4.25 13.5V11.5H5.25C5.51522 11.5 5.76957 11.6054 5.95711 11.7929C6.14464 11.9804 6.25 12.2348 6.25 12.5C6.25 12.7652 6.14464 13.0196 5.95711 13.2071C5.76957 13.3946 5.51522 13.5 5.25 13.5H4.25ZM12.25 14.5V13.25M12.25 13.25V11.5H13.75M12.25 13.25H13.75M8.25 14.5V11.5H8.75C9.14782 11.5 9.52936 11.658 9.81066 11.9393C10.092 12.2206 10.25 12.6022 10.25 13C10.25 13.3978 10.092 13.7794 9.81066 14.0607C9.52936 14.342 9.14782 14.5 8.75 14.5H8.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                        </svg>-->

<!--                        <span class="text-zinc-700 px-2">Approval from Administrative Head</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--&lt;!&ndash;{{application}}&ndash;&gt;-->
<!--    &lt;!&ndash;    Other Official Table&ndash;&gt;-->
<!--    <div v-if="application.on_duty_details.length !== 0" class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32 mt-4">-->
<!--        <h2 class="text-2xl font-bold mb-4">Another Officials</h2>-->
<!--        <div class="overflow-x-auto">-->
<!--            <table class="min-w-full bg-white border border-zinc-300">-->
<!--                <thead class="bg-zinc-800 text-white">-->
<!--                <tr>-->
<!--                    <th class="py-2 px-4 border-b text-left">NAME</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">GENDER</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">DESIGNATION</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">DEPARTMENT</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">CONTACT NO.</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">DOCUMENT</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr class="bg-zinc-100" v-for="member in application.on_duty_details" :key="member.id" >-->
<!--                    <td class="py-2 px-4 border-b text-left">{{member.name}}</td>-->
<!--                    <td class="py-2 px-4 border-b text-left">{{member.gender}}</td>-->
<!--                    <td class="py-2 px-4 border-b text-left">{{member.designation}}</td>-->
<!--                    <td class="py-2 px-4 border-b text-left">{{member.department}}</td>-->
<!--                    <td class="py-2 px-4 border-b text-left">{{member.contact}}</td>-->
<!--                    <td class="py-2 px-4 border-b">-->
<!--                        <a href="#" class="text-blue-500"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <path d="M7.79297 21.25H16.209C17.1372 21.25 18.0275 20.8813 18.6838 20.2249C19.3402 19.5685 19.709 18.6783 19.709 17.75V12.22C19.7093 11.2919 19.341 10.4016 18.685 9.745L12.716 3.775C12.3909 3.45 12.0051 3.19221 11.5804 3.01634C11.1558 2.84047 10.7006 2.74997 10.241 2.75H7.79297C6.86471 2.75 5.97447 3.11875 5.3181 3.77513C4.66172 4.4315 4.29297 5.32174 4.29297 6.25V17.75C4.29297 18.6783 4.66172 19.5685 5.3181 20.2249C5.97447 20.8813 6.86471 21.25 7.79297 21.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M11.6895 3.10999V8.76999C11.6895 9.30042 11.9002 9.80913 12.2752 10.1842C12.6503 10.5593 13.159 10.77 13.6895 10.77H19.3515" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M7.25 16.5V15.5M7.25 15.5V13.5H8.25C8.51522 13.5 8.76957 13.6054 8.95711 13.7929C9.14464 13.9804 9.25 14.2348 9.25 14.5C9.25 14.7652 9.14464 15.0196 8.95711 15.2071C8.76957 15.3946 8.51522 15.5 8.25 15.5H7.25ZM15.25 16.5V15.25M15.25 15.25V13.5H16.75M15.25 15.25H16.75M11.25 16.5V13.5H11.75C12.1478 13.5 12.5294 13.658 12.8107 13.9393C13.092 14.2206 13.25 14.6022 13.25 15C13.25 15.3978 13.092 15.7794 12.8107 16.0607C12.5294 16.342 12.1478 16.5 11.75 16.5H11.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                        </svg>-->
<!--                        </a>-->
<!--                    </td>-->
<!--                </tr>-->

<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->


<!--    &lt;!&ndash;    Other Family Table&ndash;&gt;-->
<!--    <div v-if="application.family_members.length !== 0" class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32 mt-4">-->
<!--        <h2 class="text-2xl font-bold mb-4">Family</h2>-->
<!--        <div class="overflow-x-auto">-->
<!--            <table class="min-w-full bg-white border border-zinc-300">-->
<!--                <thead class="bg-zinc-800 text-white">-->
<!--                <tr>-->
<!--                    <th class="py-2 px-4 border-b text-left">NAME</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">GENDER</th>-->
<!--                    <th class="py-2 px-4 border-b text-left">RELATIONSHIP</th>-->

<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr class="bg-zinc-100" v-for="member in application.family_members" :key="member.id">-->
<!--                    <td class="py-2 px-4 border-b text-left">{{ member.name }}</td>-->
<!--                    <td class="py-2 px-4 border-b text-left">{{ member.gender || 'N/A' }}</td>-->
<!--                    <td class="py-2 px-4 border-b text-left">{{ member.relation }}</td>-->
<!--                </tr>-->

<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->


    <div class="bg-white font-sans text-black px-4 sm:px-6 md:px-10 lg:px-16 py-6">
        <div class="max-w-7xl mx-auto">
            <section class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0 mb-12">
            <!-- Left card -->
            <article
                class="flex flex-col justify-between border border-gray-200 rounded-xl max-w-md w-full"
            >
                <header class="bg-indigo-200 rounded-t-xl px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-indigo-900 font-extrabold text-lg leading-5">
                                ON DUTY
                            </h2>
                            <p class="text-indigo-900 text-xs font-semibold leading-4">
                                Officials traveling for work
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-normal">Application ID</p>
                            <p class="font-extrabold text-base leading-5">{{ application.application_id }}</p>
                        </div>
                    </div>
                </header>
                <section class="px-6 py-4 border-b border-gray-200 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-extrabold text-base leading-5 text-black max-w-[220px]">
                                {{ application.applicant_name }}
                                <span class="italic font-normal text-sm text-gray-600">, {{ application.gender }}</span>
                            </h3>
                            <p class="text-sm leading-5 mt-1">
                                {{ application.designation }},<br />
                                {{ application.department }}<br />
                                {{ application.contact }}
                            </p>
                        </div>
                        <span
                            :class="[
                            'text-xs font-medium rounded-full px-3 py-1 self-start',
                            application.status === 'Pending' ? 'bg-orange-200 text-orange-600' :
                            application.status === 'Approved' ? 'bg-blue-200 text-blue-600' :
                            application.status === 'Confirmed' ? 'bg-green-200 text-green-600' :
                            application.status === 'Rejected' ? 'bg-red-200 text-red-600' :
                            'bg-gray-200 text-gray-600' // default
                          ]"
                                                >
                          {{ application.status }}
                        </span>

                    </div>
                </section>
                <section class="flex justify-between px-6 py-4 text-gray-600 text-sm border-t border-gray-200">
                    <div class="flex items-start space-x-2 max-w-[140px]">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.586 3.65034H12.158V2.61287C12.158 2.41982 11.9886 2.2356 11.7896 2.24445C11.6925 2.24633 11.5999 2.28575 11.5312 2.35444C11.4625 2.42313 11.4231 2.51575 11.4212 2.61287V3.65034H6.26329V2.61287C6.26329 2.41982 6.09382 2.2356 5.89487 2.24445C5.79775 2.24633 5.70514 2.28575 5.63645 2.35444C5.56776 2.42313 5.52834 2.51575 5.52645 2.61287V3.65034H4.09845C3.61008 3.65093 3.14187 3.84519 2.79653 4.19053C2.4512 4.53586 2.25693 5.00407 2.25635 5.49245V13.5977C2.25635 14.6138 3.08308 15.4398 4.09845 15.4398H13.5853C14.6014 15.4398 15.4274 14.6138 15.4274 13.5977V5.49245C15.4274 5.00402 15.2334 4.53558 14.8881 4.19014C14.5428 3.8447 14.0745 3.65054 13.586 3.65034ZM4.09845 4.38718H5.52645V4.82339C5.52645 5.01645 5.69593 5.20066 5.89487 5.19181C6.09456 5.18297 6.26329 5.02971 6.26329 4.82339V4.38718H11.4212V4.82339C11.4212 5.01645 11.5907 5.20066 11.7896 5.19181C11.9893 5.18297 12.158 5.02971 12.158 4.82339V4.38718H13.5853C14.1947 4.38718 14.6906 4.88308 14.6906 5.49245V6.6596H2.99319V5.49245C2.99319 4.88308 3.48908 4.38718 4.09845 4.38718ZM13.586 14.703H4.09845C3.48908 14.703 2.99319 14.2071 2.99319 13.5977V7.39645H14.6906V13.5977C14.6906 13.8907 14.5742 14.1717 14.3671 14.379C14.16 14.5862 13.879 14.7028 13.586 14.703Z" fill="black"/>
                        </svg>

                        <div>
                            <p class="font-semibold text-gray-500">Period</p>
                            <p class="font-bold text-black leading-5">
                                {{ application.start_date }} -<br />
                                {{ application.end_date }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2 max-w-[140px] text-right">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7001 8.10034C11.7001 8.81642 11.4156 9.50318 10.9093 10.0095C10.4029 10.5159 9.71618 10.8003 9.0001 10.8003C8.28401 10.8003 7.59726 10.5159 7.09091 10.0095C6.58456 9.50318 6.3001 8.81642 6.3001 8.10034C6.3001 7.38425 6.58456 6.6975 7.09091 6.19115C7.59726 5.6848 8.28401 5.40034 9.0001 5.40034C9.71618 5.40034 10.4029 5.6848 10.9093 6.19115C11.4156 6.6975 11.7001 7.38425 11.7001 8.10034ZM10.8001 8.10034C10.8001 7.62295 10.6105 7.16511 10.2729 6.82754C9.93532 6.48998 9.47749 6.30034 9.0001 6.30034C8.52271 6.30034 8.06487 6.48998 7.72731 6.82754C7.38974 7.16511 7.2001 7.62295 7.2001 8.10034C7.2001 8.57773 7.38974 9.03556 7.72731 9.37313C8.06487 9.71069 8.52271 9.90034 9.0001 9.90034C9.47749 9.90034 9.93532 9.71069 10.2729 9.37313C10.6105 9.03556 10.8001 8.57773 10.8001 8.10034ZM13.4551 12.5598C14.6367 11.3776 15.3005 9.77453 15.3005 8.10304C15.3005 6.43154 14.6367 4.82847 13.4551 3.64624C12.8701 3.06116 12.1755 2.59705 11.4112 2.2804C10.6468 1.96376 9.82748 1.80078 9.0001 1.80078C8.17272 1.80078 7.35344 1.96376 6.58904 2.2804C5.82465 2.59705 5.13012 3.06116 4.5451 3.64624C3.36348 4.82847 2.69971 6.43154 2.69971 8.10304C2.69971 9.77453 3.36348 11.3776 4.5451 12.5598L5.914 13.9089L7.7527 15.6954L7.8724 15.8016C8.5699 16.3668 9.5914 16.3308 10.2484 15.6954L12.4399 13.5624L13.4551 12.5598ZM5.1796 4.28074C5.68111 3.77866 6.27667 3.38036 6.93222 3.10861C7.58777 2.83686 8.29045 2.69699 9.0001 2.69699C9.70974 2.69699 10.4124 2.83686 11.068 3.10861C11.7235 3.38036 12.3191 3.77866 12.8206 4.28074C13.8054 5.26686 14.3716 6.59507 14.4011 7.98844C14.4307 9.38181 13.9212 10.7328 12.979 11.7597L12.8206 11.9253L11.6317 13.0989L9.6247 15.051L9.5401 15.123C9.38421 15.2397 9.19468 15.3027 8.99995 15.3026C8.80521 15.3024 8.61579 15.2391 8.4601 15.1221L8.3764 15.0501L5.6944 12.4356L5.1796 11.9253L5.0212 11.7606C4.079 10.7337 3.56954 9.38271 3.59905 7.98934C3.62857 6.59597 4.19476 5.26686 5.1796 4.28074Z" fill="black"/>
                        </svg>

                        <div>
                            <p class="font-semibold text-gray-500">Mizoram House</p>
                            <p class="font-bold text-black leading-5 text-start">{{application.location}}</p>
                        </div>
                    </div>
                </section>
            </article>

            <!-- Right cards container -->
            <div class="flex flex-col space-y-6 flex-1 max-w-lg w-full">

                <article
                    class="border border-gray-200 rounded-xl p-6 flex flex-col space-y-2"
                >
                  <span
                      class="bg-gray-200 text-gray-700 text-xs font-mono rounded-full px-3 py-1 inline-block mb-2"
                  >Document Upload</span
                  >
                    <p class="text-gray-600 flex items-center space-x-2 text-sm">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.79199 21.25H16.208C17.1363 21.25 18.0265 20.8813 18.6829 20.2249C19.3392 19.5685 19.708 18.6783 19.708 17.75V12.22C19.7083 11.2919 19.34 10.4016 18.684 9.745L12.715 3.775C12.39 3.45 12.0041 3.19221 11.5794 3.01634C11.1548 2.84047 10.6996 2.74997 10.24 2.75H7.79199C6.86373 2.75 5.9735 3.11875 5.31712 3.77513C4.66074 4.4315 4.29199 5.32174 4.29199 6.25V17.75C4.29199 18.6783 4.66074 19.5685 5.31712 20.2249C5.9735 20.8813 6.86373 21.25 7.79199 21.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.688 3.11035V8.77035C11.688 9.30079 11.8987 9.80949 12.2738 10.1846C12.6488 10.5596 13.1576 10.7704 13.688 10.7704H19.35" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.25 16.5V15.5M7.25 15.5V13.5H8.25C8.51522 13.5 8.76957 13.6054 8.95711 13.7929C9.14464 13.9804 9.25 14.2348 9.25 14.5C9.25 14.7652 9.14464 15.0196 8.95711 15.2071C8.76957 15.3946 8.51522 15.5 8.25 15.5H7.25ZM15.25 16.5V15.25M15.25 15.25V13.5H16.75M15.25 15.25H16.75M11.25 16.5V13.5H11.75C12.1478 13.5 12.5294 13.658 12.8107 13.9393C13.092 14.2206 13.25 14.6022 13.25 15C13.25 15.3978 13.092 15.7794 12.8107 16.0607C12.5294 16.342 12.1478 16.5 11.75 16.5H11.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Approval from Administrative Head</span>
                    </p>
                </article>
            </div>
        </section>

        <hr class="border-gray-300 mb-10" />

        <section v-if="application.on_duty_details.length !== 0" class="overflow-x-auto">
            <h4 class="font-semibold mb-4 text-base">Another Officials</h4>
            <table class="w-full border-collapse ">
                <thead>
                <tr class="bg-gray-700 text-white text-xs font-bold text-left">
                    <th class="py-2 px-3 whitespace-normal">NAME</th>
                    <th class="py-2 px-3 whitespace-normal">GENDER</th>
                    <th class="py-2 px-3 whitespace-normal" >DESIGNATION</th>
                    <th class="py-2 px-3 whitespace-normal">DEPARTMENT</th>
                    <th class="py-2 px-3 whitespace-normal">CONTACT NO.</th>
                    <th class="py-2 px-3 whitespace-normal">DOCUMENT</th>
                </tr>
                </thead>
                <tbody class="text-xs text-gray-900">
                <tr v-for="member in application.on_duty_details" :key="member.id"
                    class="border-l-4 border-gray-900 vertical-line">
                    <td class="py-3 px-3 max-w-[120px] leading-5 break-words whitespace-normal">
                        {{ member.name }}
                    </td>
                    <td class="py-3 px-3 whitespace-nowrap">{{ member.gender }}</td>
                    <td class="py-3 px-3 whitespace-nowrap">{{ member.designation }}</td>
                    <td class="py-3 px-3 max-w-[160px] leading-5 break-words whitespace-normal">
                        {{ member.department }}
                    </td>
                    <td class="py-3 px-3 whitespace-nowrap">{{ member.contact }}</td>
                    <td class="py-3 px-3 text-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.79199 21.25H16.208C17.1363 21.25 18.0265 20.8813 18.6829 20.2249C19.3392 19.5685 19.708 18.6783 19.708 17.75V12.22C19.7083 11.2919 19.34 10.4016 18.684 9.745L12.715 3.775C12.39 3.45 12.0041 3.19221 11.5794 3.01634C11.1548 2.84047 10.6996 2.74997 10.24 2.75H7.79199C6.86373 2.75 5.9735 3.11875 5.31712 3.77513C4.66074 4.4315 4.29199 5.32174 4.29199 6.25V17.75C4.29199 18.6783 4.66074 19.5685 5.31712 20.2249C5.9735 20.8813 6.86373 21.25 7.79199 21.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.688 3.11035V8.77035C11.688 9.30079 11.8987 9.80949 12.2738 10.1846C12.6488 10.5596 13.1576 10.7704 13.688 10.7704H19.35" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.25 16.5V15.5M7.25 15.5V13.5H8.25C8.51522 13.5 8.76957 13.6054 8.95711 13.7929C9.14464 13.9804 9.25 14.2348 9.25 14.5C9.25 14.7652 9.14464 15.0196 8.95711 15.2071C8.76957 15.3946 8.51522 15.5 8.25 15.5H7.25ZM15.25 16.5V15.25M15.25 15.25V13.5H16.75M15.25 15.25H16.75M11.25 16.5V13.5H11.75C12.1478 13.5 12.5294 13.658 12.8107 13.9393C13.092 14.2206 13.25 14.6022 13.25 15C13.25 15.3978 13.092 15.7794 12.8107 16.0607C12.5294 16.342 12.1478 16.5 11.75 16.5H11.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </td>
                </tr>
                </tbody>
            </table>
        </section>

        <section v-if="application.family_members.length !== 0"  class="mt-12 overflow-x-auto">
            <h4 class="font-semibold mb-4 text-base">Family</h4>
            <table class="w-full border-collapse">
                <thead>
                <tr class="bg-gray-700 text-white text-xs font-bold text-left">
                    <th class="py-2 px-3">NAME</th>
                    <th class="py-2 px-3">GENDER</th>
                    <th class="py-2 px-3">RELATIONSHIP</th>
                </tr>
                </thead>
                <tbody class="text-xs text-gray-900">
                <tr v-for="member in application.family_members" :key="member.id"
                    class="border-l-4 border-gray-900 vertical-line">
                    <td class="py-3 px-3 max-w-[160px] leading-5 break-words">
                        {{ member.name }}
                    </td>
                    <td class="py-3 px-3">{{ member.gender }}</td>
                    <td class="py-3 px-3">{{member.relation}}</td>
                </tr>
                <tr class="bg-gray-50 border-l-4 border-transparent vertical-line">
                    <td class="py-3 px-3 max-w-[160px] leading-5 break-words">
                        Grace Lalhmunsangi
                    </td>
                    <td class="py-3 px-3">Female</td>
                    <td class="py-3 px-3">Wife</td>
                </tr>
                </tbody>
            </table>
        </section>
    </div>
    </div>
</template>

<style scoped>

</style>

