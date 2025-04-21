<template>
    <div class="card">
        <Card class="shadow-xl w-full">
            <template #header>
                <h4 class="mt-5 ml-5">{{ t('employee_register.stat_example') }}</h4>
            </template>
            <template #content>
                <Chart type="bar" :data="chartData" :options="chartOptions" class="w-[100%] h-[20rem]" />
            </template>
        </Card>
    </div>
</template>

<script setup>
import  Chart  from 'primevue/chart';
import  Card  from 'primevue/card';
import { onMounted, ref } from 'vue';
import { useI18n } from 'vue-i18n';

const chartData = ref(null);
const chartOptions = ref(null);
const { t } = useI18n();

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa'],
        datasets: [
            {
                type: 'bar',
                label: 'Darbuotojų skaičius',
                backgroundColor: documentStyle.getPropertyValue('--p-gray-500'),
                data: [180, 175, 190, 160, 200, 170, 185],
                borderColor: 'white',
                borderWidth: 2,
            },
            {
                type: 'bar',
                label: 'Darbo valandos',
                backgroundColor: documentStyle.getPropertyValue('--p-cyan-500'),
                data: [28800, 28000, 30400, 25600, 32000, 27200, 29600],
            },
        ],
    };
};

const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--p-text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--p-text-muted-color');
    const surfaceBorder = documentStyle.getPropertyValue('--p-content-border-color');

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.6,
        plugins: {
            legend: {
                labels: {
                    color: textColor,
                },
            },
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                },
            },
            y: {
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                },
            },
        },
        datasets: {
            line: {
                yAxisID: 'y1',
            },
        },
    };
};
</script>
