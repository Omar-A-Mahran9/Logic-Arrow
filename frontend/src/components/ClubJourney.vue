<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import IconTile from './IconTile.vue'
import iRenew from '@/assets/icons/i-renew.svg'
import iBooked from '@/assets/icons/i-booked.svg'
import iSupport from '@/assets/icons/i-ai.svg'
import iLock from '@/assets/icons/i-lock.svg'
import family from '@/assets/images/family-club.webp'

const { t } = useI18n()
const icons = [iRenew, iBooked, iSupport, iLock]
</script>

<template>
  <section class="section bg-surface">
    <div class="container journey">
      <SectionHeader :eyebrow="t.journey.eyebrow" :title="t.journey.title" :lead="t.journey.lead" wide />

      <figure class="journey__photo">
        <img v-reveal.image :src="family" :alt="t.alt.family" width="1536" height="864" loading="lazy" />
      </figure>

      <div class="journey__content">
        <ol class="journey__steps">
          <li v-for="(step, i) in t.journey.steps" :key="i" v-reveal="i * 90" class="step">
            <IconTile :src="icons[i]" :size="40" />
            <div class="step__text">
              <p class="t-eyebrow c-blue">{{ step.time }}</p>
              <h3 class="t-heading c-navy">{{ step.title }}</h3>
              <p class="t-body c-muted">{{ step.text }}</p>
            </div>
          </li>
        </ol>

        <!-- Figma "Phone mock-up · concept": 300 × 600 graphite frame, 12px bezel -->
        <div v-reveal.scale="150" class="phone" role="img" :aria-label="t.journey.phone.label">
          <div class="phone__screen">
            <div class="phone__header">
              <p class="t-label">{{ t.journey.phone.greeting }}</p>
            </div>
            <div class="phone__cards">
              <div
                v-for="(card, i) in t.journey.phone.cards"
                :key="i"
                class="phone__card"
                :class="{ 'phone__card--ok': i === 0 }"
              >
                <p class="t-label c-navy">{{ card.title }}</p>
                <p class="t-caption c-muted">{{ card.text }}</p>
              </div>
            </div>
            <div class="phone__ask t-caption c-muted">{{ t.journey.phone.ask }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.journey {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
.journey__photo {
  height: 688px;
  border-radius: var(--radius-md);
  overflow: hidden;
}
.journey__photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.journey__content {
  display: flex;
  align-items: center;
  gap: 80px;
}
.journey__steps {
  flex: 1 0 0;
  min-width: 0;
}
/* Figma "StepRow": time eyebrow, icon tile, title, description, hairline below */
.step {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  padding-block: 16px;
  border-bottom: 1px solid var(--la-line);
}
.step__text {
  flex: 1 0 0;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.phone {
  flex: 0 0 300px;
  height: 600px;
  padding: 12px;
  border-radius: 36px;
  background: var(--la-graphite);
}
.phone__screen {
  position: relative;
  height: 100%;
  border-radius: 26px;
  overflow: hidden;
  background: var(--la-surface-raised);
}
.phone__header {
  height: 88px;
  padding: 40px 20px 0;
  background: var(--la-navy);
  color: var(--la-on-navy);
}
.phone__cards {
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 20px 16px 0;
}
.phone__card {
  height: 84px;
  padding: 18px 16px 0;
  border-radius: var(--radius-md);
  background: var(--la-panel);
}
.phone__card--ok {
  background: var(--la-success-soft);
}
.phone__card .t-label {
  margin-bottom: 4px;
}
.phone__ask {
  position: absolute;
  inset-inline: 16px;
  bottom: 28px;
  height: 48px;
  display: flex;
  align-items: center;
  padding-inline: 24px;
  border-radius: 24px;
  background: var(--la-panel);
}

@media (max-width: 1024px) {
  .journey__photo {
    height: auto;
    aspect-ratio: 16 / 9;
  }
  .journey__content {
    gap: 48px;
  }
}
@media (max-width: 860px) {
  .journey__content {
    flex-direction: column;
    align-items: stretch;
  }
  /* In a column, flex-basis would set the height — pin the size explicitly */
  .phone {
    flex: none;
    width: 300px;
    align-self: center;
  }
}
@media (max-width: 640px) {
  .journey__photo {
    aspect-ratio: 4 / 3;
  }
}
</style>
