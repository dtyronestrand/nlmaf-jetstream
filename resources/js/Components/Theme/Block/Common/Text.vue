<template>
    <section class="mb-8">
        <div v-if="block.content.text" class="text-[var(--color-text-primary)] text-justify text-xl md:text-2xl" v-html="block.content.text"></div>
        </section>
</template>
<script setup lang="ts">
defineOptions({
    name: 'BlockCommonText',
})
interface Props {
    block: Model.Block & PropsBlock
}
type PropsBlock = {
    content: {
        text?: string | null
    }
}
defineProps<Props>();
</script>