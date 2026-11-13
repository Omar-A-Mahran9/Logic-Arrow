<script setup>
import { useI18n } from '@/i18n'
import BaseButton from './BaseButton.vue'
import BrandChevrons from './BrandChevrons.vue'
import IconTile from './IconTile.vue'
import iTask from '@/assets/icons/i-renew.svg'
import iOwner from '@/assets/icons/i-flow.svg'
import iBook from '@/assets/icons/i-doc.svg'

const { t } = useI18n()
const icons = [iTask, iOwner, iBook]
</script>

<template>
  <section class="section bg-navy">
    <div class="container next">
      <div class="next__copy">
        <p v-reveal class="t-eyebrow c-sky">{{ t.next.eyebrow }}</p>
        <h2 v-reveal="80" class="t-display c-on-navy">{{ t.next.title }}</h2>
        <BrandChevrons v-reveal.line="160" tone="navy" />
        <p v-reveal="200" class="t-lead c-on-navy-muted">{{ t.next.lead }}</p>
        <BaseButton v-reveal="260" href="#contact" arrow>{{ t.next.cta }}</BaseButton>
      </div>

      <div class="next__steps">
        <ol>
          <li v-for="(step, i) in t.next.steps" :key="i" v-reveal="i * 100" class="next__step">
            <IconTile :src="icons[i]" :size="40" tone="navy" />
            <span class="t-body-lg c-on-navy">{{ step }}</span>
          </li>
        </ol>
        <p v-reveal="320" class="t-heading c-on-navy next__signoff">{{ t.next.signoff }}</p>
      </div>
    </div>
  </section>
</template>

<style scoped>
.next {
  display: flex;
  align-items: flex-start;
  gap: 80px;
}
.next__copy,
.next__steps {
  flex: 1 0 0;
  min-width: 0;
}
.next__copy {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 16px;
}
/* Figma "Step": navy-raised icon tile, 1.5px navy-raised rule below */
.next__step {
  display: flex;
  align-items: center;
  gap: 16px;
  padding-block: 20px;
  border-bottom: 1.5px solid var(--la-navy-raised);
}
.next__signoff {
  padding-top: 24px;
}

@media (max-width: 900px) {
  .next {
    flex-direction: column;
    gap: 40px;
  }
  .next__copy,
  .next__steps {
    flex: none;
    width: 100%;
  }
}
</style>
