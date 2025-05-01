
import { defineStore } from 'pinia'

export const useNonOfficialApplicationStore = defineStore('non_official_application', {
    state: () => ({
        type: 'PRIVATE',
        status: 'Pending',
        applicant_name: '',
        gender: '',
        contact: '',
        non_official_details: [],
        family_details: [],
        location: '',
        start_date: '',
        end_date: '',
        state_id:'',
    }),
    actions: {
        reset() {
            this.$reset()
        },
        addNonOfficial() {
            this.non_official_details.push({ name: '', contact: '' , gender: ''})
        },

        removeNonOfficial(index) {
            this.non_official_details.splice(index, 1)
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
