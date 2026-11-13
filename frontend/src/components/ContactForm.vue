<script setup>
import { reactive, ref } from 'vue'
import { useI18n } from '@/i18n'
import SectionHeader from './SectionHeader.vue'
import ArrowIcon from './ArrowIcon.vue'

const { t, locale } = useI18n()

const API_URL = `${(import.meta.env.VITE_API_URL || '').replace(/\/$/, '')}/api/inquiries`

// Keys must match Inquiry::SERVICES in the backend; labels come from the solutions copy.
const services = ['apps', 'websites', 'ai', 'dashboards', 'automation', 'integration']

const empty = () => ({ name: '', company: '', phone: '', email: '', service: '', message: '', website: '' })
const form = reactive(empty())
const errors = reactive({})
const status = ref('idle') // idle | sending | sent | error | throttled

function clearErrors() {
  for (const key of Object.keys(errors)) delete errors[key]
}

async function submit() {
  if (status.value === 'sending') return
  clearErrors()
  status.value = 'sending'

  try {
    const res = await fetch(API_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({ ...form, locale: locale.value }),
    })

    if (res.ok) {
      Object.assign(form, empty())
      status.value = 'sent'
      return
    }
    if (res.status === 422) {
      const body = await res.json()
      for (const field of Object.keys(body.errors || {})) errors[field] = true
      status.value = 'idle'
      return
    }
    status.value = res.status === 429 ? 'throttled' : 'error'
  } catch {
    status.value = 'error'
  }
}
</script>

<template>
  <section id="contact" class="section bg-surface">
    <div class="container contact">
      <div class="contact__intro">
        <SectionHeader :eyebrow="t.form.eyebrow" :title="t.form.title" :lead="t.form.lead" />
        <p v-reveal="240" class="t-body c-muted contact__direct">
          <a :href="`mailto:${t.footer.contact.email}`" class="c-blue ltr-text">{{ t.footer.contact.email }}</a>
          · {{ t.footer.contact.city }}
        </p>
      </div>

      <form v-reveal.scale="120" class="card" novalidate @submit.prevent="submit">
        <p v-if="status === 'sent'" class="notice notice--ok" role="status">{{ t.form.success }}</p>

        <div class="card__row">
          <label class="field">
            <span class="field__label">{{ t.form.name }}</span>
            <input
              v-model.trim="form.name"
              type="text"
              name="name"
              autocomplete="name"
              maxlength="120"
              required
              :aria-invalid="!!errors.name"
            />
            <span v-if="errors.name" class="field__error">{{ t.form.errors.name }}</span>
          </label>

          <label class="field">
            <span class="field__label">
              {{ t.form.company }} <span class="field__opt">({{ t.form.optional }})</span>
            </span>
            <input
              v-model.trim="form.company"
              type="text"
              name="company"
              autocomplete="organization"
              maxlength="150"
              :aria-invalid="!!errors.company"
            />
            <span v-if="errors.company" class="field__error">{{ t.form.errors.company }}</span>
          </label>
        </div>

        <div class="card__row">
          <label class="field">
            <span class="field__label">{{ t.form.phone }}</span>
            <input
              v-model.trim="form.phone"
              type="tel"
              name="phone"
              dir="ltr"
              autocomplete="tel"
              inputmode="tel"
              maxlength="30"
              required
              :aria-invalid="!!errors.phone"
            />
            <span v-if="errors.phone" class="field__error">{{ t.form.errors.phone }}</span>
          </label>

          <label class="field">
            <span class="field__label">{{ t.form.email }}</span>
            <input
              v-model.trim="form.email"
              type="email"
              name="email"
              dir="ltr"
              autocomplete="email"
              maxlength="190"
              required
              :aria-invalid="!!errors.email"
            />
            <span v-if="errors.email" class="field__error">{{ t.form.errors.email }}</span>
          </label>
        </div>

        <label class="field">
          <span class="field__label">{{ t.form.service }}</span>
          <select v-model="form.service" name="service" :aria-invalid="!!errors.service">
            <option value="">{{ t.form.servicePlaceholder }}</option>
            <option v-for="(key, i) in services" :key="key" :value="key">{{ t.solutions.items[i].title }}</option>
          </select>
          <span v-if="errors.service" class="field__error">{{ t.form.errors.service }}</span>
        </label>

        <label class="field">
          <span class="field__label">{{ t.form.message }}</span>
          <textarea
            v-model.trim="form.message"
            name="message"
            rows="5"
            maxlength="3000"
            required
            :aria-invalid="!!errors.message"
          ></textarea>
          <span v-if="errors.message" class="field__error">{{ t.form.errors.message }}</span>
        </label>

        <!-- Honeypot for bots; hidden from people and assistive tech -->
        <input
          v-model="form.website"
          class="card__hp"
          type="text"
          name="website"
          tabindex="-1"
          autocomplete="off"
          aria-hidden="true"
        />

        <p v-if="status === 'error' || status === 'throttled'" class="notice notice--err" role="alert">
          {{ status === 'throttled' ? t.form.throttled : t.form.failed }}
        </p>

        <button class="card__submit" type="submit" :disabled="status === 'sending'">
          {{ status === 'sending' ? t.form.sending : t.form.submit }}
          <ArrowIcon v-if="status !== 'sending'" />
        </button>
      </form>
    </div>
  </section>
</template>

<style scoped>
.contact {
  display: grid;
  grid-template-columns: minmax(0, 5fr) minmax(0, 7fr);
  gap: 64px;
  align-items: start;
}
.contact__intro {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.contact__direct a:hover {
  text-decoration: underline;
}
.card {
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 32px;
  border-radius: var(--radius-md);
  border-top: 3px solid var(--la-blue);
  background: var(--la-surface-raised);
  box-shadow: var(--shadow-card);
}
.card__row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.field__label {
  font-weight: 700;
  font-size: 15px;
  line-height: 22px;
  color: var(--la-navy);
}
.field__opt {
  font-weight: 400;
  color: var(--la-ink-muted);
}
.field input,
.field select,
.field textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid var(--la-line);
  border-radius: 4px;
  background: var(--la-surface-raised);
  color: var(--la-ink);
  font: inherit;
  transition:
    border-color 0.2s ease,
    box-shadow 0.2s ease;
}
[dir='rtl'] .field input[dir='ltr'] {
  text-align: right;
}
.field textarea {
  resize: vertical;
  min-height: 132px;
}
.field input:focus,
.field select:focus,
.field textarea:focus {
  outline: none;
  border-color: var(--la-blue);
  box-shadow: 0 0 0 3px rgba(30, 111, 217, 0.15);
}
.field [aria-invalid='true'] {
  border-color: var(--la-danger);
}
.field__error {
  font-size: 13px;
  color: var(--la-danger);
}
/* Visually hidden without pushing anything off-canvas (a far negative `left` widens RTL pages) */
.card__hp {
  position: absolute;
  width: 1px;
  height: 1px;
  overflow: hidden;
  clip-path: inset(50%);
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
}
.notice {
  padding: 12px 16px;
  border-radius: 4px;
  font-size: 15px;
}
.notice--ok {
  background: var(--la-success-soft);
  color: var(--la-navy);
}
.notice--err {
  background: var(--la-danger-soft);
  color: var(--la-danger);
}
.card__submit {
  align-self: flex-start;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 8px 16px;
  border-radius: 4px;
  background: var(--la-blue);
  color: var(--la-on-blue);
  font-weight: 700;
  line-height: 24px;
  transition: background-color 0.2s ease;
}
.card__submit:hover:not(:disabled) {
  background: var(--la-navy);
}
.card__submit:disabled {
  opacity: 0.6;
  cursor: progress;
}

@media (max-width: 1024px) {
  .contact {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}
@media (max-width: 640px) {
  .card {
    padding: 24px 20px;
  }
  .card__row {
    grid-template-columns: 1fr;
  }
  .card__submit {
    align-self: stretch;
    justify-content: center;
  }
}
</style>
