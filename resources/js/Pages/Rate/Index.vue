<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {Head, router, useForm} from "@inertiajs/vue3";
import {reactive, ref, computed} from "vue";

defineOptions({layout:AuthLayout})

const props = defineProps(['roomRates','houses','categories','search', 'perPage']);

const form = useForm({
    room_type_id: '',
    rate_category_id:'',
    rate:'',
})
// Data
const selectedHouse = ref('')
const selectedRate = ref({}) // optional, used for display if needed


// Computed: Filter Room Types based on House
const filteredRoomTypes = computed(() => {
    const house = props.houses.find(h => h.id === selectedHouse.value)
    return house ? house.room_types : []
})


const openDropdownId = ref(null)

const showEditDialog = ref(false)


const showDeleteDialog = ref(false)


const showCreatePopup = ref(false)

const showDeletePopup = ref(false)
const showUpdatePopup = ref(false)
//
const editForm = useForm({
    id: null,
    room_type_id: '',
    rate_category_id:'',
    rate:'',
})

const handleEdit = (item) => {

    selectedRate.value = item
    editForm.id = item.id
    editForm.room_type_id = item.room_type_id
    editForm.rate_category_id = item.rate_category_id
    editForm.rate = item.rate
    showEditDialog.value = true
    openDropdownId.value = null

    // Set the selectedHouse based on the house_id from roomType
    selectedHouse.value = item.room_type?.house_id ?? '';

}

const search = ref('');

const state = reactive({
    search: props.search || '',
    perPage: props.perPage ? parseInt(props.perPage) : 10,
});

const handleSearch = () => {
    router.get(route('admin.rate.index'), {
        search: state.search,
        perPage: state.perPage,
    }, {
        preserveState: true,
        replace: true,
    });
};

const clearSearch = () => {
    state.search = '';
    handleSearch();
};

const navigateToPage = (url) => {
    // Append the perPage parameter to pagination URLs
    if (url) {
        router.get(url, {
            search: state.search,
            perPage: state.perPage,
        });
    }
};


const saveRate = e => {
    form.post(route('admin.rate.store'), {
        onStart: () => {
            form.reset();
            // openDropdownId.value = null
        },
        onSuccess: (response) => {
            showCreatePopup.value = true
        },
        onError: (errors) => {
            if (errors) {
                if (typeof errors === 'string') {
                    // If backend sends a simple string error
                    alert(errors);
                } else if (typeof errors === 'object') {
                    // If it's a validation bag or object
                    const firstError = Object.values(errors)[0];
                    if (Array.isArray(firstError)) {
                        alert(firstError[0]); // validation errors usually come as arrays
                    } else {
                        alert(firstError);
                    }
                } else {
                    alert('An unexpected error occurred.');
                }
            }
            showCreatePopup.value = false;
        },
        onFinish: () => {

        },
    })
}
//
const updateRate =(item) => {
    editForm.put(route('admin.rate.update', item), {
        onStart: () => {
            showEditDialog.value = false

        },
        onSuccess: (response) => {
            showUpdatePopup.value = true
        },
        onError: (errors) => {
            if (errors) {
                if (typeof errors === 'string') {
                    // If backend sends a simple string error
                    alert(errors);
                } else if (typeof errors === 'object') {
                    // If it's a validation bag or object
                    const firstError = Object.values(errors)[0];
                    if (Array.isArray(firstError)) {
                        alert(firstError[0]); // validation errors usually come as arrays
                    } else {
                        alert(firstError);
                    }
                } else {
                    alert('An unexpected error occurred.');
                }
            }
            showEditDialog.value = true;
        },
        onFinish: () => {

        },
    })
}
//
//
//
const deleteRateDialog = (item) => {
    showDeleteDialog.value = true
    openDropdownId.value = null
    selectedRate.value = item
}

const deleteRate = (item) => {

    router.delete(route('admin.rate.destroy', item), {
        onSuccess: () => {
            showDeleteDialog.value = false

            showDeletePopup.value = true

            // auto-hide after 3 seconds
            // setTimeout(() => {
            //     showApprovePopup.value = false
            // }, 3000)
        },
        onError: err => console.log(err.toString()),
    })
}
</script>



<template>
    <Head title="Rates" />
    <div class="bg-white text-black">
        <div class="ml-6">
            <header class="flex justify-between items-center mb-6">
                <h1 class="font-semibold text-base leading-5">Mizoram House Rate & Tariff</h1>
                <div class="flex items-center space-x-2 border border-gray-300 rounded-full px-4 py-2 max-w-[300px] w-full">
                    <input
                        v-model="state.search"
                        type="search"
                        placeholder="Search"
                        @keyup.enter="handleSearch"
                        class="flex-grow text-sm text-gray-700 placeholder-gray-500 focus:outline-none border-none"
                        aria-label="Search"
                    />
                    <button v-if="state.search" @click="clearSearch" class="ml-1 text-gray-500 hover:text-red-500" title="Clear Search">
                        ✕
                    </button>
                    <button @click="handleSearch" type="submit" class="ml-2 text-gray-600">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.893 13.92L16.973 17M16 8.5C16 10.4891 15.2098 12.3968 13.8033 13.8033C12.3968 15.2098 10.4891 16 8.5 16C6.51088 16 4.60322 15.2098 3.1967 13.8033C1.79018 12.3968 1 10.4891 1 8.5C1 6.51088 1.79018 4.60322 3.1967 3.1967C4.60322 1.79018 6.51088 1 8.5 1C10.4891 1 12.3968 1.79018 13.8033 3.1967C15.2098 4.60322 16 6.51088 16 8.5Z" stroke="#61646B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </header>

            <section class="flex flex-col md:flex-row gap-6">
                <!-- Left panel -->
                <aside class="bg-[#E8F2FD] rounded-lg p-6 w-full max-w-[320px] max-h-[500px]" >
                    <h2 class="font-semibold text-lg leading-6 mb-1">Rate</h2>
                    <p class="text-xs leading-4 mb-6">Tariff & Rate for Mizoram House</p>
                    <div class="space-y-5">
                        <div>
                            <label for="title" class="block text-xs font-normal mb-1">Mizoram House</label>
                            <select
                                v-model="selectedHouse"
                                id="status"
                                class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 bg-white text-gray-400"
                            >
                                <option value="">Select House</option>
                                <option v-for="house in houses" :key="house.id" :value="house.id">{{ house.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="title" class="block text-xs font-normal mb-1">Room Type</label>
                            <select
                                v-model="form.room_type_id"
                                id="status"
                                class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 bg-white text-gray-400"
                            >
                                <option value="">Select Room Type</option>
                                <option v-for="roomType in filteredRoomTypes" :key="roomType.id" :value="roomType.id">{{ roomType.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-xs font-normal mb-1">Reason/Category</label>
                            <select
                                v-model="form.rate_category_id"
                                id="status"
                                class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 bg-white text-gray-400"
                            >
                                <option value="">Select Category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="title" class="block text-xs font-normal mb-1">Amount (Rs)</label>
                            <input
                                v-model="form.rate"
                                id="title"
                                type="text"
                                placeholder="Rate Amount"
                                class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            />
                        </div>

                        <button
                            @click="saveRate"
                            type="submit"
                            class="w-full bg-black text-white text-sm font-normal py-3 rounded-md hover:bg-gray-900 transition-colors"
                        >
                            Submit
                        </button>
                    </div>
                </aside>

<!--                {{roomRates[0].rate}}-->

                <!-- Right panel -->
                <section class="flex-1 overflow-x-auto">
                    <table class="w-full border-collapse text-xs leading-5">
                        <thead>
                        <tr class="bg-gray-800 text-white text-left">
                            <th class="py-2 px-3 font-semibold w-[6%]">SL.NO</th>
                            <th class="py-2 px-3 font-semibold w-[12%]">House</th>
                            <th class="py-2 px-3 font-semibold w-[20%]">Room Type</th>
                            <th class="py-2 px-3 font-semibold w-[20%]">Category</th>
                            <th class="py-2 px-3 font-semibold w-[12%]">Amount</th>
                            <th class="py-2 px-3 font-semibold w-[12%]">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in roomRates.data"
                            class="border-b border-gray-100">
                            <td class="py-4 px-3">{{ index+1 }}</td>
                            <td class="py-4 px-3">{{item.room_type?.house?.name}}</td>

                            <td class="py-4 px-3">{{ item.room_type?.name}}</td>
                            <td class="py-4 px-3">{{item.rate_category?.name}} </td>
                            <td class="py-4 px-3">{{item.rate}}</td>
                            <td class="py-4 px-3 relative">
                                <button  @click="openDropdownId = openDropdownId === item.id ? null : item.id"
                                         aria-label="More actions" class="text-gray-600 hover:text-black focus:outline-none">
                                    <svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_534_2390)">
                                            <path d="M11.4098 7.2998H11.3998M11.3098 11.9998H11.2998M11.4098 16.6998H11.3998" stroke="black" stroke-width="2.6" stroke-linecap="round"/>
                                        </g>
                                        <defs>
                                            <filter id="filter0_d_534_2390" x="-4" y="0" width="32" height="32" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                <feOffset dy="4"/>
                                                <feGaussianBlur stdDeviation="2"/>
                                                <feComposite in2="hardAlpha" operator="out"/>
                                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_534_2390"/>
                                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_534_2390" result="shape"/>
                                            </filter>
                                        </defs>
                                    </svg>
                                </button>

                                <div v-if="openDropdownId === item.id"
                                     class="origin-top-right absolute right-0 mt-2 top-10 bg-white border border-gray-200 rounded-lg shadow-lg w-[140px] text-xs font-normal text-gray-700"
                                     aria-hidden="true"
                                >
                                    <button @click.stop="handleEdit(item)"
                                            class="flex items-center gap-2 px-3 py-2 w-full hover:bg-gray-100">
                                        <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.666504 13.0002H11.3332M1.77717 7.79156C1.49291 8.07645 1.33324 8.46244 1.33317 8.86489V11.0002H3.48184C3.8845 11.0002 4.2705 10.8402 4.55517 10.5549L10.8885 4.21822C11.1727 3.93329 11.3322 3.5473 11.3322 3.14489C11.3322 2.74248 11.1727 2.35649 10.8885 2.07156L10.2632 1.44489C10.1221 1.30379 9.95469 1.19187 9.77038 1.11554C9.58607 1.0392 9.38852 0.999938 9.18903 1C8.98954 1.00006 8.79202 1.03944 8.60776 1.1159C8.42349 1.19235 8.25611 1.30437 8.11517 1.44556L1.77717 7.79156Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Edit/Update
                                    </button>
                                    <button
                                        @click="deleteRateDialog(item)"
                                        class="flex items-center gap-2 px-3 py-2 w-full hover:bg-gray-100 text-red-600">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.12483 4.14174L4.5335 12.6504C4.59793 13.0399 4.79856 13.3939 5.09963 13.6494C5.40071 13.9048 5.78268 14.045 6.1775 14.0451H8.4095M12.8748 4.14174L11.4668 12.6504C11.4024 13.0399 11.2018 13.3939 10.9007 13.6494C10.5996 13.9048 10.2176 14.045 9.82283 14.0451H7.59083M6.6815 7.41041V10.7764M9.31883 7.41041V10.7764M1.8335 4.14174H14.1668M9.8515 4.14174V2.95508C9.8515 2.68986 9.74614 2.43551 9.5586 2.24797C9.37107 2.06043 9.11671 1.95508 8.8515 1.95508H7.14883C6.88361 1.95508 6.62926 2.06043 6.44172 2.24797C6.25419 2.43551 6.14883 2.68986 6.14883 2.95508V4.14174H9.8515Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <nav
                        class="flex justify-end items-center space-x-2 mt-6 text-xs text-gray-500 select-none"
                        aria-label="Pagination"
                    >
                        <span>Records per page:</span>
                        <select
                            v-model="state.perPage"
                            @change="handleSearch"
                            class="appearance-none bg-white border border-gray-400 text-sm px-3 py-1 pr-6 rounded-lg font-semibold text-gray-700 cursor-pointer focus:outline-none"
                        >
                            <option :value="10">10</option>
                            <option :value="25">25</option>
                            <option :value="50">50</option>
                            <option :value="100">100</option>
                        </select>

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                            <i class="fas fa-caret-down"></i>
                        </div>

                        <button
                            v-for="(link, index) in roomRates.links"
                            :key="index"
                            :disabled="!link.url"
                            @click="navigateToPage(link.url)"
                            v-html="link.label"
                            :class="[
                    'min-w-[32px] h-8 px-2 border rounded-sm flex items-center justify-center cursor-pointer select-none',
                    link.active ? 'bg-gray-900 text-white border-gray-900' : 'hover:underline border-gray-300 text-gray-700',
                    !link.url ? 'opacity-50 cursor-not-allowed' : ''
                  ]"
                        />

                    </nav>
                </section>
            </section>
        </div>
    </div>

    <!--    Edit Dialog-->
    <div v-if="showEditDialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">

        <div
            class="bg-white rounded-lg max-w-md w-full p-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="dialog-title"
        >
            <h2
                id="dialog-title"
                class="font-semibold text-gray-900 text-lg mb-6 select-none"
            >
                Edit/Update Rate
            </h2>
            <div class="space-y-6">
                <div>
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-900 mb-1 select-none"
                    >House</label
                    >
                    <select
                        v-model="selectedHouse"
                        id="status"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 bg-white text-gray-400"
                    >
                        <option value="">Select House</option>
                        <option v-for="house in houses" :key="house.id" :value="house.id">{{ house.name }}</option>
                    </select>
                </div>
                <div>
                    <label
                        for="upload"
                        class="block text-xs font-normal mb-1"
                    >Select Room Type</label>

                    <div class="relative">
                        <select
                            v-model="editForm.room_type_id"
                            id="status"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 bg-white text-gray-400"
                        >
                            <option value="">Select Room Type</option>
                            <option v-for="roomType in filteredRoomTypes" :key="roomType.id" :value="roomType.id">{{ roomType.name }}</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="status" class="block text-xs font-normal mb-1">Reason/Category</label>
                    <select
                        v-model="editForm.rate_category_id"
                        id="status"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 bg-white text-gray-400"
                    >
                        <option value="">Select Category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div>
                    <label for="title" class="block text-xs font-normal mb-1">Amount (Rs)</label>
                    <input
                        v-model="editForm.rate"
                        id="title"
                        type="text"
                        placeholder="Rate Amount"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    />
                </div>

                <div class="flex justify-start space-x-6 pt-2">
                    <button
                        @click="showEditDialog = false"

                        type="button"
                        class="text-gray-900 text-sm font-normal px-6 py-2 rounded-md border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    >
                        Cancel
                    </button>
                    <button
                        @click="updateRate(selectedRate)"
                        type="submit"
                        class="bg-black text-white text-sm font-normal px-6 py-2 rounded-md hover:opacity-90 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    >
                        Update Notice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--    Confirm Delete Dialog-->
    <div v-if="showDeleteDialog"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl max-w-sm w-full p-6">
            <h2 class="font-semibold text-lg mb-4">Delete Notice</h2>
            <p class="mb-8 text-base font-normal text-gray-900">I am sure, that i want to delete this Notice</p>
            <div class="flex space-x-4">
                <button
                    @click="showDeleteDialog = false"
                    type="button"
                    class="border border-gray-300 text-gray-700 rounded-md px-6 py-2 text-sm font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300"
                >
                    Cancel
                </button>
                <button
                    @click="deleteRate(selectedRate)"
                    type="button"
                    class="bg-black text-white rounded-md px-6 py-2 text-sm font-normal hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900"
                >
                    Confirm Delete
                </button>
            </div>
        </div>
    </div>


    <!--Create pop up-->
    <div
        v-if="showCreatePopup"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 lg:-translate-x-[22%] z-50 w-[90%] sm:w-auto"
    >
        <div
            class="w-full sm:max-w-md bg-green-300 rounded-lg shadow-md flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4 p-4"
            role="alert"
        >
            <div class="flex-shrink-0 mt-1">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_708_1780" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="21">
                        <rect y="0.5" width="20" height="20" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_708_1780)">
                        <path d="M4.41675 17.5837C4.00008 17.5837 3.64591 17.4378 3.35425 17.1462C3.06258 16.8545 2.91675 16.5003 2.91675 16.0837V4.91699C2.91675 4.50033 3.06258 4.14616 3.35425 3.85449C3.64591 3.56283 4.00008 3.41699 4.41675 3.41699H15.5834C16.0001 3.41699 16.3542 3.56283 16.6459 3.85449C16.9376 4.14616 17.0834 4.50033 17.0834 4.91699V16.0837C17.0834 16.5003 16.9376 16.8545 16.6459 17.1462C16.3542 17.4378 16.0001 17.5837 15.5834 17.5837H4.41675ZM4.41675 16.3337H15.5834C15.639 16.3337 15.6945 16.3059 15.7501 16.2503C15.8056 16.1948 15.8334 16.1392 15.8334 16.0837V4.91699C15.8334 4.86144 15.8056 4.80588 15.7501 4.75033C15.6945 4.69477 15.639 4.66699 15.5834 4.66699H4.41675C4.36119 4.66699 4.30564 4.69477 4.25008 4.75033C4.19453 4.80588 4.16675 4.86144 4.16675 4.91699V16.0837C4.16675 16.1392 4.19453 16.1948 4.25008 16.2503C4.30564 16.3059 4.36119 16.3337 4.41675 16.3337ZM5.62508 14.4587H14.4376L11.7084 10.8128L9.35425 13.8545L7.68758 11.7087L5.62508 14.4587Z" fill="#34A853"/>
                    </g>
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-extrabold text-green-900 text-lg leading-6">Success</p>
                <p class="text-green-900 text-base leading-6 mt-1">
                    Rate created successfully!
                </p>
            </div>
            <button
                @click="showCreatePopup = false"
                aria-label="Close notification"
                class="text-green-900 hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 rounded mt-2 sm:mt-1 sm:ml-4"
            >
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_708_1788)">
                        <rect width="14" height="14" transform="translate(4 3.5)" fill="white" fill-opacity="0.01"/>
                        <g clip-path="url(#clip1_708_1788)">
                            <path d="M4.25594 3.75541C4.42003 3.59137 4.64255 3.49922 4.87457 3.49922C5.10659 3.49922 5.32911 3.59137 5.49319 3.75541L10.9996 9.26178L16.5059 3.75541C16.5867 3.67184 16.6832 3.60518 16.79 3.55932C16.8967 3.51346 17.0115 3.48932 17.1277 3.48831C17.2439 3.4873 17.3591 3.50944 17.4667 3.55344C17.5742 3.59744 17.6719 3.66241 17.754 3.74456C17.8362 3.82672 17.9012 3.92441 17.9452 4.03195C17.9892 4.13948 18.0113 4.2547 18.0103 4.37088C18.0093 4.48707 17.9851 4.60188 17.9393 4.70864C17.8934 4.81539 17.8268 4.91194 17.7432 4.99266L12.2368 10.499L17.7432 16.0054C17.9026 16.1704 17.9908 16.3915 17.9888 16.6209C17.9868 16.8503 17.8948 17.0698 17.7325 17.232C17.5703 17.3942 17.3508 17.4863 17.1214 17.4882C16.892 17.4902 16.671 17.402 16.5059 17.2427L10.9996 11.7363L5.49319 17.2427C5.32817 17.402 5.10714 17.4902 4.87772 17.4882C4.6483 17.4863 4.42883 17.3942 4.2666 17.232C4.10437 17.0698 4.01235 16.8503 4.01035 16.6209C4.00836 16.3915 4.09656 16.1704 4.25594 16.0054L9.76232 10.499L4.25594 4.99266C4.09191 4.82857 3.99976 4.60605 3.99976 4.37403C3.99976 4.14201 4.09191 3.9195 4.25594 3.75541Z" fill="#1C1D1F"/>
                        </g>
                    </g>
                    <defs>
                        <clipPath id="clip0_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                        <clipPath id="clip1_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                    </defs>
                </svg>

            </button>
        </div>
    </div>

<!--    Update pop up-->
    <div
        v-if="showUpdatePopup"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 lg:-translate-x-[22%] z-50 w-[90%] sm:w-auto"
    >
        <div
            class="w-full sm:max-w-md bg-yellow-300 rounded-lg shadow-md flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4 p-4"
            role="alert"
        >
            <div class="flex-shrink-0 mt-1">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_708_1780" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="21">
                        <rect y="0.5" width="20" height="20" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_708_1780)">
                        <path d="M4.41675 17.5837C4.00008 17.5837 3.64591 17.4378 3.35425 17.1462C3.06258 16.8545 2.91675 16.5003 2.91675 16.0837V4.91699C2.91675 4.50033 3.06258 4.14616 3.35425 3.85449C3.64591 3.56283 4.00008 3.41699 4.41675 3.41699H15.5834C16.0001 3.41699 16.3542 3.56283 16.6459 3.85449C16.9376 4.14616 17.0834 4.50033 17.0834 4.91699V16.0837C17.0834 16.5003 16.9376 16.8545 16.6459 17.1462C16.3542 17.4378 16.0001 17.5837 15.5834 17.5837H4.41675ZM4.41675 16.3337H15.5834C15.639 16.3337 15.6945 16.3059 15.7501 16.2503C15.8056 16.1948 15.8334 16.1392 15.8334 16.0837V4.91699C15.8334 4.86144 15.8056 4.80588 15.7501 4.75033C15.6945 4.69477 15.639 4.66699 15.5834 4.66699H4.41675C4.36119 4.66699 4.30564 4.69477 4.25008 4.75033C4.19453 4.80588 4.16675 4.86144 4.16675 4.91699V16.0837C4.16675 16.1392 4.19453 16.1948 4.25008 16.2503C4.30564 16.3059 4.36119 16.3337 4.41675 16.3337ZM5.62508 14.4587H14.4376L11.7084 10.8128L9.35425 13.8545L7.68758 11.7087L5.62508 14.4587Z" fill="#34A853"/>
                    </g>
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-extrabold text-yellow-900 text-lg leading-6">Success</p>
                <p class="text-yellow-900 text-base leading-6 mt-1">
                    Rate updated successfully!
                </p>
            </div>
            <button
                @click="showUpdatePopup = false"
                aria-label="Close notification"
                class="text-green-900 hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 rounded mt-2 sm:mt-1 sm:ml-4"
            >
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_708_1788)">
                        <rect width="14" height="14" transform="translate(4 3.5)" fill="white" fill-opacity="0.01"/>
                        <g clip-path="url(#clip1_708_1788)">
                            <path d="M4.25594 3.75541C4.42003 3.59137 4.64255 3.49922 4.87457 3.49922C5.10659 3.49922 5.32911 3.59137 5.49319 3.75541L10.9996 9.26178L16.5059 3.75541C16.5867 3.67184 16.6832 3.60518 16.79 3.55932C16.8967 3.51346 17.0115 3.48932 17.1277 3.48831C17.2439 3.4873 17.3591 3.50944 17.4667 3.55344C17.5742 3.59744 17.6719 3.66241 17.754 3.74456C17.8362 3.82672 17.9012 3.92441 17.9452 4.03195C17.9892 4.13948 18.0113 4.2547 18.0103 4.37088C18.0093 4.48707 17.9851 4.60188 17.9393 4.70864C17.8934 4.81539 17.8268 4.91194 17.7432 4.99266L12.2368 10.499L17.7432 16.0054C17.9026 16.1704 17.9908 16.3915 17.9888 16.6209C17.9868 16.8503 17.8948 17.0698 17.7325 17.232C17.5703 17.3942 17.3508 17.4863 17.1214 17.4882C16.892 17.4902 16.671 17.402 16.5059 17.2427L10.9996 11.7363L5.49319 17.2427C5.32817 17.402 5.10714 17.4902 4.87772 17.4882C4.6483 17.4863 4.42883 17.3942 4.2666 17.232C4.10437 17.0698 4.01235 16.8503 4.01035 16.6209C4.00836 16.3915 4.09656 16.1704 4.25594 16.0054L9.76232 10.499L4.25594 4.99266C4.09191 4.82857 3.99976 4.60605 3.99976 4.37403C3.99976 4.14201 4.09191 3.9195 4.25594 3.75541Z" fill="#1C1D1F"/>
                        </g>
                    </g>
                    <defs>
                        <clipPath id="clip0_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                        <clipPath id="clip1_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                    </defs>
                </svg>

            </button>
        </div>
    </div>


    <!--Delete pop up-->
    <div
        v-if="showDeletePopup"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 lg:-translate-x-[22%] z-50 w-[90%] sm:w-auto"
    >
        <div
            class="w-full sm:max-w-md bg-red-300 rounded-lg shadow-md flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4 p-4"
            role="alert"
        >
            <div class="flex-shrink-0 mt-1">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_708_1780" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="21">
                        <rect y="0.5" width="20" height="20" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_708_1780)">
                        <path d="M4.41675 17.5837C4.00008 17.5837 3.64591 17.4378 3.35425 17.1462C3.06258 16.8545 2.91675 16.5003 2.91675 16.0837V4.91699C2.91675 4.50033 3.06258 4.14616 3.35425 3.85449C3.64591 3.56283 4.00008 3.41699 4.41675 3.41699H15.5834C16.0001 3.41699 16.3542 3.56283 16.6459 3.85449C16.9376 4.14616 17.0834 4.50033 17.0834 4.91699V16.0837C17.0834 16.5003 16.9376 16.8545 16.6459 17.1462C16.3542 17.4378 16.0001 17.5837 15.5834 17.5837H4.41675ZM4.41675 16.3337H15.5834C15.639 16.3337 15.6945 16.3059 15.7501 16.2503C15.8056 16.1948 15.8334 16.1392 15.8334 16.0837V4.91699C15.8334 4.86144 15.8056 4.80588 15.7501 4.75033C15.6945 4.69477 15.639 4.66699 15.5834 4.66699H4.41675C4.36119 4.66699 4.30564 4.69477 4.25008 4.75033C4.19453 4.80588 4.16675 4.86144 4.16675 4.91699V16.0837C4.16675 16.1392 4.19453 16.1948 4.25008 16.2503C4.30564 16.3059 4.36119 16.3337 4.41675 16.3337ZM5.62508 14.4587H14.4376L11.7084 10.8128L9.35425 13.8545L7.68758 11.7087L5.62508 14.4587Z" fill="#34A853"/>
                    </g>
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-extrabold text-red-900 text-lg leading-6">Success</p>
                <p class="text-red-900 text-base leading-6 mt-1">
                    Rate deleted successfully!
                </p>
            </div>
            <button
                @click="showDeletePopup = false"
                aria-label="Close notification"
                class="text-red-900 hover:text-red-800 focus:outline-none focus:ring-2 focus:ring-green-600 rounded mt-2 sm:mt-1 sm:ml-4"
            >
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_708_1788)">
                        <rect width="14" height="14" transform="translate(4 3.5)" fill="white" fill-opacity="0.01"/>
                        <g clip-path="url(#clip1_708_1788)">
                            <path d="M4.25594 3.75541C4.42003 3.59137 4.64255 3.49922 4.87457 3.49922C5.10659 3.49922 5.32911 3.59137 5.49319 3.75541L10.9996 9.26178L16.5059 3.75541C16.5867 3.67184 16.6832 3.60518 16.79 3.55932C16.8967 3.51346 17.0115 3.48932 17.1277 3.48831C17.2439 3.4873 17.3591 3.50944 17.4667 3.55344C17.5742 3.59744 17.6719 3.66241 17.754 3.74456C17.8362 3.82672 17.9012 3.92441 17.9452 4.03195C17.9892 4.13948 18.0113 4.2547 18.0103 4.37088C18.0093 4.48707 17.9851 4.60188 17.9393 4.70864C17.8934 4.81539 17.8268 4.91194 17.7432 4.99266L12.2368 10.499L17.7432 16.0054C17.9026 16.1704 17.9908 16.3915 17.9888 16.6209C17.9868 16.8503 17.8948 17.0698 17.7325 17.232C17.5703 17.3942 17.3508 17.4863 17.1214 17.4882C16.892 17.4902 16.671 17.402 16.5059 17.2427L10.9996 11.7363L5.49319 17.2427C5.32817 17.402 5.10714 17.4902 4.87772 17.4882C4.6483 17.4863 4.42883 17.3942 4.2666 17.232C4.10437 17.0698 4.01235 16.8503 4.01035 16.6209C4.00836 16.3915 4.09656 16.1704 4.25594 16.0054L9.76232 10.499L4.25594 4.99266C4.09191 4.82857 3.99976 4.60605 3.99976 4.37403C3.99976 4.14201 4.09191 3.9195 4.25594 3.75541Z" fill="#1C1D1F"/>
                        </g>
                    </g>
                    <defs>
                        <clipPath id="clip0_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                        <clipPath id="clip1_708_1788">
                            <rect width="14" height="14" fill="white" transform="translate(4 3.5)"/>
                        </clipPath>
                    </defs>
                </svg>

            </button>
        </div>
    </div>
</template>

<style scoped>

</style>

