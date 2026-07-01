# AgentsFrontend.md

# School Website CMS Frontend Implementation Guide

## Overview

This document defines how to build the **public-facing School Website** using the CMS API endpoints from the School Management ERP. The website is a separate Vue 3 SPA (or SSR app) that displays school information to visitors.

Each school has its own website with content managed through the admin dashboard CMS.

---

## Technology Stack

| Technology | Purpose |
|---|---|
| **Vue 3** (Composition API) | UI framework |
| **TypeScript** | Type safety |
| **Vite** | Build tool |
| **Vue Router** | Routing (hash or history mode) |
| **Axios** | HTTP client |
| **Tailwind CSS** | Styling |
| **Shadcn Vue** | UI components |
| **vue3-carousel** | Slider/carousel |
| **vue-cal** | Event calendar |
| **lightgallery / vue-lightbox** | Gallery lightbox |
| **vue-meta / @unhead/vue** | SEO / meta tags |

### Optional (Better SEO)
| Technology | Purpose |
|---|---|
| **Nuxt 3** | SSR / SSG for SEO |
| **Nuxt Content** | If pages need local content |

---

## Project Structure

```
school-website/
├── assets/
│   ├── images/
│   └── styles/
├── components/
│   ├── layout/
│   │   ├── SiteHeader.vue
│   │   ├── SiteFooter.vue
│   │   ├── SiteNavbar.vue
│   │   └── MobileMenu.vue
│   ├── sections/
│   │   ├── HeroSlider.vue
│   │   ├── AboutSection.vue
│   │   ├── NoticeTicker.vue
│   │   ├── EventCard.vue
│   │   ├── GalleryGrid.vue
│   │   ├── StatsCounter.vue
│   │   └── PopupModal.vue
│   └── shared/
│       ├── PageHero.vue
│       ├── SectionTitle.vue
│       ├── Card.vue
│       ├── Button.vue
│       └── LoadingSpinner.vue
├── composables/
│   ├── useSiteConfig.ts
│   ├── usePages.ts
│   ├── useSlider.ts
│   ├── useGallery.ts
│   ├── useNotices.ts
│   ├── useEvents.ts
│   └── usePopup.ts
├── layouts/
│   └── DefaultLayout.vue
├── pages/
│   ├── index.vue                 # Homepage
│   ├── about.vue                 # About Us
│   ├── academics.vue             # Academic Programs
│   ├── admissions.vue            # Admission Info
│   ├── notices.vue               # Notice Board
│   ├── notice/[slug].vue         # Notice Detail
│   ├── events.vue                # Events Calendar
│   ├── event/[slug].vue          # Event Detail
│   ├── gallery.vue               # Photo Gallery
│   ├── gallery/[id].vue          # Gallery Detail
│   ├── contact.vue               # Contact Us
│   ├── faculty.vue               # Teachers/Staff
│   └── [slug].vue                # Dynamic CMS Pages
├── router/
│   └── index.ts
├── services/
│   ├── api.ts                    # Axios instance
│   ├── pageService.ts
│   ├── sliderService.ts
│   ├── galleryService.ts
│   ├── noticeService.ts
│   ├── eventService.ts
│   ├── popupService.ts
│   └── schoolService.ts
├── stores/
│   ├── siteStore.ts
│   └── cmsStore.ts
├── types/
│   ├── cms.ts
│   └── school.ts
└── utils/
    ├── formatters.ts
    ├── seo.ts
    └── constants.ts
```

---

## API Endpoints (CMS Module)

All admin CRUD is at `/api/v1/...` (authenticated). The public website uses **read-only** endpoints (GET).

| Endpoint | Purpose | Public? |
|---|---|---|
| `GET /api/v1/schools/{id}` | School info (name, logo, contact) | Yes |
| `GET /api/v1/pages` | All published pages | Yes |
| `GET /api/v1/pages/{id}` | Single page by ID | Yes |
| `GET /api/v1/pages?slug={slug}` | Find page by slug | Yes |
| `GET /api/v1/sliders` | Homepage sliders | Yes |
| `GET /api/v1/galleries` | All gallery items | Yes |
| `GET /api/v1/galleries?category={cat}` | Filter by category | Yes |
| `GET /api/v1/notices` | Notice list (paginated) | Yes |
| `GET /api/v1/notices?limit=5` | Latest notices (homepage) | Yes |
| `GET /api/v1/notices/{id}` | Single notice | Yes |
| `GET /api/v1/events` | All events | Yes |
| `GET /api/v1/events?upcoming=true` | Upcoming events | Yes |
| `GET /api/v1/events/{id}` | Single event | Yes |
| `GET /api/v1/popup-settings` | Active popup config | Yes |
| `GET /api/v1/teachers` | Teacher list (public) | Yes |

Best practice: Create a **public prefix** for these in the backend routes (e.g., `/api/v1/public/*`) or simply call the same GET endpoints without auth.

---

## Data Flow

```
Vue Website (public)
    │
    ├── Homepage → calls GET /sliders, GET /notices?limit=5,
    │               GET /events?upcoming=true, GET /pages?slug=home
    │
    ├── About → calls GET /pages?slug=about
    │
    ├── Academics → calls GET /pages?slug=academics
    │
    ├── Admissions → calls GET /pages?slug=admissions
    │
    ├── Notices → calls GET /notices (paginated)
    │
    ├── Events → calls GET /events (filterable)
    │
    ├── Gallery → calls GET /galleries (with lightbox)
    │
    ├── Contact → calls GET /schools/{id} (address/phone)
    │
    └── All pages → checks GET /popup-settings (show popup)
```

---

## Page Rendering Strategy

### Option A: SPA (Vue 3 + Vite)
- Fast navigation, no page reloads
- SEO via `vue-meta` for meta tags
- Pre-render critical pages at build time (optional)

### Option B: SSR (Nuxt 3) — Recommended for SEO
- Better SEO (server-rendered HTML)
- `useAsyncData` for fetching CMS content
- Dynamic routes for CMS pages

---

## Homepage Layout

```
┌──────────────────────────────────────────┐
│  SiteHeader (School Name, Logo, Nav)     │
├──────────────────────────────────────────┤
│  HeroSlider (3 slides from /sliders)      │
├──────────────────────────────────────────┤
│  NoticeTicker (latest 5 from /notices)    │
├─────────┬────────────────┬───────────────┤
│  About  │  Upcoming      │  Quick Links  │
│  Preview│  Events        │  (admission,  │
│         │  (next 3 from  │   gallery,    │
│         │   /events)     │   contact)    │
├─────────┴────────────────┴───────────────┤
│  GalleryGrid (latest 6 from /galleries)  │
├──────────────────────────────────────────┤
│  StatsCounter (enrolled, teachers, etc.)  │
├──────────────────────────────────────────┤
│  SiteFooter                              │
├──────────────────────────────────────────┤
│  PopupModal (from /popup-settings)        │
└──────────────────────────────────────────┘
```

---

## Composable Examples

### `usePages.ts`
```typescript
export function usePages() {
  const pages = ref<Page[]>([])
  const loading = ref(false)

  async function fetchBySlug(slug: string) {
    loading.value = true
    const { data } = await pageService.list({ slug })
    pages.value = data.data
    loading.value = false
    return data.data[0] || null
  }

  return { pages, loading, fetchBySlug }
}
```

### `useSlider.ts`
```typescript
export function useSlider() {
  const slides = ref<Slider[]>([])
  const loading = ref(false)

  async function fetchSliders() {
    loading.value = true
    const { data } = await sliderService.list()
    slides.value = data.data
    loading.value = false
  }

  return { slides, loading, fetchSliders }
}
```

---

## Service Layer

```typescript
// src/services/api.ts
import axios from 'axios'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api/v1',
  headers: { Accept: 'application/json' },
})

// For public website — no auth token needed
// If the API requires auth, use a read-only API key
export default api
```

```typescript
// src/services/pageService.ts
import api from './api'
import type { Page } from '@/types/cms'

export const pageService = {
  list: (params?: Record<string, any>) =>
    api.get<{ data: Page[] }>('/pages', { params }),

  show: (id: number) =>
    api.get<{ data: Page }>(`/pages/${id}`),
}
```

---

## TypeScript Types

```typescript
// src/types/cms.ts
export interface Page {
  id: number
  school_id: number
  title: string
  slug: string
  content: string       // HTML content
  status: 'active' | 'inactive'
  created_at: string
  updated_at: string
}

export interface Slider {
  id: number
  school_id: number
  title: string
  image: string           // Full URL
  link: string | null
}

export interface Gallery {
  id: number
  school_id: number
  title: string
  image: string
  category: string | null
}

export interface Notice {
  id: number
  school_id: number
  title: string
  description: string
  attachment: string | null
  publish_date: string
  created_at: string
}

export interface Event {
  id: number
  school_id: number
  title: string
  start_date: string
  end_date: string
  description: string | null
}

export interface PopupSetting {
  id: number
  school_id: number
  title: string
  image: string
  button_link: string | null
}
```

---

## Page Components

### HeroSlider.vue
```vue
<script setup lang="ts">
import { onMounted } from 'vue'
import { useSlider } from '@/composables/useSlider'
import { Carousel, Slide } from 'vue3-carousel'

const { slides, fetchSliders } = useSlider()
onMounted(fetchSliders)
</script>

<template>
  <Carousel :items-to-show="1" :autoplay="5000" :wrap-around="true">
    <Slide v-for="slide in slides" :key="slide.id">
      <div class="relative h-[500px] bg-cover bg-center"
           :style="{ backgroundImage: `url(${slide.image})` }">
        <div class="absolute inset-0 bg-black/40" />
        <div class="relative z-10 flex items-center justify-center h-full">
          <h2 class="text-4xl font-bold text-white">{{ slide.title }}</h2>
        </div>
      </div>
    </Slide>
  </Carousel>
</template>
```

### NoticeTicker.vue
```vue
<script setup lang="ts">
import { onMounted } from 'vue'
import { useNotices } from '@/composables/useNotices'

const { notices, fetchLatest } = useNotices()
onMounted(() => fetchLatest(5))
</script>

<template>
  <div class="bg-primary-600 text-white py-2 overflow-hidden">
    <div class="container mx-auto flex gap-4">
      <span class="font-bold shrink-0">Notice:</span>
      <div class="overflow-hidden relative flex-1">
        <div class="animate-marquee flex gap-8">
          <a v-for="notice in notices" :key="notice.id"
             :href="`/notice/${notice.id}`" class="hover:underline whitespace-nowrap">
            {{ notice.title }}
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
```

### DynamicPage.vue
```vue
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { usePages } from '@/composables/usePages'

const route = useRoute()
const page = ref<Page | null>(null)

onMounted(async () => {
  page.value = await usePages().fetchBySlug(route.params.slug as string)
})
</script>

<template>
  <div v-if="page" class="container mx-auto py-12">
    <h1 class="text-3xl font-bold mb-6">{{ page.title }}</h1>
    <div class="prose max-w-none" v-html="page.content" />
  </div>
  <div v-else class="container mx-auto py-12 text-center text-gray-500">
    Page not found
  </div>
</template>
```

---

## Router

```typescript
// src/router/index.ts
const routes = [
  { path: '/', name: 'home', component: () => import('@/pages/index.vue') },
  { path: '/about', name: 'about', component: () => import('@/pages/about.vue') },
  { path: '/academics', name: 'academics', component: () => import('@/pages/academics.vue') },
  { path: '/admissions', name: 'admissions', component: () => import('@/pages/admissions.vue') },
  { path: '/notices', name: 'notices', component: () => import('@/pages/notices.vue') },
  { path: '/notice/:id', name: 'notice-detail', component: () => import('@/pages/notice/[id].vue') },
  { path: '/events', name: 'events', component: () => import('@/pages/events.vue') },
  { path: '/event/:id', name: 'event-detail', component: () => import('@/pages/event/[id].vue') },
  { path: '/gallery', name: 'gallery', component: () => import('@/pages/gallery.vue') },
  { path: '/gallery/:id', name: 'gallery-detail', component: () => import('@/pages/gallery/[id].vue') },
  { path: '/contact', name: 'contact', component: () => import('@/pages/contact.vue') },
  { path: '/faculty', name: 'faculty', component: () => import('@/pages/faculty.vue') },
  // Catch-all for CMS-managed pages
  { path: '/:slug', name: 'cms-page', component: () => import('@/pages/[slug].vue') },
]
```

---

## Multi-School Support

Each school gets its own subdomain or path prefix:

```
school-a.example.com    → School A's website
school-b.example.com    → School B's website

OR

example.com/school-a    → School A
example.com/school-b    → School B
```

### Implementation

```typescript
// Use subdomain to identify school
const schoolSlug = window.location.hostname.split('.')[0]

// OR use path prefix
const schoolSlug = route.params.schoolSlug

// Pass schoolSlug to API calls
const { data } = await api.get('/pages', {
  params: { school_slug: schoolSlug }
})
```

The backend should support filtering by school slug or ID. The API already includes `school_id` on all records.

---

## SEO / Meta Tags

```typescript
// composables/useSeo.ts
import { useHead } from '@unhead/vue'

export function useSeo(title: string, description: string, image?: string) {
  useHead({
    title: `${title} | School Name`,
    meta: [
      { name: 'description', content: description },
      { property: 'og:title', content: title },
      { property: 'og:description', content: description },
      { property: 'og:image', content: image || '/og-default.jpg' },
    ],
  })
}
```

```vue
<script setup lang="ts">
useSeo('About Us', 'Learn about our school mission and values')
</script>
```

---

## Performance Considerations

1. **Static pages** — Pre-render homepage, about, contact using SSG (or cache aggressively)
2. **Image optimization** — Use `v-lazy-load` for gallery images; serve WebP format
3. **API caching** — Cache CMS responses with `localStorage` + `swr` pattern
4. **Fonts** — Self-host fonts; avoid Google Fonts latency
5. **Critical CSS** — Inline above-the-fold styles

```typescript
// composables/useCachedFetch.ts
export function useCachedFetch(key: string, fetcher: () => Promise<any>, ttl = 300000) {
  const data = ref(null)
  const loading = ref(true)

  onMounted(async () => {
    const cached = localStorage.getItem(`cms_${key}`)
    if (cached) {
      const { timestamp, payload } = JSON.parse(cached)
      if (Date.now() - timestamp < ttl) {
        data.value = payload
        loading.value = false
        return
      }
    }
    const result = await fetcher()
    data.value = result
    localStorage.setItem(`cms_${key}`, JSON.stringify({ timestamp: Date.now(), payload: result }))
    loading.value = false
  })

  return { data, loading }
}
```

---

## Setup Commands

```bash
# SPA project
npm create vite@latest school-website -- --template vue-ts
cd school-website

# Nuxt 3 (recommended for SEO)
npx nuxi@latest init school-website

# Install dependencies
npm install vue-router pinia axios
npm install tailwindcss @tailwindcss/vite
npm install @unhead/vue
npm install vue3-carousel
npm install vue-cal
```

---

## Backend: Making CMS Endpoints Public

To allow the public website to read CMS data without authentication, create a public route group in `routes/api.php`:

```php
// routes/api.php
Route::prefix('v1/public')->group(function () {
    Route::get('/schools/{school}', [SchoolController::class, 'show']);
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/pages/{page}', [PageController::class, 'show']);
    Route::get('/sliders', [SliderController::class, 'index']);
    Route::get('/galleries', [GalleryController::class, 'index']);
    Route::get('/notices', [NoticeController::class, 'index']);
    Route::get('/notices/{notice}', [NoticeController::class, 'show']);
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::get('/popup-settings', [PopupSettingController::class, 'index']);
    Route::get('/teachers', [TeacherController::class, 'index']);
});
```

Then override the policies to allow `viewAny` for guests, or simply create a dedicated public controller.

---
