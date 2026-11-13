<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import IconTile from './IconTile.vue'
import iApps from '@/assets/icons/i-apps.svg'
import iWeb from '@/assets/icons/i-web.svg'
import iAi from '@/assets/icons/i-ai.svg'
import iDash from '@/assets/icons/i-dash.svg'
import iFlow from '@/assets/icons/i-flow.svg'
import iHub from '@/assets/icons/i-hub.svg'

const { t } = useI18n()
const icons = [iApps, iWeb, iAi, iDash, iFlow, iHub]
</script>

<template>
  <section id="solutions" class="section bg-surface">
    <div class="container solutions">
      <SectionHeader
        :eyebrow="t.solutions.eyebrow"
        :title="t.solutions.title"
        :lead="t.solutions.lead"
        eyebrow-class="c-navy-raised"
      />

      <ul class="solutions__grid">
        <li v-for="(item, i) in t.solutions.items" :key="i" v-reveal="(i % 3) * 100" class="feature">
          <IconTile :src="icons[i]" />
          <h3 class="t-heading c-navy">{{ item.title }}</h3>
          <p class="t-body c-muted">{{ item.text }}</p>
        </li>
      </ul>
    </div>
  </section>
</template>

<style scoped>
.solutions {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
/* Figma "Feature grid": 3 columns, 24px gutters, 40px between rows */
.solutions__grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 40px 24px;
}
/* Figma "FeatureItem": hairline rule, icon tile, title, one-line description */
.feature {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 12px;
  padding-top: 16px;
  border-top: 1.5px solid var(--la-line);
  transition: border-color 0.3s ease;
}
.feature:hover {
  border-top-color: var(--la-blue);
}

@media (max-width: 1024px) {
  .solutions__grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}
@media (max-width: 640px) {
  .solutions__grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}
</style>
