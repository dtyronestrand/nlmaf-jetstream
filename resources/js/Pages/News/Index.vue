<template>
    <Default>
    <h1 class="text-7xl text-center text-[var(--color-text-primary)] mt-12 mb-12">No Limits News</h1>
    <!-- Iterate over each news item in news.data -->
    <div v-for="newsItem in news.data" :key="newsItem.id" class="mb-12">
        <!-- Display the title of the news item -->
        <!-- Iterate over blocks within each news item -->
        <div v-for="(block, index) in newsItem.blocks" :key="index" class="mb-8">
            <BlockCommonNews v-if="block.type === 'common-news'" :block="block"></BlockCommonNews>
            <!-- You could add more v-if conditions here if news items can have other block types -->
        </div>
    </div>
    </Default>
</template>

<script setup lang="ts">
import { defineAsyncComponent } from 'vue';
import Default from '../../Layouts/Default.vue';
// Define the structure of the 'content' part of a block,
// aligning with what BlockCommonNews expects.
interface NewsBlockContent {
    title?: string | null;
    description?: string | null;
    date?: string | Date | null; // Date might come as a string from the backend
    label?: string | null;
}

// Define the structure of the 'medias' part of a block.
interface NewsBlockMedias {
    image?: {
        default: {
            src: string;
        };
        // Include other roles if Model.MediaWithRoles is more complex and used
    } | null;
}

// Define the structure of a single block object within a news item.
interface NewsBlock {
    type: string; // e.g., 'common-news'
    content: NewsBlockContent;
    medias?: NewsBlockMedias;
    // Add any other properties that Model.Block might have and are necessary
}

// Define the structure of a single news item.
interface Props {
    news: {
        data: Array<{
            id: number;
            title: string;
            blocks: NewsBlock[];
        }>;
    };
}

defineProps<Props>();

const BlockCommonNews = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/News.vue'));
</script>