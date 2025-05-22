<template>
    <div class="chart-container" style="height: 300px;">
        <Doughnut :data="data" :options="options" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'

ChartJS.register(ArcElement, Tooltip, Legend)

const data = ref({
    labels: [],
    datasets: []
})

const options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'bottom',
            labels: {
                usePointStyle: true,
                pointStyle: 'circle',
                boxWidth: 10,
                boxHeight: 10,
                padding: 20
            }
        }
    }
}

const colors = {
    'FLAM': '#733E15',
    'ON DUTY': '#150D72',
    'NOT ON DUTY': '#409B16',
    'PRIVATE': '#FF8C00',
    'MEDICAL': '#0073FF',
    'STUDY TOUR': '#DD4939'
}
// Category Count
const fetchData = async () => {
    try {
        const response = await axios.get(route('statistics.category.count'))
        const chartData = response.data

        data.value.labels = chartData.map(item => item.label)
        data.value = {
            labels: chartData.map(item => item.label),
            datasets: [{
                label: 'Total',
                data: chartData.map(item => item.count),
                backgroundColor: chartData.map(item => colors[item.label] || '#ccc'),
            }]
        }
    } catch (error) {
        console.error('Error fetching chart data:', error)
    }
}

// Category Percentage
// const fetchData = async () => {
//     try {
//         const response = await axios.get(route('statistics.category.percentage'))
//         const chartData = response.data
//
//         data.value = {
//             labels: chartData.map(item => item.label),
//             datasets: [{
//                 label: 'Percentage',
//                 data: chartData.map(item => item.percentage),  // <-- Use percentage here
//                 backgroundColor: chartData.map(item => colors[item.label] || '#ccc'),
//             }]
//         }
//     } catch (error) {
//         console.error('Error fetching chart data:', error)
//     }
// }


onMounted(fetchData)
</script>

<style scoped>
.chart-container {
    position: relative;
    width: 80%;
    height: 60%;
}
</style>
