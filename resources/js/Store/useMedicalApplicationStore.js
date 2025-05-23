import { defineStore } from 'pinia'

export const useMedicalApplicationStore = defineStore('medical_application', {
    state: () => ({
        type: 'MEDICAL',
        status: 'Pending',

        category:'',
        service: '',

        applicant_name: '',
        gender: '',
        contact: '',
        department:'',
        designation: '',
        file: null,

        patient_details: [],

        attendant_details: [],

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

        addPatient() {
            this.patient_details.push({
                category: 'Patient',
                service: '',
                name: '',
                gender: '',
                contact: '',
                designation: '',
                department: '',
                file: null,
            })
        },

        addAttendant() {
            this.attendant_details.push({
                category: 'Attendant',
                service: '',
                name: '',
                gender: '',
                contact: '',
                designation: '',
                department: '',
                file: null,
            })
        },

        removePatient(index) {
            this.patient_details.splice(index, 1)
        },

        removeAttendant(index) {
            this.attendant_details.splice(index, 1)
        },

        // File handler for main approval
        setMedicalReferral(file) {
            this.file = file
        },

        // File handler for each patient
        setPatientMedicalReferral(index, file) {
            if (this.patient_details[index]) {
                this.patient_details[index].file = file
            }
        },

        // File handler for each patient
        setAttendantMedicalReferral(index, file) {
            if (this.attendant_details[index]) {
                this.attendant_details[index].file = file
            }
        },

    },
    persist: true,
})
