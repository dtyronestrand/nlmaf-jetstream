<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-xl font-bold text-[var(--color-accent)]">
                <slot name="title" />
            </h3>

            <p class="mt-4 text-lg text-[var(--color-text-primary)]">
                <slot name="description" />
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside" />
        </div>
    </div>
</template>
