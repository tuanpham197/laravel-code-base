<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Progress } from '@/components/ui/progress';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Budget',
        href: '/budget',
    },
];

// Sample budget data - in a real app, this would come fromw your backend
const budgetCategories = [
    {
        category: 'Housing',
        budgeted: 2000,
        spent: 1800,
        remaining: 200,
        progress: 90,
    },
    {
        category: 'Transportation',
        budgeted: 500,
        spent: 350,
        remaining: 150,
        progress: 70,
    },
    {
        category: 'Food',
        budgeted: 600,
        spent: 450,
        remaining: 150,
        progress: 75,
    },
    {
        category: 'Utilities',
        budgeted: 300,
        spent: 280,
        remaining: 20,
        progress: 93,
    },
];

import { formatCurrency } from '@/lib/helpers';

const totalBudget = budgetCategories.reduce((acc, cat) => acc + cat.budgeted, 0);
const totalSpent = budgetCategories.reduce((acc, cat) => acc + cat.spent, 0);
const totalRemaining = budgetCategories.reduce((acc, cat) => acc + cat.remaining, 0);
</script>

<template>
    <AuthLayout :breadcrumbs="breadcrumbItems">
        <Head title="Budget Management" />

        <div class="container space-y-8 p-8">
            <Heading title="Budget Management" description="Track and manage your monthly budget across different categories" />

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader>
                        <CardTitle>Total Budget</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">{{ formatCurrency(totalBudget) }}</div>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Total Spent</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">{{ formatCurrency(totalSpent) }}</div>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Remaining</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">{{ formatCurrency(totalRemaining) }}</div>
                    </CardContent>
                </Card>
            </div>

            <Card>
                <CardHeader>
                    <div class="flex items-center justify-between">
                        <CardTitle>Budget Categories</CardTitle>
                        <Button variant="outline">Add Category</Button>
                    </div>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Category</TableHead>
                                <TableHead>Budgeted</TableHead>
                                <TableHead>Spent</TableHead>
                                <TableHead>Remaining</TableHead>
                                <TableHead>Progress</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="category in budgetCategories" :key="category.category">
                                <TableCell>{{ category.category }}</TableCell>
                                <TableCell>{{ formatCurrency(category.budgeted) }}</TableCell>
                                <TableCell>{{ formatCurrency(category.spent) }}</TableCell>
                                <TableCell>{{ formatCurrency(category.remaining) }}</TableCell>
                                <TableCell class="w-[200px]">
                                    <Progress :value="category.progress" class="w-[160px]" />
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AuthLayout>
</template>
