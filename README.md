# Logic Arrow — Smart Solutions website

```
logic-arrow-website/
├── frontend/   Vue 3 + Vite landing page (EN LTR + AR RTL) with the discovery-call form
└── backend/    Laravel API + admin dashboard for discovery-call requests
```

Design source: Figma "Logic-Arrow" → page "04 · Landing page — Desktop".

## Backend (Laravel)

```bash
cd backend
composer install
cp .env.example .env          # then set ADMIN_EMAIL / ADMIN_PASSWORD / FRONTEND_URL
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed           # creates/updates the admin user from .env
php artisan serve --port=8078 # http://localhost:8078
php artisan test              # API + dashboard feature tests
```

- Dashboard: `http://localhost:8078/login` → sign in with `ADMIN_EMAIL` / `ADMIN_PASSWORD`.
  Lists requests with search (name / organisation / email / phone / message), "unread" and service filters,
  and counts (total / unread / today). Opening one marks it read; requests can be deleted.
- To change the admin password: edit `ADMIN_PASSWORD` in `.env` and run `php artisan db:seed` again.
- API: `POST /api/inquiries` with JSON `{ name, company?, phone, email, service?, message, locale }` → `201`.
  `service` is one of `apps, websites, ai, dashboards, automation, integration` (see `Inquiry::SERVICES`).
  Validation errors return `422`; rate-limited to 10 requests/minute per IP; a hidden `website` honeypot blocks bots.
- CORS: only origins listed in `FRONTEND_URL` (comma-separated) can call the API.

## Frontend (Vue)

```bash
cd frontend
npm install
npm run dev      # http://localhost:5173 — /api is proxied to http://localhost:8078
npm run build    # production build in dist/
```

- If the backend runs on another port: `API_PROXY=http://localhost:8000 npm run dev`.
- Production: set `VITE_API_URL=https://api.your-domain.com` (see `frontend/.env.example`) before `npm run build`,
  and add the site's origin to the backend's `FRONTEND_URL`.
- Open `?lang=ar` or `?lang=en` to force a language; the switch in the navbar/footer remembers the choice.

### Structure

- `src/styles/main.css` — design tokens from the Figma variables (`Interface/*`, `Mark/*`) and the `Web/*` text styles
  (Sora for headings, IBM Plex Sans for text, Noto Sans Arabic under `[dir='rtl']`).
- `src/i18n/` — `en.js` / `ar.js` hold all copy; `useI18n()` sets `<html dir/lang>` and the page title.
- `src/components/` — one component per landing-page section, plus the Figma building blocks:
  `SectionHeader`, `IconTile`, `BrandChevrons`, `BaseButton`, `ArrowIcon`. `ContactForm.vue` is the discovery-call form.
- `src/assets/` — images and icons exported from Figma.

### Before launch

- The Arabic copy was written for this build (the Figma file is English only) — have it reviewed.
- The journey ("A Friday at the club") and client quotes are marked *illustrative · concept only* in the design;
  replace them with real, approved content.
- Privacy / Terms links in the footer are placeholders (`#`).
# Logic-Arrow
