<script setup>
import ArrowIcon from './ArrowIcon.vue'

defineProps({
  variant: {
    type: String,
    default: 'primary',
    validator: (v) => ['primary', 'stroke', 'flat', 'flat-muted'].includes(v),
  },
  size: {
    type: String,
    default: 'md',
    validator: (v) => ['md', 'sm'].includes(v),
  },
  href: { type: String, default: '#' },
  arrow: { type: Boolean, default: false },
})
</script>

<template>
  <a :href="href" class="btn" :class="[`btn--${variant}`, `btn--${size}`]">
    <span class="btn__label"><slot /></span>
    <ArrowIcon v-if="arrow" class="btn__arrow" />
  </a>
</template>

<style scoped>
/* Figma component "Button English" — Size 1 = 40px, Size 2 = 32px */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  flex-shrink: 0;
  padding: 8px 16px;
  border-radius: 4px;
  font-weight: 700;
  font-size: 16px;
  line-height: 24px;
  white-space: nowrap;
  transition:
    background-color 0.2s ease,
    color 0.2s ease,
    box-shadow 0.2s ease;
}
.btn--sm {
  padding-block: 4px;
}

.btn--primary {
  background: var(--la-blue);
  color: var(--la-on-blue);
}
.btn--primary:hover {
  background: var(--la-navy);
}

/* Figma uses an inside stroke, so the 1px border is taken out of the padding */
.btn--stroke {
  border: 1px solid var(--la-blue);
  padding-block: 7px;
  color: var(--la-blue);
}
.btn--stroke.btn--sm {
  padding-block: 3px;
}
.btn--stroke:hover {
  background: var(--la-panel);
}

.btn--flat {
  color: var(--la-blue);
}
.btn--flat-muted {
  font-weight: 400;
  color: var(--la-ink-muted);
}
.btn--flat:hover,
.btn--flat-muted:hover {
  background: var(--la-panel);
  color: var(--la-blue);
}

.btn:hover :deep(.arrow__glyph) {
  translate: 3px 0;
}
[dir='rtl'] .btn:hover :deep(.arrow__glyph) {
  translate: -3px 0;
}
</style>
