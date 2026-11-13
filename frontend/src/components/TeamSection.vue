<script setup>
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import omar from '@/assets/images/omar-mahran.webp'
import lojaine from '@/assets/images/lojaine-ahmed.webp'
import maha from '@/assets/images/maha-omran.webp'
import ibrahim from '@/assets/images/ibrahim-ahmed.webp'

const { t } = useI18n()
const photos = [lojaine, maha, ibrahim]
</script>

<template>
  <section id="about" class="section bg-white">
    <div class="container team">
      <SectionHeader :eyebrow="t.team.eyebrow" :title="t.team.title" :lead="t.team.lead" />

      <div class="team__grid">
        <!-- Figma "PersonCard / Featured=Yes": navy card, 5px teal rule, 96px photo -->
        <article v-reveal class="person person--featured">
          <img :src="omar" :alt="t.team.lead_member.name" width="96" height="96" loading="lazy" class="person__photo" />
          <div class="person__text">
            <h3 class="t-heading-lg c-on-navy">{{ t.team.lead_member.name }}</h3>
            <p class="t-label c-aqua">{{ t.team.lead_member.role }}</p>
            <p class="t-body c-on-navy-muted">{{ t.team.lead_member.text }}</p>
          </div>
        </article>

        <div class="team__list">
          <!-- Figma "PersonCard / Featured=No": white card, 5px blue rule, 64px photo -->
          <article v-for="(m, i) in t.team.members" :key="i" v-reveal="(i + 1) * 100" class="person">
            <img :src="photos[i]" :alt="m.name" width="64" height="64" loading="lazy" class="person__photo" />
            <div class="person__text">
              <h3 class="t-heading-lg c-navy">{{ m.name }}</h3>
              <p class="t-label c-blue">{{ m.role }}</p>
              <p class="t-body c-muted">{{ m.text }}</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.team {
  display: flex;
  flex-direction: column;
  gap: 48px;
}
.team__grid {
  display: flex;
  align-items: flex-start;
  gap: 48px;
}
.team__list {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 560px;
  max-width: 100%;
}
.person {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  padding: 16px 20px;
  border-radius: 3px;
  border-inline-start: 5px solid var(--la-blue);
  background: var(--la-surface-raised);
}
.person--featured {
  flex: 0 0 420px;
  flex-direction: column;
  padding: 28px;
  border-inline-start-color: var(--la-teal);
  background: var(--la-navy);
}
.person__photo {
  flex-shrink: 0;
  width: 64px;
  height: 64px;
  border-radius: 3px;
  object-fit: cover;
}
.person--featured .person__photo {
  width: 96px;
  height: 96px;
}
.person__text {
  flex: 1 0 0;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

@media (max-width: 1100px) {
  .team__grid {
    flex-direction: column;
    gap: 16px;
  }
  .person--featured {
    flex-basis: auto;
    width: 100%;
    max-width: 560px;
  }
}
</style>
