<script setup>
import { useI18n } from '@/i18n'

const { t } = useI18n()
</script>

<template>
  <!-- Figma "Band": navy strip, items separated by muted pipes -->
  <div class="band">
    <ul class="container band__list">
      <template v-for="(item, i) in t.band" :key="i">
        <li v-if="i > 0" class="band__divider" aria-hidden="true">|</li>
        <li class="band__item">{{ item }}</li>
      </template>
    </ul>
  </div>
</template>

<style scoped>
.band {
  background: var(--la-navy);
}
.band__list {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding-block: 20px;
  font-weight: 700;
  font-size: 14px;
  line-height: 20px;
  letter-spacing: 1.26px;
  text-transform: uppercase;
  white-space: nowrap;
}
[dir='rtl'] .band__list {
  letter-spacing: 0;
}
.band__item {
  color: var(--la-on-navy);
}
.band__divider {
  color: var(--la-on-navy-muted);
}

@media (max-width: 1024px) {
  .band__list {
    flex-wrap: wrap;
    justify-content: center;
    row-gap: 8px;
  }
}
@media (max-width: 640px) {
  .band__list {
    font-size: 12px;
    gap: 10px;
    letter-spacing: 0.8px;
  }
}
</style>
