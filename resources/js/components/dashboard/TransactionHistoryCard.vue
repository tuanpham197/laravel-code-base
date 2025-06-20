<script setup lang="ts">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { computed } from 'vue';

interface Transaction {
    category: string;
    date: string;
    description: string;
    amount: number;
    currency: string;
    icon: string;
    iconBgColor: string;
}

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    transactions: {
        type: Array as () => Transaction[],
        required: true,
    },
});

function formatCurrency(amount: number, currency: string): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency,
    }).format(amount);
}

const formattedTransactions = computed(() =>
    props.transactions.map((t) => ({
        ...t,
        formattedAmount: formatCurrency(t.amount, t.currency),
    })),
);
</script>

<template>
    <div class="rounded-lg border bg-card p-6 shadow-sm">
        <h3 class="mb-6 text-lg font-medium text-primary">{{ title }}</h3>

        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>Category</TableHead>
                    <TableHead>Date</TableHead>
                    <TableHead>Description</TableHead>
                    <TableHead class="text-right">Amount</TableHead>
                    <TableHead class="text-right">Currency</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="transaction in formattedTransactions" :key="transaction.date + transaction.description" class="hover:bg-muted/50">
                    <TableCell>
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full" :class="transaction.iconBgColor">
                                <span v-html="transaction.icon" class="h-4 w-4"></span>
                            </div>
                            <span>{{ transaction.category }}</span>
                        </div>
                    </TableCell>
                    <TableCell>{{ transaction.date }}</TableCell>
                    <TableCell>{{ transaction.description }}</TableCell>
                    <TableCell class="text-right" :class="transaction.amount < 0 ? 'text-red-500' : 'text-green-500'">
                        {{ transaction.formattedAmount }}
                    </TableCell>
                    <TableCell class="text-right">{{ transaction.currency }}</TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
