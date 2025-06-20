<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { Button } from '@/components/ui/button';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { useAppearance } from '@/composables/useAppearance';
import type { BreadcrumbItemType } from '@/types';
import { Moon, Sun } from 'lucide-vue-next';

const props = withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);

const { appearance, updateAppearance } = useAppearance();

const toggleDarkMode = () => {
    updateAppearance(appearance.value === 'dark' ? 'light' : 'dark');
};
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-sidebar-border/70 px-3 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 sm:px-4 md:px-6"
    >
        <div class="flex min-w-0 flex-1 items-center gap-2">
            <SidebarTrigger class="-ml-1 shrink-0" />
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <div class="scrollbar-none overflow-x-auto">
                    <Breadcrumbs :breadcrumbs="breadcrumbs" />
                </div>
            </template>
        </div>

        <TooltipProvider :delay-duration="0">
            <Tooltip>
                <TooltipTrigger class="shrink-0">
                    <Button
                        variant="ghost"
                        size="icon"
                        class="group h-8 w-8 cursor-pointer focus-visible:ring-offset-0 sm:h-9 sm:w-9"
                        @click="toggleDarkMode"
                    >
                        <Sun v-if="appearance === 'dark'" class="size-4 opacity-80 group-hover:opacity-100 sm:size-5" />
                        <Moon v-else class="size-4 opacity-80 group-hover:opacity-100 sm:size-5" />
                        <span class="sr-only">Toggle dark mode</span>
                    </Button>
                </TooltipTrigger>
                <TooltipContent side="bottom">
                    <p>Toggle dark mode</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    </header>
</template>
