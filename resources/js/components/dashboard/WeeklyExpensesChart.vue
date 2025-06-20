<script setup lang="ts">
import { computed } from 'vue';

interface ChartDataItem {
    month: string;
    income: number;
    expenses: number;
}

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    chartData: {
        type: Array as () => ChartDataItem[],
        required: true,
        default: () => [],
    },
});

const maxBarHeight = 150; // Max height in pixels for the tallest bar

const maxValue = computed(() => {
    return Math.max(...props.chartData.flatMap((d) => [d.income, d.expenses]));
});

const calculateBarHeight = (value: number) => {
    return (value / maxValue.value) * maxBarHeight;
};

const yAxisLabels = computed(() => {
    const step = maxValue.value / 4; // 5 labels: 0, 25%, 50%, 75%, 100%
    return Array.from({ length: 5 }, (_, i) => Math.round(i * step));
});
</script>

<template>
    <div class="rounded-lg border bg-card p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-medium">{{ title }}</h3>
        <div class="relative h-48">
            <!-- Y-axis labels -->
            <div class="absolute top-0 bottom-0 left-0 flex flex-col justify-between pr-2 text-sm text-muted-foreground">
                <span v-for="label in yAxisLabels.slice().reverse()" :key="label">{{ label }}</span>
            </div>

            <!-- Chart bars -->
            <div class="absolute top-0 right-0 bottom-0 left-10 flex items-end justify-between space-x-2">
                <div v-for="(data, index) in chartData" :key="index" class="flex h-full flex-1 flex-col items-center justify-end">
                    <!-- Income Bar -->
                    <div class="w-4 rounded-t-lg bg-blue-600" :style="{ height: calculateBarHeight(data.income) + 'px' }"></div>
                    <!-- Expenses Bar -->
                    <div class="mt-0.5 w-4 rounded-t-lg bg-purple-500" :style="{ height: calculateBarHeight(data.expenses) + 'px' }"></div>
                    <span class="mt-2 text-xs text-muted-foreground">{{ data.month }}</span>
                </div>
            </div>

            <!-- Legend -->
            <div class="mt-6 flex items-center justify-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-blue-600"></div>
                    <span class="text-sm text-muted-foreground">Income</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-purple-500"></div>
                    <span class="text-sm text-muted-foreground">Expenses</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any specific styles here if needed */
</style>
