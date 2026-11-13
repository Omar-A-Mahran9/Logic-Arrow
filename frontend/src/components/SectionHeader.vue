<script setup>
import BrandChevrons from './BrandChevrons.vue'

defineProps({
  eyebrow: { type: String, required: true },
  title: { type: String, required: true },
  lead: { type: String, default: '' },
  wide: { type: Boolean, default: false },
  eyebrowClass: { type: String, default: 'c-blue' },
})
</script>

<template>
  <!-- Figma "SectionHeader": UPPERCASE eyebrow, claim title, chevrons, optional lead -->
  <header class="sh" :class="{ 'sh--wide': wide }">
    <p v-reveal class="t-eyebrow" :class="eyebrowClass">{{ eyebrow }}</p>
    <h2 v-reveal="80" class="t-display c-navy">{{ title }}</h2>
    <BrandChevrons v-reveal.line="160" />
    <p v-if="lead" v-reveal="200" class="t-lead c-ink">{{ lead }}</p>
  </header>
</template>

<style scoped>
.sh {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 8px;
  max-width: 760px;
}
.sh--wide {
  max-width: none;
}
</style>
