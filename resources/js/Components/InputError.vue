<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-md font-semibold text-[var(--color-primary-200)]">
            {{ message }}
        </p>
    </div>
</template>
