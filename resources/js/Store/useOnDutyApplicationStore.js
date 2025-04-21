import { defineStore } from 'pinia'

export const useOnDutyApplicationStore = defineStore('application', {
    state: () => ({
        type: 'ON DUTY',
        status: 'Pending',

        applicant_name: '',
        gender: '',
        designation: '',
        department: '',
        contact: '',

        department_approval: null, // file

        // Shared fields
        family_details: [],

        // Only for ON_DUTY
        on_duty_details: [],

        // Location-specific (optional or shared)
        location: '',
        start_date: '',
        end_date: '',
    }),
    actions: {
        reset() {
            this.$reset()
        },

        // ON DUTY
        addOnDuty() {
            this.on_duty_details.push({
                name: '',
                gender: '',
                designation: '',
                department: '',
                contact: '',
                approval: null, // file
            })
        },
        removeOnDuty(index) {
            this.on_duty_details.splice(index, 1)
        },

        // Family
        addFamilyMember() {
            this.family_details.push({ name: '', relation: '', age: '' })
        },
        removeFamilyMember(index) {
            this.family_details.splice(index, 1)
        },

        // File handler for main approval
        setDepartmentApproval(file) {
            this.department_approval = file
        },

        // File handler for each on_duty_details
        setOnDutyApproval(index, file) {
            if (this.on_duty_details[index]) {
                this.on_duty_details[index].approval = file
            }
        },
    },
    persist: true,
})
