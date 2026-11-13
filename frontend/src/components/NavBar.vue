<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'
import { useI18n } from '@/i18n'
import BaseButton from './BaseButton.vue'
import logo from '@/assets/images/logo.png'

const { t } = useI18n()
const open = ref(false)
const anchors = ['#solutions', '#how-we-work', '#industries', '#about']
const active = ref('#solutions')

// Highlight the link of the section currently in view (Figma: active link is bold blue).
let io
onMounted(() => {
  if (typeof IntersectionObserver === 'undefined') return
  io = new IntersectionObserver(
    (entries) => {
      for (const e of entries) if (e.isIntersecting) active.value = `#${e.target.id}`
    },
    { rootMargin: '-45% 0px -50% 0px' },
  )
  for (const a of anchors) {
    const el = document.querySelector(a)
    if (el) io.observe(el)
  }
})
onBeforeUnmount(() => {
  io?.disconnect()
})
</script>

<template>
  <header class="nav">
    <div class="container nav__inner">
      <a href="#top" class="nav__logo">
        <img :src="logo" :alt="t.alt.logo" width="200" height="51" />
      </a>

      <div class="nav__right">
        <nav class="nav__links" :class="{ 'is-open': open }">
          <BaseButton
            v-for="(label, i) in t.nav.links"
            :key="anchors[i]"
            :href="anchors[i]"
            :variant="active === anchors[i] ? 'flat' : 'flat-muted'"
            size="sm"
            :aria-current="active === anchors[i] ? 'true' : undefined"
            @click="open = false"
          >
            {{ label }}
          </BaseButton>
        </nav>

        <div class="nav__actions">
          <BaseButton href="#contact" variant="primary" arrow class="nav__cta">{{ t.nav.cta }}</BaseButton>
          <button
            type="button"
            class="nav__burger"
            :aria-expanded="open"
            :aria-label="t.nav.menu"
            @click="open = !open"
          >
            <span /><span /><span />
          </button>
        </div>
      </div>
    </div>
  </header>
</template>

<style scoped>
/* Figma "NavBar": 92px, white, hairline bottom border + card shadow */
.nav {
  position: sticky;
  top: 0;
  z-index: 50;
  background: var(--la-surface-raised);
  border-bottom: 1px solid var(--la-line);
  box-shadow: var(--shadow-card);
  animation: nav-in 0.8s var(--ease-out) backwards;
}
@keyframes nav-in {
  from {
    transform: translateY(-100%);
  }
}
.nav__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  padding-block: 20px;
}
.nav__logo img {
  width: 200px;
  height: 51px;
  object-fit: contain;
}
.nav__right {
  display: flex;
  align-items: center;
  gap: 40px;
}
.nav__links {
  display: flex;
  align-items: center;
  gap: 16px;
}
.nav__actions {
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Links: blue underline grows from the reading-start edge */
.nav__links :deep(.btn) {
  position: relative;
}
.nav__links :deep(.btn)::after {
  content: '';
  position: absolute;
  bottom: -2px;
  inset-inline: 16px;
  height: 2px;
  border-radius: 1px;
  background: var(--la-blue);
  transform: scaleX(0);
  transform-origin: left center;
  transition: transform 0.35s var(--ease-out);
}
[dir='rtl'] .nav__links :deep(.btn)::after {
  transform-origin: right center;
}
.nav__links :deep(.btn:hover)::after,
.nav__links :deep(.btn[aria-current])::after {
  transform: scaleX(1);
}
.nav__links :deep(.btn:hover) {
  background: transparent;
}

.nav__burger {
  display: none;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 5px;
}
.nav__burger span {
  display: block;
  width: 20px;
  height: 2px;
  border-radius: 1px;
  background: var(--la-navy);
  transition:
    transform 0.35s var(--ease-out),
    opacity 0.2s ease;
}
.nav__burger[aria-expanded='true'] span:nth-child(1) {
  transform: translateY(7px) rotate(45deg);
}
.nav__burger[aria-expanded='true'] span:nth-child(2) {
  opacity: 0;
}
.nav__burger[aria-expanded='true'] span:nth-child(3) {
  transform: translateY(-7px) rotate(-45deg);
}

@media (max-width: 1180px) {
  .nav__right {
    gap: 16px;
  }
  .nav__links {
    gap: 0;
  }
}

@media (max-width: 1024px) {
  .nav__inner {
    position: relative;
  }
  .nav__burger {
    display: inline-flex;
  }
  .nav__links {
    display: none;
    position: absolute;
    top: 100%;
    inset-inline: 0;
    flex-direction: column;
    align-items: stretch;
    gap: 4px;
    padding: 12px var(--gutter) 20px;
    background: var(--la-surface-raised);
    border-top: 1px solid var(--la-line);
    box-shadow: var(--shadow-card);
  }
  .nav__links.is-open {
    display: flex;
  }
  .nav__links :deep(.btn) {
    padding-block: 10px;
  }
  .nav__links :deep(.btn)::after {
    display: none;
  }
}

@media (max-width: 640px) {
  .nav__inner {
    padding-block: 14px;
    gap: 8px;
  }
  .nav__logo img {
    width: 140px;
    height: 36px;
  }
  .nav__cta {
    display: none;
  }
}
</style>
