<template>
 <Default>
  <div>
    <Head title="Programs" />
      <h1 class="text-7xl text-center text-[var(--color-text-primary)] mb-12">Our Programs</h1>
    <ul class="flex flex-wrap justify-center gap-4 mt-8">
      <li v-for="program in programs.data" :key="program.id" class="card">
      <figure v-if="program.blocks && program.blocks[0].type === 'image'" class="mb-4">
      <BlockCommonImage :block="program.blocks[0]" />
      </figure>
        <div class="card-details">
          <h2 class="text-title">{{ program.title }}</h2>
        
          <p class="text-body">{{ program.tagline }}</p>
        </div>
        <button class="card-button">
            <a :href="`/programs/${program.title.toLowerCase()}`">Learn More</a>
        </button>
      </li>
    </ul>
    
  </div>
 </Default>
</template>
<script setup lang="ts">
import Head from '@/Components/Theme/Head.vue'
import Default from '../../Layouts/Default.vue'
import {defineAsyncComponent} from 'vue'


interface Props {
  programs: {
    data: Array<{
      id: number;
      title: string;
      tagline?: string | null;
      slug?: string;
    }>;
    medias?: {
      image?: {
        default: {
          src: string;
        };
      } | null;
    };
  };
}

defineProps<Props>();
const BlockCommonImage = defineAsyncComponent(() => import('../../Components/Theme/Block/Common/Image.vue'))

</script>
<style scoped>
.card {
 width: 380px;
 height: 508px;
 border-radius: 20px;
 background: var(--color-primary-900);
 position: relative;
 padding: 1.8rem;
 border: 2px solid var(--color-secondary-500);
 transition: 0.5s ease-out;
 overflow: visible;
}

.card-details {
 color: black;
 height: auto;
 gap: .5em;
 display: grid;
 place-content: center;
}

.card-button {
 transform: translate(-50%, 125%);
 width: 60%;
 border-radius: 1rem;
 border: none;
 background-color: var(--color-accent-500);
 color: varr(--color-neutral-900);
 font-size: 1rem;
 padding: .5rem 1rem;
 position: absolute;
 left: 50%;
 bottom: 0;
 opacity: 0;
 transition: 0.3s ease-out;
}

.text-body {
 color: var(--color-text-primary);
}

/*Text*/
.text-title {
 font-size: 1.5em;
 font-weight: bold;
  color: var(--color-text-primary);
  text-align: center;
}

/*Hover*/
.card:hover {
 border-color: var(--color-accent-500);
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
}

.card:hover .card-button {
 transform: translate(-50%, 50%);
 opacity: 1;
}
</style>
