<script setup lang="ts">
import FallingStarsBackground from '../../UI/FallingStarsBackground.vue'
import BlurReveal from '../../UI/BlurReveal.vue'
import FlipWords from '../../UI/FlipWords.vue'
import GlareCard from '../../UI/GlareCard.vue'
import {router} from '@inertiajs/vue3'
import IconButton from '../../UI/IconButton.vue'
defineOptions({
    name: 'BlockCommonLanding',
})

interface Props {
    block: Model.Block & PropsBlock
}
type PropsBlock = {
    content:{
        heading?: string | null
        details?: string | null
    }
    childs?: PropsChildBlock | null
}
type PropsChildBlock = {
    content: {
        title?: string | null
        details?: string | null
        link?: string | null
    }
    medias: {
        image?: Model.MediaWithRoles | null
    }
}
defineProps<Props>();
</script>
<template>
        <span class="flex flex-col items-center justify-center bg-gradient-to-b from-[var(--color-neutral-100)] to-[var(--color-neutral-300)] bg-clip-text text-center text-4xl font-bold text-transparent md:text-6xl"><h1>Our Programs
    </h1></span>
    <section class="-mt-16 text-[var(--color-text-primary)] flex min-h-screen w-full flex-col items-center justify-center">

    <div class="absolute inset-0 z-[1] bg-black opacity-[50%]"></div>
    <div class="z-[2] flex max-w-xl flex-col items-center gap-2">
    <BlurReveal
    :delay="0.5"
    class="flex flex-col items-center justify-center gap-4"
    >
 
    <div v-for="child in block.childs" :key="child.id" class="mt-12">
    <GlareCard class="text-[var(--color-neutral-900)] ">
    <h3 class="text-center text-3xl" >{{ child.content.title }}</h3>
    <img v-if="child.medias.image" :src="child.medias.image.default.src" alt="Child Image" class="w-full h-[300px] rounded-lg">
   <p class="text-center mt-2">{{ child.content.details }}</p>
   
    </GlareCard>
    <IconButton :href="child.content.link" class="mt-4 text-[var(--color-neutral-900)]" >Learn More</IconButton>
    </div>
        
    </BlurReveal>
    </div>
    </section>
</template>