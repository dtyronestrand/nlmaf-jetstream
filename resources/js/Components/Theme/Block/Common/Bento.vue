<template>
<div v-for="child in block.childs" :key="child.content.title" :class="[p-6, getBentoSize(child)]">
<h3 class="text-lg font-semibold mb-1">{{child.content.title}}</h3>
<div v-if="child.content.content" v-html="child.content.content" class="text-sm flex-grow overflow-hidden"></div>
<div class="flex rounded-lg bg-gunmetal-800 ring ring-gunmetal-750 overflow-hidden aspect-[340/376] @md:aspect-[640/376]">
 <img v-if="child.medias" :src="child.medias.image.default.src" :alt="child.content.title" class="object-contain object-[1rem_1rem] @md:object-[center_1rem] w-full h-full [mask-image:var(--image-mask-bottom)]" />
 </div>
</div>
</template>
<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import {computed} from 'vue';
defineOptions({
  name: 'BlockCommonBento',
})
function getBentoSize(child: BentoItem) {
    switch (child.content?.size) {
        case 'small':
            return 'col-span-2 row-span-1 bg-[var(--color-primary-800)]';
        case 'medium':
            return 'col-span-3 row-span-2 bg-[var(--color-primary-800)]';
        case 'large':
            return 'col-span-4 row-span-3 bg-[var(--color-primary-800)]';
        default:
            return 'col-span-1 row-span-1 bg-[var(--color-primary-800)]';
    }
}
type BentoItem = {
    content: {
    title?: string | null; // Optional title within the content object
    content?: string | null; // The actual HTML content/description
    size?: 'small' | 'medium' | 'large' | null; // Optional size property
};
  medias: {
  image?: Model.MediaWithRoles | null;
};
}

interface Props {
  block: {
    childs: BentoItem[]; // block.childs is directly an array of BentoItem
  }
}

defineProps<Props>();
</script>
