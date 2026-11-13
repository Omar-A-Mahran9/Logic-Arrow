<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import IconTile from './IconTile.vue'
import iSearch from '@/assets/icons/i-search.svg'
import iDoc from '@/assets/icons/i-doc.svg'
import iTerminal from '@/assets/icons/i-terminal.svg'
import iTrend from '@/assets/icons/i-trend.svg'
import arrowForward from '@/assets/icons/arrow-forward.svg'

const { t } = useI18n()
const icons = [iSearch, iDoc, iTerminal, iTrend]
</script>

<template>
  <section id="how-we-work" class="section bg-surface">
    <div class="container work">
      <SectionHeader :eyebrow="t.work.eyebrow" :title="t.work.title" />

      <ol class="work__phases">
        <template v-for="(phase, i) in t.work.phases" :key="i">
          <li v-if="i > 0" class="work__arrow" aria-hidden="true">
            <img :src="arrowForward" alt="" width="22" height="22" />
          </li>
          <li v-reveal="i * 110" class="phase">
            <IconTile :src="icons[i]" />
            <h3 class="t-heading c-navy">{{ phase.title }}</h3>
            <p class="t-body c-muted">{{ phase.text }}</p>
          </li>
        </template>
      </ol>

      <p v-reveal class="callout t-body-lg c-ink">{{ t.work.callout }}</p>
    </div>
  </section>
</template>

<style scoped>
.work {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
.work__phases {
  display: flex;
  align-items: center;
  gap: 12px;
}
/* Figma "Phase": panel card, 218px tall, lifts with the card shadow on hover (Variant2) */
.phase {
  flex: 1 0 0;
  min-width: 0;
  align-self: stretch;
  min-height: 218px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 12px;
  padding: 24px;
  background: var(--la-panel);
}
.phase:hover {
  box-shadow: var(--shadow-card);
  translate: 0 -4px;
}
.work__arrow {
  flex-shrink: 0;
}
.work__arrow img {
  width: 22px;
  height: 22px;
}
[dir='rtl'] .work__arrow img {
  transform: scaleX(-1);
}
/* Figma "Callout": panel fill, 3px blue rule on the reading-start edge */
.callout {
  padding: 20px 24px;
  background: var(--la-panel);
  border-inline-start: 3px solid var(--la-blue);
}

@media (max-width: 1024px) {
  .work__phases {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
  }
  .work__arrow {
    display: none;
  }
}
@media (max-width: 560px) {
  .work__phases {
    grid-template-columns: 1fr;
  }
  .phase {
    min-height: 0;
  }
}
</style>
