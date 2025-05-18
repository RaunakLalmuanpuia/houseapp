<script setup>
defineProps({
    application: Object,
});

const handleOpenDocument = (item) => {
    let a = document.createElement("a");
    a.target = "_blank";
    a.href = `/storage/${item}`;
    a.click();
};
</script>

<template>
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
                                {{ application.department?.name }}<br />
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
                            <p class="font-bold text-black leading-5 text-start">{{application.house.name}}</p>
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
                    <div class="cursor-pointer" @click="handleOpenDocument(application.department_approval)">
                        <p class="text-gray-600 flex items-center space-x-2 text-sm">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.79199 21.25H16.208C17.1363 21.25 18.0265 20.8813 18.6829 20.2249C19.3392 19.5685 19.708 18.6783 19.708 17.75V12.22C19.7083 11.2919 19.34 10.4016 18.684 9.745L12.715 3.775C12.39 3.45 12.0041 3.19221 11.5794 3.01634C11.1548 2.84047 10.6996 2.74997 10.24 2.75H7.79199C6.86373 2.75 5.9735 3.11875 5.31712 3.77513C4.66074 4.4315 4.29199 5.32174 4.29199 6.25V17.75C4.29199 18.6783 4.66074 19.5685 5.31712 20.2249C5.9735 20.8813 6.86373 21.25 7.79199 21.25Z" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.688 3.11035V8.77035C11.688 9.30079 11.8987 9.80949 12.2738 10.1846C12.6488 10.5596 13.1576 10.7704 13.688 10.7704H19.35" stroke="black" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.25 16.5V15.5M7.25 15.5V13.5H8.25C8.51522 13.5 8.76957 13.6054 8.95711 13.7929C9.14464 13.9804 9.25 14.2348 9.25 14.5C9.25 14.7652 9.14464 15.0196 8.95711 15.2071C8.76957 15.3946 8.51522 15.5 8.25 15.5H7.25ZM15.25 16.5V15.25M15.25 15.25V13.5H16.75M15.25 15.25H16.75M11.25 16.5V13.5H11.75C12.1478 13.5 12.5294 13.658 12.8107 13.9393C13.092 14.2206 13.25 14.6022 13.25 15C13.25 15.3978 13.092 15.7794 12.8107 16.0607C12.5294 16.342 12.1478 16.5 11.75 16.5H11.25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Approval from Administrative Head</span>
                        </p>
                    </div>

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
                    <td class="py-3 px-3 text-center cursor-pointer" @click="handleOpenDocument(member.department_approval)">
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

