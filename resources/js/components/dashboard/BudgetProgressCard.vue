<script setup lang="ts">
defineProps({
    title: {
        type: String,
        required: true,
        default: 'Monthly Budgets',
    },
    budgets: {
        type: Array,
        required: true,
        default: () => [],
    },
});

// Define the budget item type for TypeScript
interface BudgetItem {
    category: string;
    amount: number;
    total: number;
    icon?: string;
}

// Function to get color class based on category
const getCategoryColorClass = (category: string) => {
    const colorMap: Record<string, string> = {
        'Grocery Stores': 'bg-green-500',
        Transportation: 'bg-cyan-500',
        Pets: 'bg-blue-500',
        Education: 'bg-indigo-500',
        Clothes: 'bg-purple-500',
    };

    return colorMap[category] || 'bg-gray-500';
};

// Function to get icon color class based on category
const getIconColorClass = (category: string) => {
    const colorMap: Record<string, string> = {
        'Grocery Stores': 'bg-green-100 text-green-600',
        Transportation: 'bg-cyan-100 text-cyan-600',
        Pets: 'bg-blue-100 text-blue-600',
        Education: 'bg-indigo-100 text-indigo-600',
        Clothes: 'bg-purple-100 text-purple-600',
    };

    return colorMap[category] || 'bg-gray-100 text-gray-600';
};

// Function to get icon based on category
const getCategoryIcon = (category: string) => {
    const iconMap: Record<string, string> = {
        'Grocery Stores': `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-8 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/></svg>`,
        Transportation: `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 17h14v-5H5v5zm0 0v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-1h6v1a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2M5 12V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v5M8 7h8m-8 5h8"/></svg>`,
        Pets: `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 5.172C10 3.782 8.423 2.679 6.5 3c-2.823.47-4.113 6.006-4 7 .08.703 1.725 1.722 3.656 1 1.261-.472 1.96-1.45 2.344-2.5M14.267 5.172c0-1.39 1.577-2.493 3.5-2.172 2.823.47 4.113 6.006 4 7-.08.703-1.725 1.722-3.656 1-1.261-.472-1.855-1.45-2.239-2.5M8.5 13c-1.098 0-2 .902-2 2 0 1.432 1.744 3 2.5 3 1.207 0 2.5-1.566 2.5-3 0-1.098-.902-2-2-2.5-.196-.101-.5 0-1 .5zM15.5 13c1.098 0 2 .902 2 2 0 1.432-1.744 3-2.5 3-1.207 0-2.5-1.566-2.5-3 0-1.098.902-2 2-2.5.196-.101.5 0 1 .5z"/></svg>`,
        Education: `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"/></svg>`,
        Clothes: `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>`,
    };

    return (
        iconMap[category] ||
        `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>`
    );
};
</script>

<template>
    <div class="rounded-lg border bg-card p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-medium">{{ title }}</h3>

        <div class="space-y-4">
            <div v-for="(budget, index) in budgets" :key="index" class="space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div :class="getIconColorClass((budget as BudgetItem).category)" class="rounded-full p-2">
                            <span v-html="getCategoryIcon((budget as BudgetItem).category)"></span>
                        </div>
                        <span class="text-sm font-medium">{{ (budget as BudgetItem).category }}</span>
                    </div>
                    <div class="text-sm font-medium">{{ (budget as BudgetItem).amount }} / {{ (budget as BudgetItem).total }}</div>
                </div>

                <div class="h-2 w-full overflow-hidden rounded-full bg-gray-100">
                    <div
                        class="h-full rounded-full"
                        :class="getCategoryColorClass((budget as BudgetItem).category)"
                        :style="{ width: `${((budget as BudgetItem).amount / (budget as BudgetItem).total) * 100}%` }"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</template>
