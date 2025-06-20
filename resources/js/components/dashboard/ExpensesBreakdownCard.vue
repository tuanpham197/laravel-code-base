<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import ExpenseItem from './ExpenseItem.vue';

interface Expense {
  category: string;
  amount: number;
  percentage: number;
}

interface Props {
  title: string;
  expenses: Expense[];
  monthlyGrowth: number;
}

const props = defineProps<Props>();
</script>

<template>
  <Card>
    <CardHeader class="pb-2">
      <div class="flex items-center justify-between">
        <CardTitle class="text-sm font-medium">{{ title }}</CardTitle>
        <div class="text-xs text-muted-foreground">
          <span class="mr-1">Last Month</span>
          <span class="font-medium text-green-500">↑ {{ monthlyGrowth }}%</span>
        </div>
      </div>
    </CardHeader>
    <CardContent>
      <ul class="space-y-3">
        <li v-for="(expense, index) in expenses" :key="index">
          <ExpenseItem 
            :category="expense.category" 
            :amount="expense.amount" 
            :percentage="expense.percentage" 
            :color-index="index"
          />
        </li>
      </ul>
    </CardContent>
  </Card>
</template>