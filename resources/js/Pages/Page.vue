<script setup  lang="ts">
import Head from '@/Components/Theme/Head.vue'
import { defineAsyncComponent } from 'vue'
import Default from '../Layouts/Default.vue'
interface Props {
    item: Model.Page
    locale: string
}
defineProps<Props>()
const BlockCommonHeading = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Heading.vue'))
const BlockCommonCardblock = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Cardblock.vue'))
const BlockCommonLanding = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Landing.vue'))
const BlockCommonHero = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Hero.vue'))
</script>
<template>
    <Head :item="item"></Head>
<Default>
    <div
    v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0"
    class="mx-auto mt-20 w-full max-w-6xl"
  >
    <div
      v-for="(block, index) in item.blocks"
      :key="index"
    >
      <BlockCommonHeading
        v-if="block.type == 'common-heading'"
        :block="block"
      ></BlockCommonHeading>

      <BlockCommonCardblock
        v-if="block.type == 'common-cardblock'"
        :block="block"
      ></BlockCommonCardblock>
        <BlockCommonLanding
            v-if="block.type == 'common-landing'"
            :block="block"
        ></BlockCommonLanding>
     


  
    </div>
  </div>
</Default>
</template>
<style scoped>
.gradient-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
          min-height: 100vh;
         
            overflow: hidden;
            background-attachment: fixed;
        }

        .gradient-sphere {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
        }

        .sphere-1 {
            width: 40vw;
            height: 40vw;
    
    --color-accent-200: #fbef9f;
    background: linear-gradient(120deg, #c0392b, #f2c1be);
            top: -10%;
            left: -10%;
            animation: float-1 15s ease-in-out infinite alternate;
        }

        .sphere-2 {
            width: 45vw;
            height: 45vw;
            background: linear-gradient(240deg,#e67e22, #f6c9a5);
            bottom: -20%;
            right: -10%;
            animation: float-2 18s ease-in-out infinite alternate;
        }

        .sphere-3 {
            width: 30vw;
            height: 30vw;
           
            background: linear-gradient(40deg, #f4d03f, #fbef9f);
            top: 60%;
            left: 20%;
            animation: float-3 20s ease-in-out infinite alternate;
        }

        .noise-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            z-index: 5;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        @keyframes float-1 {
            0% {
                transform: translate(0, 0) scale(1);
            }
            100% {
                transform: translate(10%, 10%) scale(1.1);
            }
        }

        @keyframes float-2 {
            0% {
                transform: translate(0, 0) scale(1);
            }
            100% {
                transform: translate(-10%, -5%) scale(1.15);
            }
        }

        @keyframes float-3 {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 0.3;
            }
            100% {
                transform: translate(-5%, 10%) scale(1.05);
                opacity: 0.6;
            }
        }

        .grid-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            z-index: 2;
        }

        .glow {
            position: absolute;
            width: 40vw;
            height: 40vh;
            background: radial-gradient(circle, rgba(72, 0, 255, 0.15), transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            animation: pulse 8s infinite alternate;
            filter: blur(30px);
        }

        @keyframes pulse {
            0% {
                opacity: 0.3;
                transform: translate(-50%, -50%) scale(0.9);
            }
            100% {
                opacity: 0.7;
                transform: translate(-50%, -50%) scale(1.1);
            }
        }
</style>