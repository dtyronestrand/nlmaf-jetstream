<script setup lang="ts">
import Picture from '../../../Theme/UI/Picture.vue'

defineOptions({
  name: 'BlockCommonImage',
})

interface Props {
  block: Model.Block & PropsBlock
}

type PropsBlock = {
  medias: {
    image?: Model.MediaWithRoles
  }
}

defineProps<Props>()
</script>

<template>
  <div
    v-if="block?.medias?.image?.default"
    class="my-4"
  >
    <Picture
      :media="block.medias.image.default"
      class="w-full"
    ></Picture>
  </div>
</template>