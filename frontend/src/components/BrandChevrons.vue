<script setup>
import aDefault from '@/assets/icons/chevron-a.svg'
import bDefault from '@/assets/icons/chevron-b.svg'
import aNavy from '@/assets/icons/chevron-navy-a.svg'
import bNavy from '@/assets/icons/chevron-navy-b.svg'

const props = defineProps({
  tone: { type: String, default: 'default', validator: (v) => ['default', 'navy'].includes(v) },
})
const parts = props.tone === 'navy' ? [aNavy, bNavy] : [aDefault, bDefault]
</script>

<template>
  <!-- Figma "Brand/Chevrons": two 30×14 layers stacked; mirrored in RTL so they point along the reading direction -->
  <span class="chevrons" aria-hidden="true">
    <img v-for="src in parts" :key="src" :src="src" alt="" width="30" height="14" />
  </span>
</template>

<style scoped>
.chevrons {
  position: relative;
  display: block;
  flex-shrink: 0;
  width: 30px;
  height: 14px;
}
.chevrons img {
  position: absolute;
  inset: 0;
  width: 30px;
  height: 14px;
}
/* Both layers share one 30×14 box, so mirroring each layer mirrors the mark */
[dir='rtl'] .chevrons img {
  transform: scaleX(-1);
}
</style>
