<template>
    <div class="chart-container" style="height: 400px;">
        <Bar :data="chartData" :options="options" />
    </div>
</template>

<script setup>
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js'

import { Bar } from 'vue-chartjs'
import { onMounted, ref, watch } from 'vue'
import axios from "axios";

// Register Chart.js components
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps({
    year: Number,
})

const chartData = ref({
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
    'STUDY TOUR': '#DD4939',
}


const fetchData = (year, url = route('statistics.reservation')) => {
    axios.get(url, {
        params: { year: year }
    }).then(res => {
        chartData.value = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: res.data.map(item => ({
                label: item.label,
                data: item.data,
                backgroundColor: colors[item.label] || '#ccc'
            }))
        }
    }).catch(err => {
        console.error(err?.response?.data?.message || err);
    });
};

// Fetch on mount
onMounted(() => {
    fetchData(props.year)
})

// Re-fetch when year changes
watch(() => props.year, (newYear) => {
    fetchData(newYear)
})
</script>


<style scoped>
.chart-container {
    position: relative;
    width: 100%;
}
</style>
