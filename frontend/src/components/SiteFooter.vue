<script setup>
import { useI18n } from '@/i18n'
import logo from '@/assets/images/logo.png'

const { t } = useI18n()
const solutionLinks = ['#solutions', '#solutions', '#solutions', '#solutions']
const companyLinks = ['#how-we-work', '#industries', '#about', '#contact']
</script>

<template>
  <footer class="footer">
    <div class="container">
      <div class="footer__top">
        <div class="footer__brand">
          <img :src="logo" :alt="t.alt.logo" width="172" height="44" loading="lazy" />
          <p class="t-body c-muted">{{ t.footer.about }}</p>
        </div>

        <nav class="footer__col">
          <p class="t-label c-navy">{{ t.footer.solutions.title }}</p>
          <a v-for="(l, i) in t.footer.solutions.links" :key="l" :href="solutionLinks[i]" class="footer__link t-body">
            {{ l }}
          </a>
        </nav>

        <nav class="footer__col">
          <p class="t-label c-navy">{{ t.footer.company.title }}</p>
          <a v-for="(l, i) in t.footer.company.links" :key="l" :href="companyLinks[i]" class="footer__link t-body">
            {{ l }}
          </a>
        </nav>

        <div class="footer__col">
          <p class="t-label c-navy">{{ t.footer.contact.title }}</p>
          <a :href="`mailto:${t.footer.contact.email}`" class="footer__link t-body ltr-text">
            {{ t.footer.contact.email }}
          </a>
          <p class="t-body c-muted">{{ t.footer.contact.city }}</p>
          <a href="#contact" class="footer__cta t-label">{{ t.footer.contact.cta }}</a>
        </div>
      </div>

      <div class="footer__bottom">
        <p class="t-caption c-muted">{{ t.footer.rights }}</p>
        <div class="footer__legal">
          <a href="#" class="t-body c-blue">{{ t.footer.privacy }}</a>
          <a href="#" class="t-body c-blue">{{ t.footer.terms }}</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped>
/* Figma "Footer": white, hairline top border, 4 columns, bottom bar */
.footer {
  background: var(--la-surface-raised);
  border-top: 1px solid var(--la-line);
}
.footer .container {
  display: flex;
  flex-direction: column;
  gap: 40px;
  padding-block: 64px 40px;
}
.footer__top {
  display: flex;
  align-items: flex-start;
  gap: 64px;
}
.footer__brand {
  flex: 0 0 320px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.footer__brand img {
  width: 172px;
  height: 44px;
  object-fit: contain;
  object-position: left center;
}
[dir='rtl'] .footer__brand img {
  object-position: right center;
}
.footer__col {
  flex: 1 0 0;
  min-width: 0;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 12px;
}
.footer__link {
  padding-block: 1px;
  color: var(--la-ink-muted);
  transition: color 0.2s ease;
}
.footer__link:hover {
  color: var(--la-blue);
}
.footer__cta {
  padding: 4px 16px;
  border-radius: 4px;
  background: var(--la-blue);
  color: var(--la-surface-raised);
  transition: background-color 0.2s ease;
}
.footer__cta:hover {
  background: var(--la-navy);
}
.footer__bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding-top: 24px;
  border-top: 1px solid var(--la-line);
}
.footer__legal {
  display: flex;
  align-items: center;
  gap: 16px;
}
.footer__legal a:hover {
  text-decoration: underline;
}

@media (max-width: 1024px) {
  .footer__top {
    flex-wrap: wrap;
    gap: 40px 32px;
  }
  .footer__brand {
    flex-basis: 100%;
  }
  .footer__brand p {
    max-width: 360px;
  }
}
@media (max-width: 560px) {
  .footer__col {
    flex-basis: calc(50% - 16px);
  }
  .footer__bottom {
    flex-direction: column-reverse;
    align-items: flex-start;
  }
}
</style>
