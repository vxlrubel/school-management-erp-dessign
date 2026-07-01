# AgentsDashboard.md

# Vue 3 SPA Dashboard Implementation Guide

## Overview

This document defines how to build the **Vue 3 + TypeScript SPA Dashboard** that consumes the School Management ERP REST API (`/api/v1/*`).

---

## Technology Stack

| Technology | Purpose |
|---|---|
| **Vue 3** (Composition API) | UI framework |
| **TypeScript** | Type safety |
| **Vite** | Build tool |
| **Pinia** | State management |
| **Vue Router** | Client-side routing |
| **Axios** | HTTP client |
| **Tailwind CSS** | Utility-first styling |
| **Shadcn Vue** | Component library (Radix-based) |
| **date-fns** | Date formatting |
| **vue-chartjs / chart.js** | Analytics charts |

---

## Project Structure

```
src/
├── assets/
│   ├── images/
│   └── styles/
├── components/
│   ├── ui/                  # Shadcn Vue components (button, card, table, dialog, etc.)
│   ├── layout/
│   │   ├── AppLayout.vue
│   │   ├── AppSidebar.vue
│   │   ├── AppHeader.vue
│   │   └── AppFooter.vue
│   └── shared/
│       ├── DataTable.vue
│       ├── FormModal.vue
│       ├── ConfirmDialog.vue
│       ├── StatsCard.vue
│       ├── FileUpload.vue
│       ├── StatusBadge.vue
│       └── EmptyState.vue
├── composables/
│   ├── useAuth.ts
│   ├── usePagination.ts
│   ├── useSchool.ts
│   ├── usePermissions.ts
│   ├── useNotifications.ts
│   └── useForm.ts
├── layouts/
│   ├── AdminLayout.vue
│   ├── AuthLayout.vue
│   └── BlankLayout.vue
├── pages/
│   ├── auth/
│   │   ├── LoginPage.vue
│   │   └── LogoutPage.vue
│   ├── dashboard/
│   │   └── IndexPage.vue       # Overview stats, charts, recent activity
│   ├── schools/
│   │   ├── SchoolListPage.vue
│   │   ├── SchoolCreatePage.vue
│   │   ├── SchoolEditPage.vue
│   │   └── SchoolShowPage.vue
│   ├── users/
│   │   ├── UserListPage.vue
│   │   ├── UserCreatePage.vue
│   │   └── UserEditPage.vue
│   ├── roles/
│   │   ├── RoleListPage.vue
│   │   └── RoleEditPage.vue
│   ├── permissions/
│   │   └── PermissionListPage.vue
│   ├── academic/
│   │   ├── SessionListPage.vue
│   │   ├── ClassListPage.vue
│   │   ├── SectionListPage.vue
│   │   ├── SubjectListPage.vue
│   │   └── SubjectAssignmentPage.vue
│   ├── students/
│   │   ├── StudentListPage.vue
│   │   ├── StudentCreatePage.vue
│   │   ├── StudentShowPage.vue
│   │   └── StudentImportPage.vue
│   ├── teachers/
│   │   └── TeacherListPage.vue
│   ├── employees/
│   │   └── EmployeeListPage.vue
│   ├── attendance/
│   │   ├── AttendanceMarkPage.vue
│   │   └── AttendanceReportPage.vue
│   ├── fees/
│   │   ├── FeeHeadListPage.vue
│   │   ├── FeeStructurePage.vue
│   │   ├── StudentFeeLedgerPage.vue
│   │   └── TransactionListPage.vue
│   ├── exams/
│   │   ├── ExamListPage.vue
│   │   ├── MarkEntryPage.vue
│   │   └── TabulationPage.vue
│   ├── routine/
│   │   └── RoutinePage.vue
│   ├── cms/
│   │   ├── PageListPage.vue
│   │   ├── PageEditPage.vue
│   │   ├── SliderListPage.vue
│   │   ├── GalleryListPage.vue
│   │   ├── NoticeListPage.vue
│   │   └── EventListPage.vue
│   ├── admission/
│   │   └── ApplicationListPage.vue
│   ├── leave/
│   │   ├── LeaveTypePage.vue
│   │   └── LeaveRequestPage.vue
│   ├── certificates/
│   │   ├── TemplateListPage.vue
│   │   └── CertificateIssuePage.vue
│   ├── alumni/
│   │   ├── AlumniListPage.vue
│   │   └── EventListPage.vue
│   ├── online-classes/
│   │   └── OnlineClassListPage.vue
│   ├── digital-content/
│   │   └── ContentListPage.vue
│   ├── id-cards/
│   │   ├── IdCardTemplatePage.vue
│   │   └── CardGeneratePage.vue
│   ├── notifications/
│   │   └── NotificationListPage.vue
│   ├── media/
│   │   └── MediaListPage.vue
│   ├── reports/
│   │   ├── AttendanceReportPage.vue
│   │   ├── FeeReportPage.vue
│   │   ├── ExamReportPage.vue
│   │   └── StudentReportPage.vue
│   └── settings/
│       ├── SchoolSettingsPage.vue
│       └── ProfilePage.vue
├── router/
│   └── index.ts
├── services/
│   ├── api.ts               # Axios instance, interceptors
│   ├── authService.ts
│   ├── schoolService.ts
│   ├── userService.ts
│   ├── roleService.ts
│   ├── permissionService.ts
│   ├── academicService.ts
│   ├── studentService.ts
│   ├── teacherService.ts
│   ├── employeeService.ts
│   ├── attendanceService.ts
│   ├── feeService.ts
│   ├── examService.ts
│   ├── routineService.ts
│   ├── cmsService.ts
│   ├── admissionService.ts
│   ├── leaveService.ts
│   ├── smsService.ts
│   ├── certificateService.ts
│   ├── alumniService.ts
│   ├── vaccinationService.ts
│   ├── onlineClassService.ts
│   ├── digitalContentService.ts
│   ├── idCardService.ts
│   ├── notificationService.ts
│   ├── mediaService.ts
│   └── activityLogService.ts
├── stores/
│   ├── authStore.ts
│   ├── schoolStore.ts
│   ├── appStore.ts
│   └── notificationStore.ts
├── types/
│   ├── api.ts
│   ├── models.ts             # All response model interfaces
│   ├── requests.ts           # All request payload interfaces
│   └── enums.ts
└── utils/
    ├── formatters.ts         # Date, currency, name formatters
    ├── validators.ts         # Form validation helpers
    └── constants.ts
```

---

## Authentication Flow

### API Endpoints
```
POST /api/v1/auth/login      → Sanctum token
POST /api/v1/auth/logout     → Revoke token
GET  /api/v1/auth/user       → Current user
```

### Implementation
```
src/services/api.ts
```
- Create Axios instance with `baseURL: /api/v1`
- Auto-attach `Authorization: Bearer {token}` via interceptor
- Handle 401 → redirect to login
- Handle 403 → show permission denied toast

```
src/stores/authStore.ts
```
- `user`, `token`, `school`, `permissions` state
- `login(email, password)`, `logout()`, `fetchUser()` actions
- Persist token in `localStorage`

```
src/router/index.ts
```
- Navigation guards: redirect to login if no token
- Route meta: `{ requiresAuth: true, permission: 'users.view' }`
- Dynamic permission check in guard

---

## API Consumption Pattern

### Service Layer (`src/services/*.ts`)

Each service file wraps API calls for one module:

```typescript
// src/services/studentService.ts
import api from './api'
import type { Student, PaginatedResponse } from '@/types/models'

export const studentService = {
  list: (params?: Record<string, any>) =>
    api.get<PaginatedResponse<Student>>('/students', { params }),

  show: (id: number) =>
    api.get<{ data: Student }>(`/students/${id}`),

  create: (data: FormData | Record<string, any>) =>
    api.post<{ data: Student }>('/students', data),

  update: (id: number, data: Record<string, any>) =>
    api.put<{ data: Student }>(`/students/${id}`, data),

  delete: (id: number) =>
    api.delete(`/students/${id}`),
}
```

### State Management (Pinia)

```typescript
// src/stores/schoolStore.ts
export const useSchoolStore = defineStore('school', () => {
  const schools = ref<School[]>([])
  const loading = ref(false)

  const fetchAll = async () => {
    loading.value = true
    const { data } = await schoolService.list()
    schools.value = data.data
    loading.value = false
  }

  return { schools, loading, fetchAll }
})
```

### Component Usage

```vue
<script setup lang="ts">
import { onMounted } from 'vue'
import { useSchoolStore } from '@/stores/schoolStore'

const store = useSchoolStore()
onMounted(() => store.fetchAll())
</script>

<template>
  <DataTable :data="store.schools" :loading="store.loading" />
</template>
```

---

## API Endpoint Reference

All endpoints are prefixed with `/api/v1`. Responses follow JSON:API-like format:
```json
{
  "data": { ... } | [ ... ],
  "links": { "first": "...", "last": "...", "prev": null, "next": "..." },
  "meta": { "current_page": 1, "last_page": 5, "per_page": 15, "total": 72 }
}
```

| # | Module | Endpoints | Pages |
|---|---|---|---|
| 1 | **Schools** | `GET/POST/PUT/DELETE /schools` | School List, Create, Edit, Show |
| 2 | **School Settings** | `GET/PUT /school-settings` (nested) | Settings Page |
| 3 | **Roles** | `GET/POST/PUT/DELETE /roles` | Role List, Edit |
| 4 | **Permissions** | `GET /permissions` | Permissions view |
| 5 | **Users** | `GET/POST/PUT/DELETE /users` | User List, Create, Edit |
| 6 | **Sessions** | `GET/POST/PUT/DELETE /sessions` | Session List |
| 7 | **Classes** | `GET/POST/PUT/DELETE /classes` | Class List |
| 8 | **Sections** | `GET/POST/PUT/DELETE /sections` | Section List |
| 9 | **Subjects** | `GET/POST/PUT/DELETE /subjects` | Subject List |
| 10 | **Class-Subjects** | `GET/POST/PUT/DELETE /class-subjects` | Subject Assignment |
| 11 | **Class-Teachers** | `GET/POST/PUT/DELETE /class-teachers` | Teacher Assignment |
| 12 | **Students** | `GET/POST/PUT/DELETE /students` | Student List, Create, Show |
| 13 | **Student Guardians** | `GET/POST/PUT/DELETE /student-guardians` | Guardian Details |
| 14 | **Student Academics** | `GET/POST/PUT/DELETE /student-academics` | Academic Records |
| 15 | **Teachers** | `GET/POST/PUT/DELETE /teachers` | Teacher List |
| 16 | **Employees** | `GET/POST/PUT/DELETE /employees` | Employee List |
| 17 | **Attendance** | `GET/POST/PUT/DELETE /attendance` | Mark/View Attendance |
| 18 | **Attendance Records** | `GET/POST/PUT/DELETE /attendance-records` | Attendance Details |
| 19 | **Fee Heads** | `GET/POST/PUT/DELETE /fee-heads` | Fee Head Setup |
| 20 | **Fee Structures** | `GET/POST/PUT/DELETE /fee-structures` | Fee Structure |
| 21 | **Student Fees** | `GET/POST/PUT/DELETE /student-fees` | Fee Ledger |
| 22 | **Transactions** | `GET/POST/PUT/DELETE /transactions` | Payment History |
| 23 | **Exams** | `GET/POST/PUT/DELETE /exams` | Exam List |
| 24 | **Exam Subjects** | `GET/POST/PUT/DELETE /exam-subjects` | Exam Config |
| 25 | **Marks** | `GET/POST/PUT/DELETE /marks` | Mark Entry |
| 26 | **Tabulations** | `GET/POST/PUT/DELETE /tabulations` | Result Sheet |
| 27 | **Periods** | `GET/POST/PUT/DELETE /periods` | Period Setup |
| 28 | **Class Routines** | `GET/POST/PUT/DELETE /class-routines` | Routine View |
| 29 | **Pages** | `GET/POST/PUT/DELETE /pages` | CMS Page Editor |
| 30 | **Sliders** | `GET/POST/PUT/DELETE /sliders` | Slider Manager |
| 31 | **Galleries** | `GET/POST/PUT/DELETE /galleries` | Gallery Manager |
| 32 | **Notices** | `GET/POST/PUT/DELETE /notices` | Notice Board |
| 33 | **Events** | `GET/POST/PUT/DELETE /events` | Events Calendar |
| 34 | **Popup Settings** | `GET/POST/PUT/DELETE /popup-settings` | Popup Config |
| 35 | **Admission Apps** | `GET/POST/PUT/DELETE /admission-applications` | Applications |
| 36 | **Admission Lotteries** | `GET/POST/PUT/DELETE /admission-lotteries` | Lottery Results |
| 37 | **Leave Types** | `GET/POST/PUT/DELETE /leave-types` | Leave Types |
| 38 | **Leave Requests** | `GET/POST/PUT/DELETE /leave-requests` | Leave Management |
| 39 | **SMS Logs** | `GET /sms-logs` | SMS History |
| 40 | **Certificate Templates** | `GET/POST/PUT/DELETE /certificate-templates` | Template Designer |
| 41 | **Certificates** | `GET/POST/PUT/DELETE /certificates` | Issue Certificates |
| 42 | **Alumni** | `GET/POST/PUT/DELETE /alumni` | Alumni Directory |
| 43 | **Alumni Events** | `GET/POST/PUT/DELETE /alumni-events` | Alumni Events |
| 44 | **Alumni Registrations** | `GET/POST/PUT/DELETE /alumni-event-registrations` | Registrations |
| 45 | **Vaccines** | `GET/POST/PUT/DELETE /vaccines` | Vaccine List |
| 46 | **Student Vaccines** | `GET/POST/PUT/DELETE /student-vaccines` | Vaccination Records |
| 47 | **Online Classes** | `GET/POST/PUT/DELETE /online-classes` | Online Class Schedule |
| 48 | **Digital Contents** | `GET/POST/PUT/DELETE /digital-contents` | Content Library |
| 49 | **ID Card Templates** | `GET/POST/PUT/DELETE /id-card-templates` | Card Template |
| 50 | **Student Cards** | `GET/POST/PUT/DELETE /student-cards` | Student Cards |
| 51 | **Teacher Cards** | `GET/POST/PUT/DELETE /teacher-cards` | Teacher Cards |
| 52 | **Employee Cards** | `GET/POST/PUT/DELETE /employee-cards` | Employee Cards |
| 53 | **Notifications** | `GET/POST/PUT/DELETE /notifications` | Notification Center |
| 54 | **Media** | `GET/POST/PUT/DELETE /media` | Media Manager |
| 55 | **Activity Logs** | `GET /activity-logs` | Audit Trail |

---

## Dashboard Pages by User Role

### Super Admin
```
/dashboard                    → Overview (all schools stats)
/schools                      → School Management
/users                        → Global Users
/roles                        → Role Management
/permissions                  → Permission Management
/activity-logs                → System Audit
```

### School Admin
```
/dashboard                    → School Overview (student count, attendance %, fee collection)
/academic/sessions            → Academic Sessions
/academic/classes             → Classes
/academic/sections            → Sections
/academic/subjects            → Subjects
/academic/assignments         → Subject-Teacher Assignment
/students                     → Student Management
/teachers                     → Teacher Management
/employees                    → Employee Management
/attendance                   → Mark Attendance
/attendance/reports           → Attendance Reports
/fees/heads                   → Fee Heads
/fees/structures              → Fee Structures
/fees/ledger                  → Student Fee Ledger
/fees/transactions            → Transactions
/exams                        → Exams
/exams/marks                  → Mark Entry
/exams/results                → Tabulation Sheet
/routine                      → Class Routine
/cms/pages                    → Website Pages
/cms/sliders                  → Sliders
/cms/galleries                → Galleries
/cms/notices                  → Notices
/cms/events                   → Events
/cms/popup                    → Popup Settings
/admission/applications       → Admission Applications
/admission/lottery            → Lottery Results
/leave/types                  → Leave Types
/leave/requests               → Leave Requests
/sms-logs                     → SMS Logs
/certificates/templates       → Certificate Templates
/certificates/issue           → Issue Certificates
/alumni                       → Alumni Directory
/alumni/events                → Alumni Events
/vaccines                     → Vaccination Records
/online-classes               → Online Classes
/digital-content              → Digital Content Library
/id-cards/templates           → ID Card Templates
/id-cards/generate            → Generate Cards
/notifications                → Send Notifications
/media                        → Media Manager
/settings                     → School Settings
/reports/attendance           → Attendance Report
/reports/fees                 → Fee Report
/reports/exams                → Exam Report
/reports/students             → Student Report
```

### Teacher
```
/dashboard                    → My classes, today's routine
/attendance                   → Mark student attendance
/exams/marks                  → Enter marks for assigned subjects
/routine                      → View my routine
/students                     → View student profiles
/digital-content              → Access learning materials
/online-classes               → View class schedule
/leave/requests               → Apply for leave
```

### Student / Parent (Portal, separate from admin SPA)
```
/profile                      → Profile & academic info
/attendance                   → View attendance
/fees                         → View fee status
/exams/results                → View results
/routine                      → View class routine
/certificates                 → Download certificates
/id-card                      → View/download ID card
/vaccines                     → Vaccination record
/leave/requests               → Apply for leave
/notices                      → School notices
/events                       → Upcoming events
/online-classes               → Join online class
/digital-content              → Study materials
```

---

## Key UI Patterns

### Data Table (all list pages)
```vue
<DataTable
  :columns="columns"
  :data="items"
  :loading="loading"
  :pagination="pagination"
  @page-change="onPageChange"
  @search="onSearch"
/>
```

### Form Modal (create/edit)
```vue
<FormModal
  v-model:open="isOpen"
  :title="isEditing ? 'Edit Student' : 'Add Student'"
  :loading="saving"
  @submit="handleSubmit"
>
  <FormField label="Name" v-model="form.name" :error="errors.name" />
  <FormField label="Email" v-model="form.email" type="email" />
  <!-- ... -->
</FormModal>
```

### Stat Card (dashboard overview)
```vue
<StatsCard
  title="Total Students"
  :value="stats.totalStudents"
  :trend="stats.studentTrend"
  icon="Users"
/>
```

### Chart
```vue
<LineChart :data="attendanceChartData" :options="chartOptions" />
```

---

## Authentication Guard Setup

```typescript
// src/router/index.ts
router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore()

  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    return next('/login')
  }

  if (to.meta.permission && !auth.hasPermission(to.meta.permission)) {
    return next('/403')
  }

  next()
})
```

---

## Axios Interceptor

```typescript
// src/services/api.ts
api.interceptors.response.use(
  response => response,
  error => {
    if (error.response?.status === 401) {
      const auth = useAuthStore()
      auth.logout()
      router.push('/login')
    }
    if (error.response?.status === 403) {
      // Show permission denied toast
    }
    return Promise.reject(error)
  }
)
```

---

## TypeScript Interfaces

```typescript
// src/types/models.ts
export interface School {
  id: number
  name: string
  eiin: string | null
  logo: string | null
  address: string | null
  phone: string | null
  email: string | null
  website: string | null
  status: 'active' | 'inactive'
  created_at: string
  updated_at: string
}

export interface Student {
  id: number
  school_id: number
  admission_no: string
  roll: string | null
  name: string
  gender: string | null
  dob: string | null
  religion: string | null
  blood_group: string | null
  mobile: string | null
  email: string | null
  photo: string | null
  status: string
  guardian?: StudentGuardian
  academic?: StudentAcademic
  created_at: string
  updated_at: string
}

export interface User {
  id: number
  school_id: number | null
  name: string
  email: string
  phone: string | null
  user_type: 'super_admin' | 'school_admin' | 'teacher' | 'employee' | 'student' | 'parent' | 'alumni'
  status: string
  photo: string | null
  roles?: Role[]
  created_at: string
}

export interface PaginatedResponse<T> {
  data: T[]
  links: { first: string; last: string; prev: string | null; next: string | null }
  meta: { current_page: number; last_page: number; per_page: number; total: number }
}
```

---

## Setup Commands

```bash
# Create Vue project
npm create vite@latest dashboard -- --template vue-ts

# Install dependencies
npm install vue-router pinia axios
npm install tailwindcss @tailwindcss/vite
npm install shadcn-vue
npm install date-fns chart.js vue-chartjs
npm install @radix-icons/vue  # or lucide-vue-next
```

---
