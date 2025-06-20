<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

interface Props {
  title: string;
  value: number;
  percentChange: number;
  lastMonthAmount: number;
  isNegativeChange?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  isNegativeChange: false
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
</script>

<template>
  <Card>
    <CardHeader class="pb-2">
      <CardTitle class="text-sm font-medium">{{ title }}</CardTitle>
    </CardHeader>
    <CardContent>
      <div class="text-2xl font-bold">{{ formatCurrency(value) }}</div>
      <div class="mt-1 flex items-center text-xs">
        <span class="flex items-center" :class="isNegativeChange ? 'text-red-500' : 'text-green-500'">
          <svg v-if="!isNegativeChange" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
            <path d="m5 12 7-7 7 7"/>
            <path d="M12 19V5"/>
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
            <path d="M19 12H5"/>
            <path d="m12 5-7 7 7 7"/>
          </svg>
          {{ percentChange }}%
        </span>
        <span class="ml-1 text-muted-foreground">Last month {{ formatCurrency(lastMonthAmount) }}</span>
      </div>
    </CardContent>
  </Card>
</template>