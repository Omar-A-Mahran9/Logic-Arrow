<script setup>
import arrow from '@/assets/icons/arrow.svg'
</script>

<template>
  <!-- Figma "arrow-right-02": 24×24 frame, glyph inset 26.04% / 13.54%, coloured by currentColor -->
  <span class="arrow" aria-hidden="true">
    <!-- Quoted: Vite inlines small SVGs as data URIs that contain spaces -->
    <span class="arrow__glyph" :style="{ '--arrow-src': `url(&quot;${arrow}&quot;)` }" />
  </span>
</template>

<style scoped>
.arrow {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  width: 24px;
  height: 24px;
}
/* The source glyph points down (11.5 × 17.5); rotate it to point along the reading direction */
.arrow__glyph {
  width: 11.5px;
  height: 17.5px;
  background: currentColor;
  -webkit-mask: var(--arrow-src) center / contain no-repeat;
  mask: var(--arrow-src) center / contain no-repeat;
  transform: rotate(-90deg);
  transition: translate 0.2s ease;
}
[dir='rtl'] .arrow__glyph {
  transform: rotate(90deg);
}
</style>
