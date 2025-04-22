<script setup>
defineProps({
    application: Object,
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32" >
        <!-- Div 1 -->
        <div class="rounded-lg shadow-md mt-4">
            <div class="p-4 rounded-lg shadow-md" style="background: #FFF6E0">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-primary font-bold text-xl">PRIVATE</h2>
                        <p class="text-muted-foreground">Non-official personal stay</p>
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

    </div>
    <!--    Other Official Table-->
    <div v-if="application.non_official_details.length !== 0" class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32 mt-4">
        <h2 class="text-2xl font-bold mb-4">Another Persons</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-zinc-300">
                <thead class="bg-zinc-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b text-left">NAME</th>
                    <th class="py-2 px-4 border-b text-left">GENDER</th>
                    <th class="py-2 px-4 border-b text-left">CONTACT NO.</th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-zinc-100" v-for="member in application.non_official_details" :key="member.id" >
                    <td class="py-2 px-4 border-b text-left">{{member.name}}</td>
                    <td class="py-2 px-4 border-b text-left">{{member.gender}}</td>
                    <td class="py-2 px-4 border-b text-left">{{member.contact}}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>


    <!--    Other Family Table-->
    <div v-if="application.family_members.length !== 0" class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-32 mt-4">
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
