<script setup lang="ts">
interface Props {
  category: string;
  amount: number;
  percentage: number;
  colorIndex: number;
}

const props = defineProps<Props>();

// Format currency
const formatCurrency = (value: number) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  }).format(value);
};

// Get color class based on index
const getColorClass = (index: number) => {
  const colorClasses = {
    0: 'bg-orange-500',
    1: 'bg-orange-400',
    2: 'bg-yellow-500',
    3: 'bg-green-500',
    4: 'bg-green-400',
    5: 'bg-cyan-500',
    6: 'bg-gray-500',
  };
  
  return colorClasses[index as keyof typeof colorClasses] || 'bg-blue-500';
};
</script>

<template>
  <div class="flex items-center justify-between">
    <div class="flex items-center">
      <span class="mr-2 h-3 w-3 rounded-full" :class="getColorClass(colorIndex)"></span>
      <span class="text-sm">{{ category }}</span>
    </div>
    <div class="flex items-center">
      <span class="mr-2 text-sm font-medium">{{ formatCurrency(amount) }}</span>
      <div class="flex w-16 items-center">
        <div class="h-1.5 w-full rounded-full bg-gray-200">
          <div class="h-1.5 rounded-full" 
               :class="getColorClass(colorIndex)"
               :style="{ width: `${percentage}%` }"></div>
        </div>
        <span class="ml-1 text-xs">{{ percentage }}%</span>
      </div>
    </div>
  </div>
</template>