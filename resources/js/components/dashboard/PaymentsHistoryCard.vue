<script setup>
import { computed } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  payments: {
    type: Array,
    required: true,
  },
});

const getStatusColor = (status) => {
  switch (status.toLowerCase()) {
    case 'paid':
      return 'bg-green-100 text-green-800';
    case 'due':
      return 'bg-yellow-100 text-yellow-800';
    case 'cancel':
      return 'bg-red-100 text-red-800';
    default:
      return 'bg-gray-100 text-gray-800';
  }
};
</script>

<template>
  <div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-semibold text-gray-800">{{ title }}</h3>
      <a href="#" class="text-blue-600 text-sm font-medium">See more</a>
    </div>
    <div class="space-y-4">
      <div v-for="(payment, index) in payments" :key="index" class="flex items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
            <!-- Placeholder for icon, replace with actual icon component if available -->
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"></path></svg>
          </div>
          <div>
            <p class="text-gray-800 font-medium">{{ payment.description }}</p>
            <p class="text-sm text-gray-500">{{ payment.date }}</p>
          </div>
        </div>
        <div class="flex flex-col items-end">
          <p :class="['font-semibold', payment.amount.startsWith('+') ? 'text-green-600' : 'text-red-600']">{{ payment.amount }}</p>
          <span :class="['px-2 py-0.5 rounded-full text-xs font-medium', getStatusColor(payment.status)]">{{ payment.status }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add any specific styles here if needed */
</style>