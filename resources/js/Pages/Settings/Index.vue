<script setup>
import { ref } from 'vue'
import RoomType from "@/Components/Settings/RoomType.vue";
import House from "@/Components/Settings/House.vue";
import Category from "@/Components/Settings/Category.vue";
import Department from "@/Components/Settings/Department.vue";
import SubDivision from "@/Components/Settings/SubDivision.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";

defineOptions({ layout: AuthLayout })

const currentComponent = ref('House')

const components = {
    House,
    RoomType,
    Category,
    Department,
    SubDivision,
}

const isActive = (componentName) => currentComponent.value === componentName
</script>

<template>
    <div class="bg-white text-black">
        <div class="ml-6 mt-6">
            <h2 class="text-lg font-semibold flex items-center mb-6">
                <span class="inline-block w-1.5 h-6 bg-black mr-2"></span>Settings
            </h2>
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Left menu -->
                <nav
                    aria-label="Settings navigation"
                    class="flex-shrink-0 w-[320px] h-[400px] border border-gray-200 rounded-xl p-4"
                >
                    <ul class="space-y-4 text-sm font-normal">
                        <li>
                            <button
                                type="button"
                                :class="[
                                    'w-full flex flex-col text-left',
                                    isActive('House') ? 'bg-blue-50 rounded-md p-3' : ''
                                ]"
                                @click="currentComponent = 'House'"
                            >
                                <div>
                                    <p class="font-semibold text-black text-sm leading-tight">Mizoram House</p>
                                    <p class="text-gray-300 text-xs mt-0.5 select-none leading-tight">
                                        Add Mizoram House
                                    </p>
                                </div>
                                <i class="fas fa-chevron-down text-black"></i>
                            </button>
                            <hr class="mt-4 border-gray-200" />
                        </li>
                        <li>
                            <button
                                type="button"
                                :class="[
                                    'w-full flex flex-col text-left',
                                    isActive('RoomType') ? 'bg-blue-50 rounded-md p-3' : ''
                                ]"
                                @click="currentComponent = 'RoomType'"
                            >
                                <div>
                                    <p class="font-semibold text-black text-sm leading-tight">Room Type</p>
                                    <p class="text-gray-300 text-xs mt-0.5 select-none leading-tight">
                                        Add Room type for Mizoram House
                                    </p>
                                </div>
                                <i class="fas fa-chevron-right text-black"></i>
                            </button>
                            <hr class="mt-4 border-gray-200" />
                        </li>
                        <li>
                            <button
                                type="button"
                                :class="[
                                    'w-full flex flex-col text-left',
                                    isActive('Category') ? 'bg-blue-50 rounded-md p-3' : ''
                                ]"
                                @click="currentComponent = 'Category'"
                            >
                                <div>
                                    <p class="font-semibold text-black text-sm leading-tight">Reason/Category</p>
                                    <p class="text-gray-300 text-xs mt-0.5 select-none leading-tight">
                                        Add Category type for Mizoram House
                                    </p>
                                </div>
                                <i class="fas fa-chevron-right text-black"></i>
                            </button>
                            <hr class="mt-4 border-gray-200" />
                        </li>
                        <li>
                            <button
                                type="button"
                                :class="[
                                    'w-full flex flex-col text-left',
                                    isActive('Department') ? 'bg-blue-50 rounded-md p-3' : ''
                                ]"
                                @click="currentComponent = 'Department'"
                            >
                                <div>
                                    <p class="font-semibold text-black text-sm leading-tight">Department</p>
                                    <p class="text-gray-300 text-xs mt-0.5 select-none leading-tight">
                                        Add Deptt. Name from Govt. of Mizoram
                                    </p>
                                </div>
                                <i class="fas fa-chevron-down text-black"></i>
                            </button>
                            <hr class="mt-4 border-gray-200" />
                        </li>
                        <li>
                            <button
                                type="button"
                                :class="[
                                    'w-full flex flex-col text-left',
                                    isActive('SubDivision') ? 'bg-blue-50 rounded-md p-3' : ''
                                ]"
                                @click="currentComponent = 'SubDivision'"
                            >
                                <div>
                                    <p class="font-semibold text-black text-sm leading-tight">Sub Division/Wings/Sub Ordinate Office</p>
                                    <p class="text-gray-300 text-xs mt-0.5 select-none leading-tight">
                                        Add sub office
                                    </p>
                                </div>
                                <i class="fas fa-chevron-down text-black"></i>
                            </button>
                            <hr class="mt-4 border-gray-200" />
                        </li>
                    </ul>
                </nav>

                <!-- Right content -->
                <div class="flex-1 w-full">
                    <component :is="components[currentComponent]" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
