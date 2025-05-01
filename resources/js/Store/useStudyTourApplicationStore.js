import { defineStore } from 'pinia'

export const useStudyTourApplicationStore = defineStore('study_tour_application', {
    state: () => ({
        type: 'STUDY TOUR',
        status: 'Pending',

        applicant_name: '',
        gender: '',
        designation: '',
        contact: '',

        study_tour_details: {
            institute: '',
            institute_approval: null,
            male: '',
            female: '',
        },


        // Location-specific (optional or shared)
        location: '',
        start_date: '',
        end_date: '',

        state_id:'',
    }),
    actions: {
        reset() {
            this.$reset()
        },

    },
    persist: true,
})
