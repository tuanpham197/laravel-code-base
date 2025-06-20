<script setup lang="ts">
interface Props {
  title: string;
  subtitle: string;
}

const props = defineProps<Props>();
</script>

<template>
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-primary">{{ title }}</h1>
      <p class="text-sm text-muted-foreground">{{ subtitle }}</p>
    </div>
    <div class="relative w-64">
      <input 
        type="text" 
        placeholder="Search Here" 
        class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
      />
      <button class="absolute right-1 top-1/2 -translate-y-1/2 rounded-md bg-primary p-1.5 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/>
          <path d="m21 21-4.3-4.3"/>
        </svg>
      </button>
    </div>
  </div>
</template>