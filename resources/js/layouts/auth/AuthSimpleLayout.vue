<script setup lang="ts">
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 p-4 dark:bg-gray-950">
        <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-lg dark:bg-gray-900 dark:shadow-xl">
            <slot />
        </div>
    </div>
</template>
