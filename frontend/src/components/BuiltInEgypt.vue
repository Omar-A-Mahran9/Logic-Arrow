<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import IconTile from './IconTile.vue'
import iCode from '@/assets/icons/i-web.svg'
import workshop from '@/assets/images/team-workshop.webp'

const { t } = useI18n()
</script>

<template>
  <section id="industries" class="section bg-white">
    <div class="container egypt">
      <figure class="egypt__photo">
        <img v-reveal.image :src="workshop" :alt="t.alt.workshop" width="1536" height="864" loading="lazy" />
      </figure>

      <div class="egypt__copy">
        <SectionHeader :eyebrow="t.egypt.eyebrow" :title="t.egypt.title" :lead="t.egypt.lead" wide />

        <ul class="egypt__points">
          <li v-for="(point, i) in t.egypt.points" :key="i" v-reveal="i * 100" class="point">
            <IconTile :src="iCode" :size="40" />
            <div class="point__text">
              <h3 class="t-heading c-navy">{{ point.title }}</h3>
              <p class="t-body c-muted">{{ point.text }}</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<style scoped>
.egypt {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
/* Figma "Photo · team workshop": 1200 × 536, image is 125.93% tall, offset -4.01% */
.egypt__photo {
  position: relative;
  height: 536px;
  border-radius: var(--radius-md);
  overflow: hidden;
}
.egypt__photo img {
  position: absolute;
  inset-inline-start: 0;
  top: -4.01%;
  width: 100%;
  height: 125.93%;
  max-width: none;
  object-fit: cover;
}
.egypt__copy {
  display: flex;
  flex-direction: column;
  gap: 32px;
}
.egypt__points {
  display: flex;
  flex-direction: column;
  gap: 32px;
}
/* Figma "Point": 40px icon tile + title and description */
.point {
  display: flex;
  align-items: flex-start;
  gap: 16px;
}
.point__text {
  flex: 1 0 0;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

@media (max-width: 1024px) {
  .egypt__photo {
    height: auto;
    aspect-ratio: 16 / 9;
  }
  .egypt__photo img {
    top: 0;
    height: 100%;
  }
}
</style>
