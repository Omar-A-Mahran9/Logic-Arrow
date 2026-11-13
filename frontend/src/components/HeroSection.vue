<script setup>
import { useI18n } from '@/i18n'
import BaseButton from './BaseButton.vue'
import BrandChevrons from './BrandChevrons.vue'
import heroPhoto from '@/assets/images/hero.webp'

const { t } = useI18n()
</script>

<template>
  <section id="top" class="hero">
    <div class="hero__copy">
      <p v-reveal class="t-eyebrow c-navy-raised">{{ t.hero.eyebrow }}</p>
      <h1 v-reveal="80" class="t-display-xl c-navy">{{ t.hero.title }}</h1>
      <BrandChevrons v-reveal.line="180" />
      <p v-reveal="220" class="t-lead c-ink hero__lead">{{ t.hero.lead }}</p>
      <div v-reveal="300" class="hero__actions">
        <BaseButton href="#contact" arrow>{{ t.hero.primary }}</BaseButton>
        <BaseButton href="#how-we-work" variant="stroke">{{ t.hero.secondary }}</BaseButton>
      </div>
      <p v-reveal="360" class="t-caption c-muted">{{ t.hero.meta }}</p>
    </div>

    <figure class="hero__photo">
      <img v-reveal.image :src="heroPhoto" :alt="t.alt.hero" width="1024" height="1024" fetchpriority="high" />
      <span class="hero__shade" aria-hidden="true" />
      <figcaption class="hero__caption">
        <BrandChevrons tone="navy" />
        <span class="t-eyebrow">{{ t.hero.photoCaption }}</span>
      </figcaption>
    </figure>
  </section>
</template>

<style scoped>
/* Figma "Hero": copy column on surface + 640px photo column, 640px tall */
.hero {
  /* On screens wider than 1440 the copy keeps the page gutter; the photo bleeds to the edge */
  --hero-start: max(var(--gutter), calc((100vw - var(--page-max)) / 2 + var(--gutter)));
  display: flex;
  align-items: stretch;
  min-height: 640px;
  background: var(--la-surface);
}
.hero__copy {
  flex: 1 0 0;
  min-width: 0;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 16px;
  padding: 96px 64px 64px var(--hero-start);
}
[dir='rtl'] .hero__copy {
  padding: 96px var(--hero-start) 64px 64px;
}
.hero__copy h1 {
  max-width: 616px;
}
.hero__lead {
  max-width: 616px;
}
.hero__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.hero__photo {
  position: relative;
  flex: 0 0 640px;
  overflow: hidden;
  background: var(--la-navy);
}
.hero__photo img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
/* Figma "Gradient overlay": bottom 288px fades into navy */
.hero__shade {
  position: absolute;
  inset-inline: 0;
  bottom: 0;
  height: 288px;
  background: linear-gradient(to bottom, rgba(10, 58, 114, 0) 0%, rgba(10, 58, 114, 0.92) 100%);
  pointer-events: none;
}
.hero__caption {
  position: absolute;
  inset-inline-start: 64px;
  bottom: 59px;
  display: flex;
  align-items: center;
  gap: 30px;
  color: var(--la-on-navy-muted);
}
.hero__caption .t-eyebrow {
  letter-spacing: 1.26px;
}

@media (max-width: 1280px) {
  .hero__photo {
    flex-basis: 46%;
  }
}

@media (max-width: 900px) {
  .hero {
    flex-direction: column;
    min-height: 0;
  }
  .hero__copy,
  [dir='rtl'] .hero__copy {
    padding: 56px var(--gutter) 48px;
  }
  .hero__photo {
    flex-basis: auto;
    aspect-ratio: 4 / 3;
  }
  .hero__caption {
    inset-inline-start: var(--gutter);
    bottom: 28px;
    gap: 16px;
  }
}

@media (max-width: 640px) {
  .hero__photo {
    aspect-ratio: 1 / 1;
  }
  .hero__caption .t-eyebrow {
    font-size: 12px;
  }
}
</style>
