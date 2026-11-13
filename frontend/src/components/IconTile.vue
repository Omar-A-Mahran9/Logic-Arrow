<script setup>
defineProps({
  src: { type: String, required: true },
  size: { type: Number, default: 48 },
  tone: { type: String, default: 'blue', validator: (v) => ['blue', 'navy'].includes(v) },
})
</script>

<template>
  <!-- Figma "IconTile": white Material icon (30px) centred in a 48px / 40px tile -->
  <span class="tile" :class="`tile--${tone}`" :style="{ width: `${size}px`, height: `${size}px` }" aria-hidden="true">
    <img :src="src" alt="" width="30" height="30" />
  </span>
</template>

<style scoped>
.tile {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  border-radius: var(--radius-lg);
}
.tile img {
  width: 30px;
  height: 30px;
}
.tile--blue {
  background: var(--la-blue);
}
.tile--navy {
  background: var(--la-navy-raised);
}
</style>
