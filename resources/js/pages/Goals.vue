<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Progress } from '@/components/ui/progress';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { formatCurrency } from '@/lib/helpers';
import type { BreadcrumbItem } from '@/types';
import type { Goal, Transaction } from '@/types/goals';
import { Head } from '@inertiajs/vue3';
import { PlusCircle } from 'lucide-vue-next';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Goals',
        href: '/goals',
    },
];

// Sample data - in a real app, this would come from your backend
import { ref } from 'vue';

const goals: Goal[] = [
    {
        id: '1',
        name: 'Car',
        currentAmount: 1458.3,
        targetAmount: 5450.65,
        progress: 25,
        financialSummary: {
            lastMonth: 42678,
            expenses: 1798,
            taxes: 255.25,
            debt: 365478,
        },
        wallets: [
            {
                id: '1',
                name: 'City Bank',
                balance: 2500,
                maxBalance: 5000,
                progress: 50,
            },
            {
                id: '2',
                name: 'Cash Wallet',
                balance: 1000,
                maxBalance: 2000,
                progress: 50,
            },
            {
                id: '3',
                name: 'Visa Card',
                balance: 3000,
                maxBalance: 5000,
                progress: 60,
            },
        ],
    },
    {
        id: '2',
        name: 'Laptop',
        currentAmount: 1458.3,
        targetAmount: 5450.65,
        progress: 25,
        financialSummary: {
            lastMonth: 35000,
            expenses: 1200,
            taxes: 180.5,
            debt: 250000,
        },
        wallets: [
            {
                id: '1',
                name: 'City Bank',
                balance: 1800,
                maxBalance: 3000,
                progress: 60,
            },
            {
                id: '2',
                name: 'Cash Wallet',
                balance: 800,
                maxBalance: 1000,
                progress: 80,
            },
            {
                id: '3',
                name: 'Visa Card',
                balance: 2500,
                maxBalance: 4000,
                progress: 62,
            },
        ],
    },
    {
        id: '3',
        name: 'Vacation',
        currentAmount: 1458.3,
        targetAmount: 5450.65,
        progress: 25,
        financialSummary: {
            lastMonth: 28000,
            expenses: 950,
            taxes: 150.75,
            debt: 180000,
        },
        wallets: [
            {
                id: '1',
                name: 'City Bank',
                balance: 1200,
                maxBalance: 2000,
                progress: 60,
            },
            {
                id: '2',
                name: 'Cash Wallet',
                balance: 500,
                maxBalance: 1000,
                progress: 50,
            },
            {
                id: '3',
                name: 'Visa Card',
                balance: 1800,
                maxBalance: 3000,
                progress: 60,
            },
        ],
    },
    {
        id: '4',
        name: 'Phone',
        currentAmount: 1458.3,
        targetAmount: 5450.65,
        progress: 75,
        financialSummary: {
            lastMonth: 15000,
            expenses: 500,
            taxes: 85.25,
            debt: 95000,
        },
        wallets: [
            {
                id: '1',
                name: 'City Bank',
                balance: 800,
                maxBalance: 1500,
                progress: 53,
            },
            {
                id: '2',
                name: 'Cash Wallet',
                balance: 300,
                maxBalance: 500,
                progress: 60,
            },
            {
                id: '3',
                name: 'Visa Card',
                balance: 1200,
                maxBalance: 2000,
                progress: 60,
            },
        ],
    },
];

const selectedGoalId = ref(goals[0].id);
const selectedGoal = ref(goals[0]);

const setSelectedGoal = (goal: Goal) => {
    selectedGoalId.value = goal.id;
    selectedGoal.value = goal;
};

const transactions: Transaction[] = [
    {
        id: '1',
        date: '29 Jan 2024',
        wallet: 'Master Card',
        description: 'Necessities',
        amount: 100.0,
    },
    {
        id: '2',
        date: '29 Jan 2024',
        wallet: 'Master Card',
        description: 'Necessities',
        amount: 100.0,
    },
    {
        id: '3',
        date: '29 Jan 2024',
        wallet: 'Master Card',
        description: 'Necessities',
        amount: 100.0,
    },
];
</script>

<template>
    <AuthLayout :breadcrumbs="breadcrumbItems">
        <Head title="Goals" />

        <div class="container space-y-8 p-8">
            <Heading title="Goals" description="Welcome to Goals Finance Management" />

            <!-- Goals Grid -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <Card
                    v-for="goal in goals"
                    :key="goal.id"
                    :class="['relative cursor-pointer transition-all hover:scale-[1.02]', { 'ring-2 ring-primary': selectedGoalId === goal.id }]"
                    @click="setSelectedGoal(goal)"
                >
                    <CardHeader>
                        <CardTitle>{{ goal.name }}</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="space-y-2">
                            <div class="text-2xl font-bold">
                                {{ formatCurrency(goal.currentAmount) }}
                            </div>
                            <div class="text-sm text-muted-foreground">/ {{ formatCurrency(goal.targetAmount) }}</div>
                            <Progress :value="goal.progress" class="mt-2" />
                        </div>
                    </CardContent>
                </Card>

                <!-- Add New Goal Card -->
                <Card class="flex cursor-pointer items-center justify-center border-2 border-dashed hover:border-primary">
                    <CardContent class="flex flex-col items-center py-8">
                        <PlusCircle class="mb-2 h-8 w-8" />
                        <p class="text-sm font-medium">Add new goals</p>
                    </CardContent>
                </Card>
            </div>

            <!-- Financial Summary -->
            <Card>
                <CardHeader>
                    <CardTitle>Financial Summary</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-4">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Last Month</p>
                            <p class="text-2xl font-bold">{{ formatCurrency(selectedGoal.financialSummary.lastMonth) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Expenses</p>
                            <p class="text-2xl font-bold">{{ formatCurrency(selectedGoal.financialSummary.expenses) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Taxes</p>
                            <p class="text-2xl font-bold">{{ formatCurrency(selectedGoal.financialSummary.taxes) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Debt</p>
                            <p class="text-2xl font-bold">{{ formatCurrency(selectedGoal.financialSummary.debt) }}</p>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Available by Wallet -->
            <Card>
                <CardHeader>
                    <CardTitle>Available by Wallet</CardTitle>
                </CardHeader>
                <CardContent class="space-y-4">
                    <div v-for="wallet in selectedGoal.wallets" :key="wallet.id" class="space-y-2">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium">{{ wallet.name }}</p>
                            <p class="text-sm text-muted-foreground">{{ wallet.progress }}%</p>
                        </div>
                        <Progress :value="wallet.progress" />
                    </div>
                </CardContent>
            </Card>

            <!-- Transaction History -->
            <Card>
                <CardHeader>
                    <CardTitle>History</CardTitle>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Date</TableHead>
                                <TableHead>Wallet</TableHead>
                                <TableHead>Description</TableHead>
                                <TableHead class="text-right">Amount</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="transaction in transactions" :key="transaction.id">
                                <TableCell>{{ transaction.date }}</TableCell>
                                <TableCell>{{ transaction.wallet }}</TableCell>
                                <TableCell>{{ transaction.description }}</TableCell>
                                <TableCell class="text-right">
                                    {{ formatCurrency(transaction.amount) }}
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AuthLayout>
</template>
