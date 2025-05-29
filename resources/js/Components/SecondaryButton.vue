<script setup lang="ts">
withDefaults(
    defineProps<{
        type?: 'button' | 'submit' | 'reset';
    }>(),
    {
        type: 'button',
    },
);
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center rounded-md border border-[var(--color-secondary-500)] bg-[var(--color-accent-500)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[var(--color-neutral-900)] shadow-sm transition duration-150 ease-in-out hover:bg-[var(--color-accent-300)] focus:outline-none focus:ring-2 focus:ring-[var(--color-secondary-500)] focus:ring-offset-2 disabled:opacity-25"
    >
        <slot />
    </button>
</template>
