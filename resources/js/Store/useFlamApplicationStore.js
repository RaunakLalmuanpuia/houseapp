
import { defineStore } from 'pinia'

export const useFlamApplicationStore = defineStore('application', {
    state: () => ({
        type: 'FLAM',
        status: 'Pending',
        applicant_name: '',
        gender: '',
        designation: '',
        contact: '',
        flam_details: [],
        family_details: [],
        location: '',
        start_date: '',
        end_date: '',
    }),
    actions: {
        reset() {
            this.$reset()
        },
        addFlam() {
            this.flam_details.push({ flam_name: '', designation: '', contact: '' , gender: ''})
        },

        removeFlam(index) {
            this.flam_details.splice(index, 1)
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
