<script setup lang="ts">
interface SavingGoal {
    title: string;
    progress: number;
    target: number;
    current: number;
}

defineProps({
    title: {
        type: String,
        required: true,
    },
    goals: {
        type: Array as () => SavingGoal[],
        required: true,
    },
});

function formatAmount(amount: number): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(amount);
}
</script>

<template>
    <div class="rounded-3xl bg-white p-8 dark:bg-gray-800">
        <h2 class="mb-12 text-2xl font-semibold text-[#1E1B4B] dark:text-white">{{ title }}</h2>
        <div class="grid grid-cols-2 gap-x-16 gap-y-12">
            <div v-for="goal in goals" :key="goal.title" class="flex flex-col items-center">
                <!-- SVG Circle Progress -->
                <div class="relative mb-6">
                    <svg class="h-32 w-32 -rotate-90 transform">
                        <!-- Background circle -->
                        <circle cx="64" cy="64" r="56" stroke="#F3F4F6" stroke-width="4" fill="none" class="dark:stroke-gray-700" />
                        <!-- Progress circle -->
                        <circle
                            cx="64"
                            cy="64"
                            r="56"
                            stroke="#4F46E5"
                            stroke-width="4"
                            fill="none"
                            :stroke-dasharray="`${goal.progress * 3.51} 351.858`"
                            class="transition-all duration-300 ease-in-out"
                        />
                    </svg>
                    <!-- Percentage Text -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="rotate-90 transform text-lg font-medium text-[#4F46E5] dark:text-blue-400"> {{ goal.progress }}% </span>
                    </div>
                </div>
                <h3 class="mb-2 text-xl font-medium text-[#1E1B4B] dark:text-white">{{ goal.title }}</h3>
                <p class="text-lg text-gray-700 dark:text-gray-300">{{ formatAmount(goal.current) }}</p>
                <p class="text-base text-gray-500 dark:text-gray-400">of {{ formatAmount(goal.target) }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
circle {
    transition: stroke-dasharray 0.3s ease;
}
</style>
