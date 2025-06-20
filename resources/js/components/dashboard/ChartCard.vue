<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

interface Props {
  title: string;
  value: number;
  chartData?: {
    labels: string[];
    values: number[];
  };
}

const props = withDefaults(defineProps<Props>(), {
  chartData: () => ({
    labels: ['4 Jan', '5 Jan', '6 Jan', '7 Jan', '8 Jan', '9 Jan', '10 Jan'],
    values: [20, 40, 60, 50, 90, 70, 80]
  })
});

// Format currency
const formatCurrency = (value: number) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  }).format(value);
};

// Get max value for chart scaling
const maxValue = Math.max(...props.chartData.values) * 1.2;

// Generate y-axis labels
const yAxisLabels = Array.from({ length: 5 }, (_, i) => {
  return Math.round(maxValue - (i * (maxValue / 4)));
});
</script>

<template>
  <Card class="lg:col-span-2">
    <CardHeader class="pb-2">
      <CardTitle class="text-sm font-medium">{{ title }}</CardTitle>
    </CardHeader>
    <CardContent>
      <div class="text-2xl font-bold">{{ formatCurrency(value) }}</div>
      <div class="mt-4 h-[200px] w-full">
        <!-- Chart placeholder - in a real app, you'd use a chart library like Chart.js -->
        <div class="relative h-full w-full rounded-md bg-blue-50">
          <!-- Simplified chart visualization -->
          <div 
            v-for="(value, index) in chartData.values" 
            :key="index"
            class="absolute bottom-0 bg-blue-600 opacity-60 rounded-md"
            :style="{
              left: `${(index / (chartData.values.length - 1)) * 100}%`,
              height: `${(value / maxValue) * 100}%`,
              width: `${80 / chartData.values.length}%`,
              transform: 'translateX(-50%)'
            }"
          ></div>
          
          <!-- Y-axis labels -->
          <div class="absolute left-2 top-0 flex h-full flex-col justify-between text-xs text-gray-500">
            <span v-for="(label, index) in yAxisLabels" :key="index">{{ label }}</span>
          </div>
          
          <!-- X-axis labels -->
          <div class="absolute bottom-2 left-10 flex w-[calc(100%-40px)] justify-between text-xs text-gray-500">
            <span v-for="(label, index) in chartData.labels" :key="index">{{ label }}</span>
          </div>
        </div>
      </div>
    </CardContent>
  </Card>
</template>