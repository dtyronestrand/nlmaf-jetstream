<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[var(--color-accent)] text-md font-medium leading-5 text-[var(--color-text-primary)] focus:outline-none focus:border-[var(--color-accent)] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-md font-medium leading-5 text-[var(--color-text-primary)] hover:text-[var(--color-accent)] hover:border-[var(--color-accent)] focus:outline-none focus:text-[var(--color-accent)] focus:border-[var(--color-accent)] transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
