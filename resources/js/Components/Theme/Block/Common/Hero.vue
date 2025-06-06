<script setup lang="ts">
import Heading from './Heading.vue'
import IconButton from '../../UI/IconButton.vue';
import {Link} from '@inertiajs/vue3';
import InteractiveGrid from '../../UI/InteractiveGrid.vue'
defineOptions({
    name: 'BlockCommonHero',
})
interface Props {
    block: Model.Block & PropsBlock
}
type PropsBlock = {
    content: {
        button_link?: string | null
        button_text?: string | null
    }
    medias:{
        image?: Model.Media | Model.MediaWithRoles | null
    }
    childs:{
        blocks?: Model.Block[] | null
    }
    
}
const props = defineProps<Props>();

</script>
<template>
<div  v-if="block.content.variant === 'text'">
<h1 class=" text-center pt-10 text-[var(--color-text-primary)] md:text-7xl text-5xl font-bold mb-4">
    {{ block.content.heading }}</h1>
<span class="text-[var(--color-text-primary)] md:text-2xl text-lg text-center block">
    {{ block.content.subheading }}
</span>
<figure class="mt-8">
    <img v-if="block.medias.image" :src="block.medias.image.default.src" height="50%" width="100%" alt="Hero Image" class="mx-auto mb-12 mt-12">
    </figure>
</div>
<div v-else>
    <div v-if="block.childs" class="flex flex-col items-center justify-center text-center">

        <div v-for="(child,index) in block.childs" :key="index">
            <Heading class="text-[var(--color-text-primary)] md:text-7xl text-5xl" v-if="child.type == 'common-heading'" :block="child"></Heading>
        </div>
    </div>
    <div class="glass-container-logo mx-auto mt-16 w-fit">
        <div
        class="hero__glow hero__glow--one absolute left-1/3 top-0 -z-10 h-2/3 w-2/3 bg-yellow-400/50 mix-blend-screen blur-[120px] filter"
      ></div>
      <div
        class="hero__glow hero__glow--two absolute left-0 top-1/3 -z-10 h-2/3 w-2/3 bg-orange-600/50 mix-blend-screen blur-[120px] filter"
      ></div> 
    <img v-if="block.medias.image" :src="block.medias.image.default.src" height="500ox" width="500px" alt="Hero Image" class="rounded-full   mx-auto mb-12 mt-12">
    </div>
    <div v-if="block.content.button_text && block.content.button_link && $page.props.auth.user === null" class="mt-4 flex items-center justify-center">
        <IconButton :href="block.content.button_link" class="inline-block px-6  py-3 bg-[var(--color-accent)] text-[var(--color-inverse-text)] font-bold rounded hover:border-[var(--color-accent-900)] hover:bg-blue-700 transition">
            {{ block.content.button_text }}
        </IconButton>
        </div>
</div>
     
    </template>
    <style scoped>
    .glass-container-logo::before {
  position: absolute;
  inset: -10px;
  z-index: -10;
  border-radius: 50%;
  border: 1px solid rgba(239, 68, 68, 0.2);
  background-color: rgba(209, 213, 219, 0.1);
  backdrop-filter: blur(10px);
  content: '';
}

.glass-container-logo {
  position: relative;
}
    </style>