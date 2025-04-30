
import { defineStore } from 'pinia'

export const useNotOnDutyApplicationStore = defineStore('not_on_duty_application', {
    state: () => ({
        type: 'NOT ON DUTY',
        status: 'Pending',
        applicant_name: '',
        gender: '',
        designation: '',
        department: '',
        contact: '',
        not_on_duty_details: [],
        family_details: [],
        location: '',
        start_date: '',
        end_date: '',
    }),
    actions: {
        reset() {
            this.$reset()
        },
        addNotOnDuty() {
            this.not_on_duty_details.push({})
        },

        removeNotOnDuty(index) {
            this.not_on_duty_details.splice(index, 1)
        },

        addFamilyMember() {
            this.family_details.push({ name: '', relation: '', age: '' })
        },

        removeFamilyMember(index) {
            this.family_details.splice(index, 1)
        },
    },
    persist: true, // optional: if you want to persist across refreshes
})
