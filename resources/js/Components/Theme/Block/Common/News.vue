<template>
<article class="flex news border border-[var(--color-accent-500)] rounded-lg transition mx-auto hover:shadow-xl max-w-[50%] ">
<div class="text-[var(--color-text-primary)]  p-4 sm:!border-1-transparent sm:p-6 ">
{{dayjs( block.content.date ).format('dddd, MMMM D, YYYY')}}
</div>
   
        <div class="border-s border-[var(--color-accent-500)] p-4 sm:!border-1-transparent sm:p-6">
            <a href="#">
                <h2 class="text-5xl text-[var(--color-text-primary)]">{{ block?.content.title }}</h2>
            </a>
             <div class="grid ">
            <span class=" mt-8 line-clamp-3 text-lg/relaxed text-[var(--color-text-primary)]"  v-html="block?.content.description"></span>
              
            <a href="#" class=" bg-[var(--color-accent-500)] max-w-[25%] px-2 py-3 text-center text-xs font-bold text-[var(--color-neutral-900)] uppercase transition hover:bg-[var(--color-accent-300)] mb-4 mr-4">
               {{block?.content.label}}
            </a>
            </div>
        <figure class="relative max-h-[50%] max-w-[50%]">
  <img :src="block?.medias.image?.default.src" alt="Image" class=" rounded-lg">
        </figure>
   
    </div>
</article>

</template>
<script setup lang="ts">
import dayjs from 'dayjs'


defineOptions({
    name: 'BlockCommonNews',
})

interface Props{
    block: Model.Block & PropsBlock
}

type PropsBlock = {
    content:{
    title?: string | null
    description?: string | null
    date?: Date | null
    label?: string | null
    }
medias?:{
    image?: Model.MediaWithRoles | null
}
}
defineProps<Props>()


</script>
<style scoped>
.news {
    background: rgba(from var(--color-primary-700) r g b / 0.4);;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 30px rgba(from var(--color-accent) r g b / 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
</style>