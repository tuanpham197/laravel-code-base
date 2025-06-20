<script setup lang="ts">
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';

// Import dashboard components
import BudgetProgressCard from '@/components/dashboard/BudgetProgressCard.vue';
import ChartCard from '@/components/dashboard/ChartCard.vue';
import ExpensesBreakdownCard from '@/components/dashboard/ExpensesBreakdownCard.vue';
import IncomeExpensesChart from '@/components/dashboard/IncomeExpensesChart.vue';
import PaymentsHistoryCard from '@/components/dashboard/PaymentsHistoryCard.vue';
import SavingGoalsCard from '@/components/dashboard/SavingGoalsCard.vue';
import StatCard from '@/components/dashboard/StatCard.vue';
import TransactionHistoryCard from '@/components/dashboard/TransactionHistoryCard.vue';
import WeeklyExpensesChart from '@/components/dashboard/WeeklyExpensesChart.vue';

// Sample data for the dashboard
const balanceData = {
    totalBalance: 432568,
    periodChange: 245860,
    periodExpenses: 25.35,
    periodIncome: 22.56,
    percentChange: 3.47,
    lastMonthAmount: 24478,
    balanceTrends: 221478,
    monthlyGrowth: 12.25,
};

// Sample data for expenses breakdown
const expensesBreakdown = [
    { category: 'Food', amount: 1200, percentage: 38 },
    { category: 'Transport', amount: 1200, percentage: 38 },
    { category: 'Healthcare', amount: 1200, percentage: 38 },
    { category: 'Education', amount: 1200, percentage: 38 },
    { category: 'Clothes', amount: 1200, percentage: 38 },
    { category: 'Pets', amount: 1200, percentage: 38 },
    { category: 'Entertainment', amount: 1200, percentage: 38 },
];

// Sample chart data
const chartData = {
    labels: ['4 Jan', '5 Jan', '6 Jan', '7 Jan', '8 Jan', '9 Jan', '10 Jan'],
    values: [20, 40, 60, 50, 90, 70, 80],
};

// Sample budget data
const budgetData = [
    { category: 'Grocery Stores', amount: 75, total: 100 },
    { category: 'Transportation', amount: 25, total: 100 },
    { category: 'Pets', amount: 50, total: 100 },
    { category: 'Education', amount: 45, total: 100 },
    { category: 'Clothes', amount: 35, total: 100 },
];

// Sample income vs expenses data
const incomeExpensesData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    income: [5, 6, 4.7, 5.5, 3, 6, 4.5, 6, 8, 3],
    expenses: [4, 5, 3.5, 5, 2, 5, 3.5, 5, 7, 2],
};

// Sample weekly expenses data
const weeklyExpensesData = [
    { month: 'Jan', income: 48, expenses: 30 },
    { month: 'Feb', income: 51, expenses: 35 },
    { month: 'Mar', income: 75, expenses: 40 },
    { month: 'Apr', income: 64, expenses: 32 },
    { month: 'May', income: 72, expenses: 38 },
    { month: 'Jun', income: 50, expenses: 25 },
    { month: 'Jul', income: 62, expenses: 30 },
    { month: 'Aug', income: 60, expenses: 28 },
    { month: 'Sep', income: 47, expenses: 22 },
    { month: 'Oct', income: 68, expenses: 35 },
    { month: 'Nov', income: 65, expenses: 33 },
    { month: 'Dec', income: 50, expenses: 25 },
    { month: 'Jan', income: 40, expenses: 20 },
    { month: 'Feb', income: 38, expenses: 18 },
    { month: 'Mar', income: 50, expenses: 25 },
    { month: 'Apr', income: 42, expenses: 20 },
    { month: 'May', income: 55, expenses: 28 },
    { month: 'Jun', income: 48, expenses: 24 },
];

// Sample payments history data
const paymentsHistoryData = [
    { id: 1, description: 'Internet', date: '5 January 2024', amount: '+$450.00', status: 'Due' },
    { id: 2, description: 'Apple Music', date: '5 January 2024', amount: '+$450.00', status: 'Cancel' },
    { id: 3, description: 'Groceries', date: '5 January 2024', amount: '+$450.00', status: 'Paid' },
    { id: 4, description: 'Electricity Bill', date: '4 January 2024', amount: '+$120.00', status: 'Paid' },
    { id: 5, description: 'Gym Membership', date: '3 January 2024', amount: '+$60.00', status: 'Due' },
];

// Sample saving goals data
const savingGoalsData = [
    { title: 'Vacation', progress: 80, target: 5000, current: 4000 },
    { title: 'Gift', progress: 80, target: 1000, current: 800 },
    { title: 'New Car', progress: 80, target: 30000, current: 24000 },
    { title: 'Laptop', progress: 80, target: 2000, current: 1600 },
];

// Sample extended transactions data
const transactionHistoryData = [
    {
        category: 'Beauty',
        date: '12.12.2023',
        description: 'Grocery Items and Beverage soft drinks',
        amount: -32.2,
        currency: 'USD',
        icon: '<svg xmlns="http://www.w3.org/2000/svg" class="text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
        iconBgColor: 'bg-teal-100',
    },
    {
        category: 'Bills & Fees',
        date: '12.12.2023',
        description: 'Grocery Items and Beverage soft drinks',
        amount: -32.2,
        currency: 'USD',
        icon: '<svg xmlns="http://www.w3.org/2000/svg" class="text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>',
        iconBgColor: 'bg-cyan-100',
    },
    {
        category: 'Car',
        date: '12.12.2023',
        description: 'Grocery Items and Beverage soft drinks',
        amount: -32.2,
        currency: 'USD',
        icon: '<svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 16H9m10 0h3v-3.15a1 1 0 0 0-.84-.99L16 11l-2.99-3.99A1 1 0 0 0 12.16 6H7.84a1 1 0 0 0-.84.37L4 10 1.84 11a1 1 0 0 0-.84 1v3h3m16 0H4m16 0-3-3H7l-3 3m0 0v3a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-3"></path></svg>',
        iconBgColor: 'bg-blue-100',
    },
    {
        category: 'Education',
        date: '12.12.2023',
        description: 'Grocery Items and Beverage soft drinks',
        amount: -32.2,
        currency: 'USD',
        icon: '<svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14v7M3.27 6.96 12 12.01l8.73-5.05M22 10v6"/></svg>',
        iconBgColor: 'bg-indigo-100',
    },
    {
        category: 'Entertainment',
        date: '12.12.2023',
        description: 'Grocery Items and Beverage soft drinks',
        amount: -32.2,
        currency: 'USD',
        icon: '<svg xmlns="http://www.w3.org/2000/svg" class="text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 2 10 20M17 2 7 22M2 12h20M2 7h20M2 17h20"/></svg>',
        iconBgColor: 'bg-purple-100',
    },
];

// Expose transactions for template usage
const transactions = transactionHistoryData;
</script>

<template>
    <Head title="Dashboard" />

    <AuthLayout title="Dashboard" description="Welcome Ekash Finance Management">
        <div class="flex h-full flex-1 flex-col gap-4 bg-card p-4">
            <!-- Stats cards -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <StatCard
                    title="Total Balance"
                    :value="balanceData.totalBalance"
                    :percent-change="balanceData.percentChange"
                    :last-month-amount="balanceData.lastMonthAmount"
                />

                <StatCard
                    title="Total Period Change"
                    :value="balanceData.periodChange"
                    :percent-change="balanceData.percentChange"
                    :last-month-amount="balanceData.lastMonthAmount"
                />

                <StatCard
                    title="Total Period Expenses"
                    :value="balanceData.periodExpenses"
                    :percent-change="balanceData.percentChange"
                    :last-month-amount="balanceData.lastMonthAmount"
                    :is-negative-change="true"
                />

                <StatCard
                    title="Total Period Income"
                    :value="balanceData.periodIncome"
                    :percent-change="balanceData.percentChange"
                    :last-month-amount="balanceData.lastMonthAmount"
                />
            </div>

            <!-- Charts and breakdown -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <!-- Balance Trends Chart -->
                <ChartCard title="Balance Trends" :value="balanceData.balanceTrends" :chart-data="chartData" />

                <!-- Monthly Expenses Breakdown -->
                <ExpensesBreakdownCard title="Monthly Expenses Breakdown" :expenses="expensesBreakdown" :monthly-growth="balanceData.monthlyGrowth" />
            </div>

            <!-- Additional charts section -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <!-- Monthly Budgets -->
                <BudgetProgressCard title="Monthly Budgets" :budgets="budgetData" />

                <!-- Monthly Income vs Expenses -->
                <IncomeExpensesChart title="Monthly Income vs Expenses" :chart-data="incomeExpensesData" />
            </div>

            <!-- Recent Transactions -->
            <div class="rounded-lg border bg-card p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium dark:text-white">Recent Transactions</h3>

                <div class="space-y-4">
                    <div v-for="(transaction, index) in transactions" :key="index" class="flex items-center justify-between dark:text-gray-300">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full" :class="transaction.iconBgColor">
                                <span v-html="transaction.icon"></span>
                            </div>
                            <div>
                                <p class="text-sm font-medium">{{ transaction.description }}</p>
                                <p class="text-xs text-gray-500">{{ transaction.date }}</p>
                            </div>
                        </div>
                        <div
                            class="text-sm font-medium"
                            :class="transaction.amount < 0 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400'"
                        >
                            {{ transaction.amount }}
                        </div>
                    </div>
                </div>

                <button
                    class="mt-4 w-full rounded-md border border-gray-200 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                >
                    View All Transactions
                </button>
            </div>

            <!-- New Section: Weekly Expenses and Payments History -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <WeeklyExpensesChart title="Weekly Expenses" :chart-data="weeklyExpensesData" />
                <PaymentsHistoryCard title="Payments History" :payments="paymentsHistoryData" />
            </div>

            <!-- New Section: Saving Goals and Transaction History -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <SavingGoalsCard title="Saving Goals" :goals="savingGoalsData" />
                <TransactionHistoryCard title="Transaction History" :transactions="transactionHistoryData" />
            </div>
        </div>
    </AuthLayout>
</template>
