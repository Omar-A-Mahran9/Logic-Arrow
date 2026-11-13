<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import a1 from '@/assets/images/avatar-1.webp'
import a2 from '@/assets/images/avatar-2.webp'
import a3 from '@/assets/images/avatar-3.webp'

const { t } = useI18n()
const avatars = [a1, a2, a3]
</script>

<template>
  <section class="section bg-surface">
    <div class="container voices">
      <SectionHeader :eyebrow="t.voices.eyebrow" :title="t.voices.title" :lead="t.voices.lead" />

      <div class="voices__grid">
        <!-- Figma "QuoteCard": white, 3px blue rule, teal quote mark -->
        <figure v-for="(q, i) in t.voices.quotes" :key="i" v-reveal="i * 110" class="quote">
          <span class="quote__mark t-display-xl" aria-hidden="true">“</span>
          <blockquote class="t-body-lg c-ink">{{ q.text }}</blockquote>
          <figcaption class="quote__who">
            <img :src="avatars[i]" alt="" width="44" height="44" loading="lazy" />
            <span class="quote__meta">
              <span class="t-label c-navy">{{ q.who }}</span>
              <span class="t-caption c-muted">{{ q.where }}</span>
            </span>
          </figcaption>
        </figure>
      </div>
    </div>
  </section>
</template>

<style scoped>
.voices {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
.voices__grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 24px;
}
.quote {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 20px;
  padding: 28px;
  border-radius: var(--radius-md);
  border-inline-start: 3px solid var(--la-blue);
  background: var(--la-surface-raised);
}
.quote:hover {
  box-shadow: var(--shadow-card);
}
.quote__mark {
  color: var(--la-teal);
  font-family: var(--font-display);
}
[dir='rtl'] .quote__mark {
  transform: scaleX(-1);
}
.quote blockquote {
  flex: 1 0 auto;
  margin: 0;
}
.quote__who {
  display: flex;
  align-items: center;
  gap: 12px;
}
.quote__who img {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  object-fit: cover;
}
.quote__meta {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

@media (max-width: 1024px) {
  .voices__grid {
    grid-template-columns: 1fr;
    max-width: 640px;
  }
}
</style>
