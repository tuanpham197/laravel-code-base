<script setup lang="ts">
defineProps({
    title: {
        type: String,
        required: true,
        default: 'Monthly Income vs Expenses'
    },
    chartData: {
        type: Object,
        required: true,
        default: () => ({
            labels: [],
            income: [],
            expenses: []
        })
    }
});

// Define the chart data type for TypeScript
interface ChartData {
    labels: string[];
    income: number[];
    expenses: number[];
}

// Function to get the maximum value for the chart scale
const getMaxValue = (data: ChartData) => {
    const allValues = [...data.income, ...data.expenses];
    return Math.max(...allValues, 8) + 1; // Add 1 for some padding, minimum of 8
};

// Function to calculate the height percentage for a bar
const getBarHeight = (value: number, maxValue: number) => {
    return (value / maxValue) * 100;
};
</script>

<template>
    <div class="rounded-lg border bg-card p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-medium">{{ title }}</h3>
        
        <div class="relative h-[200px] w-full">
            <!-- Y-axis labels -->
            <div class="absolute left-0 top-0 flex h-full flex-col justify-between text-xs text-gray-500 pr-2">
                <span v-for="n in 9" :key="n">{{ 9 - n }}</span>
            </div>
            
            <!-- Chart bars -->
            <div class="absolute left-6 right-0 top-0 flex h-full items-end justify-between">
                <div 
                    v-for="(label, index) in chartData.labels" 
                    :key="index"
                    class="flex flex-col items-center gap-1 w-6"
                >
                    <!-- Income bar -->
                    <div class="relative w-4">
                        <div 
                            class="absolute bottom-0 w-full bg-indigo-600 rounded-t" 
                            :style="{ height: `${getBarHeight(chartData.income[index], getMaxValue(chartData))}%` }"
                        ></div>
                    </div>
                    
                    <!-- Expenses bar -->
                    <div class="relative w-4 ml-2">
                        <div 
                            class="absolute bottom-0 w-full bg-indigo-300 rounded-t" 
                            :style="{ height: `${getBarHeight(chartData.expenses[index], getMaxValue(chartData))}%` }"
                        ></div>
                    </div>
                    
                    <!-- X-axis label -->
                    <span class="text-xs text-gray-500 mt-1">{{ label }}</span>
                </div>
            </div>
        </div>
        
        <!-- Legend -->
        <div class="mt-4 flex items-center justify-center gap-4">
            <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-sm bg-indigo-600"></div>
                <span class="text-xs text-gray-600">Income</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-sm bg-indigo-300"></div>
                <span class="text-xs text-gray-600">Expenses</span>
            </div>
        </div>
    </div>
</template>