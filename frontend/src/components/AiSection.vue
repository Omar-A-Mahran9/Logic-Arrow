<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import bullet from '@/assets/icons/bullet.svg'
import check from '@/assets/icons/check-circle.svg'

const { t } = useI18n()
</script>

<template>
  <section class="section bg-white">
    <div class="container ai">
      <SectionHeader :eyebrow="t.ai.eyebrow" :title="t.ai.title" :lead="t.ai.lead" />

      <div class="ai__compare">
        <div v-reveal class="col col--typical">
          <h3 class="t-heading-lg col__title">{{ t.ai.typical.title }}</h3>
          <ul class="col__list">
            <li v-for="(item, i) in t.ai.typical.items" :key="i" class="col__item">
              <img :src="bullet" alt="" width="8" height="20" class="col__bullet" />
              <span class="t-body-lg c-ink">{{ item }}</span>
            </li>
          </ul>
        </div>

        <div v-reveal="120" class="col col--ours">
          <div class="col__head">
            <h3 class="t-heading-lg c-navy col__title ltr-text">{{ t.ai.ours.title }}</h3>
            <span class="badge t-caption">{{ t.ai.ours.badge }}</span>
          </div>
          <ul class="col__list">
            <li v-for="(item, i) in t.ai.ours.items" :key="i" class="col__item">
              <img :src="check" alt="" width="20" height="20" class="col__check" />
              <span class="t-body-lg c-ink">{{ item }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.ai {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
.ai__compare {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 24px;
  align-items: start;
}
.col {
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 20px 24px 24px;
  background: var(--la-surface);
}
.col--typical {
  border-top: 1.5px solid var(--la-slate);
}
.col--typical .col__title {
  color: var(--la-slate);
}
.col--ours {
  border-top: 3px solid var(--la-blue);
}
.col__head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
/* Figma "Badge": panel fill, 6px radius */
.badge {
  flex-shrink: 0;
  padding: 4px 10px;
  border-radius: var(--radius-sm);
  background: var(--la-panel);
  color: var(--la-ink);
}
.col__list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.col__item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
}
.col__bullet {
  flex-shrink: 0;
  width: 8px;
  height: 20px;
  margin-top: 2px;
}
.col__check {
  flex-shrink: 0;
  width: 20px;
  height: 20px;
  margin-top: 2px;
}
[dir='rtl'] .col__bullet,
[dir='rtl'] .col__check {
  margin-top: 5px;
}

@media (max-width: 900px) {
  .ai__compare {
    grid-template-columns: 1fr;
  }
}
@media (max-width: 480px) {
  .col__head {
    flex-wrap: wrap;
  }
}
</style>
