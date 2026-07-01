````markdown
# AGENT.md

# Enterprise School Management ERP SaaS

## Project Overview

This project is an **Enterprise-grade Multi-Tenant School Management ERP**, including:

- School Management ERP
- School Website CMS
- Android Mobile Application
- Parent Portal
- Student Portal
- Teacher Portal
- Employee Portal
- Super Admin Portal

This is a large-scale SaaS application intended to serve multiple educational institutions from a single platform.

The system should be designed with **clean architecture**, **high scalability**, **maintainability**, and **modular development** in mind.

The project should **not** be developed as a monolithic collection of features. Every module must be independent and loosely coupled.

---

# Technology Stack

## Backend

- Laravel 12
- PHP 8.4+
- RESTful API
- Laravel Sanctum Authentication
- Repository Pattern
- Service Layer
- DTO Pattern
- Policies
- Form Request Validation
- Resource Classes
- Event Driven Architecture

---

## Frontend

- Vue 3
- TypeScript
- Vite
- Pinia
- Vue Router
- Axios
- Tailwind CSS
- Shadcn Vue

---

## Mobile

- Flutter

The Flutter application must consume the same REST API used by the Vue SPA.

---

## Database

- MySQL 8+

---

## Cache

- Redis

---

## Queue

- Redis Queue

Used for:

- Email
- SMS
- Notifications
- Report Generation
- Background Jobs

---

## Storage

Laravel Storage

Compatible with:

- Local Storage
- Amazon S3
- Cloudflare R2
- MinIO

---

## Search

Optional

Laravel Scout

---

## Realtime

Laravel Reverb / WebSocket

Used for:

- Live Notifications
- Live Attendance
- Online Classes
- Chat
- Dashboard Updates

---

## Integrations

### SMS

- SSL Wireless
- BulkSMS

### Payment

- SSLCommerz
- ShurjoPay

---

# High-Level System Architecture

```
                    Android App
                         │
                Parent / Student App
                         │
                 Teacher Mobile App
                         │
──────────────────────────────────────────
                Vue.js SPA Dashboard
──────────────────────────────────────────
                         │
              School Website (CMS)
                         │
──────────────────────────────────────────
                 Laravel REST API
──────────────────────────────────────────
                         │
                Service Layer
                         │
             Repository Layer
                         │
               Database + Cache
```

---

# Multi-Tenant Architecture

The application must support multiple schools.

One platform will serve many institutions.

```
Super Admin

    │

School A

School B

School C

School D
```

Every record belonging to a school must include:

```
school_id
```

This is one of the most critical architectural requirements.

Each school's data must remain completely isolated.

---

# Core Development Principles

The entire project must follow:

- Modular Architecture
- SOLID Principles
- DRY Principle
- Clean Code
- Domain Separation
- API First Design
- Scalable Folder Structure
- Loose Coupling
- High Cohesion

---

# Authentication Module

Tables

```
users

roles

permissions

role_user

permission_role
```

Supported User Types

- Super Admin
- School Admin
- Teacher
- Employee
- Student
- Parent
- Alumni

Authentication

- Laravel Sanctum
- API Tokens
- Role Based Access Control (RBAC)
- Permission Based Authorization

---

# School Module

### schools

```
id
name
eiin
logo
favicon
address
phone
email
website
status
created_at
updated_at
```

---

### school_settings

```
id
school_id
timezone
currency
language
attendance_type
sms_enabled
email_enabled
created_at
updated_at
```

---

# Website CMS Module

Tables

### pages

```
id
school_id
title
slug
content
status
```

---

### sliders

```
id
school_id
title
image
link
```

---

### galleries

```
id
school_id
title
image
category
```

---

### notices

```
id
school_id
title
description
attachment
publish_date
```

---

### events

```
id
school_id
title
start_date
end_date
description
```

---

### popup_settings

```
id
school_id
title
image
button_link
```

---

# Academic Module

### sessions

```
id
school_id
name
current
```

---

### classes

```
id
school_id
name
```

---

### sections

```
id
class_id
name
```

---

### subjects

```
id
school_id
name
code
```

---

### class_subjects

```
id
class_id
subject_id
teacher_id
```

---

### class_teachers

```
id
class_id
teacher_id
```

---

# Student Module

### students

```
id
school_id
admission_no
roll
name
gender
dob
religion
blood_group
mobile
email
photo
status
```

---

### student_guardians

```
id
student_id
father_name
mother_name
guardian_name
mobile
occupation
```

---

### student_academic

```
id
student_id
class_id
section_id
session_id
```

---

# Teacher Module

```
teachers

id
school_id
employee_no
designation
joining_date
qualification
photo
user_id
```

---

# Employee Module

```
employees

id
school_id
designation
joining_date
salary
photo
user_id
```

---

# Attendance Module

### attendance

```
id
school_id
attendance_date
type
```

Supported Types

- Student
- Teacher
- Employee

---

### attendance_records

```
id
attendance_id
user_id
status
latitude
longitude
device
```

Supports:

- GPS Location
- Device Tracking
- QR Attendance
- Biometric Integration (Future)

---

# Fees & Finance Module

### fee_heads

```
id
school_id
name
```

---

### fee_structures

```
id
class_id
fee_head_id
amount
```

---

### student_fees

```
id
student_id
month
amount
discount
fine
paid
```

---

### transactions

```
id
school_id
invoice
amount
payment_method
status
```

---

# Examination Module

### exams

```
id
school_id
title
session_id
```

---

### exam_subjects

```
id
exam_id
subject_id
full_marks
pass_marks
```

---

### marks

```
id
exam_subject_id
student_id
marks
grade
```

---

### tabulations

```
id
exam_id
student_id
gpa
position
```

---

# Routine Module

### periods

```
id
school_id
name
start_time
end_time
```

---

### class_routines

```
id
class_id
section_id
day
period_id
subject_id
teacher_id
```

---

# Online Admission Module

### admission_applications

```
id
school_id
name
mobile
class_id
status
```

---

### admission_lottery

```
id
application_id
result
```

---

# Leave Management

Tables

```
leave_types

leave_requests
```

Leave requests support:

- Student
- Teacher
- Employee

Fields include:

- Applicant
- Leave Type
- Reason
- Start Date
- End Date
- Status

---

# SMS Module

### sms_logs

```
id
school_id
mobile
message
status
response
```

---

# Certificate Module

### certificate_templates

```
id
school_id
name
html
```

---

### certificates

```
id
student_id
template_id
issue_date
```

---

# Alumni Module

### alumni

```
id
school_id
student_id
profession
company
batch
```

---

### alumni_events

---

### alumni_event_registrations

---

# Vaccination Module

### vaccines

---

### student_vaccines

```
student_id
vaccine_id
date
```

---

# Online Class Module

### online_classes

```
id
school_id
title
meeting_url
teacher_id
start_time
```

---

# Digital Content Module

```
digital_contents

id
school_id
title
file
class_id
subject_id
```

---

# ID Card Module

```
id_card_templates

student_cards

teacher_cards

employee_cards
```

---

# Audit Log Module

```
activity_logs

id
user_id
module
action
ip
device
```

Every important system activity must be logged.

---

# Notification Module

```
notifications

id
school_id
title
message
type
```

Supports

- Push Notifications
- Email
- SMS
- In-App Notifications

---

# Media Manager

```
media

id
school_id
disk
file_name
path
mime
size
```

---

# API Structure

```
/api/v1

auth/

schools/

website/

students/

teachers/

employees/

attendance/

fees/

finance/

exams/

results/

routine/

sms/

admission/

certificates/

alumni/

vaccination/

online-classes/

media/

notifications/

reports/

settings/
```

Every module must expose RESTful APIs.

---

# Vue SPA Folder Structure

```
src/

components/

layouts/

pages/

dashboard/

students/

teachers/

employees/

attendance/

fees/

finance/

exams/

website/

reports/

settings/

stores/

services/

router/

composables/

types/

utils/
```

---

# Laravel Folder Structure

```
app/

Actions/

DTO/

Enums/

Events/

Exceptions/

Helpers/

Http/

Controllers/

Requests/

Resources/

Middleware/

Models/

Observers/

Policies/

Repositories/

Services/

Traits/

Jobs/

Listeners/

Notifications/
```

---

# Development Roadmap

## Phase 1

- Authentication
- Roles & Permissions
- Multi-Tenant Management

---

## Phase 2

- School Settings
- Website CMS

---

## Phase 3

- Academic Structure
- Session
- Class
- Section
- Subject

---

## Phase 4

- Student Management

---

## Phase 5

- Teacher & Employee Management

---

## Phase 6

- Attendance
- GPS Attendance
- QR Attendance

---

## Phase 7

- Fees
- Finance
- Payments
- Accounting

---

## Phase 8

- Examination
- Marks
- Result Processing

---

## Phase 9

- Class Routine
- Exam Routine

---

## Phase 10

- SMS Integration
- Email Integration

---

## Phase 11

- Certificate Management

---

## Phase 12

- Online Admission
- Lottery System

---

## Phase 13

- Leave Management

---

## Phase 14

- Alumni Management

---

## Phase 15

- Online Classes
- Digital Learning Content

---

## Phase 16

- Flutter Mobile Applications

- Student App
- Parent App
- Teacher App

---

## Phase 17

- Reports
- Analytics
- Dashboards

---

## Phase 18

- Notifications
- Support Ticket System

---

## Phase 19

- Performance Optimization
- Security Hardening
- Automated Testing
- Deployment

---

# Engineering Standards

The AI must follow these rules throughout development.

## Architecture

- Multi-Tenant Design
- Repository Pattern
- Service Layer
- DTO Pattern
- Resource Classes
- API Versioning
- Modular Design

---

## Database

- UUID or ULID preferred for scalability
- Soft Deletes
- Foreign Keys
- Proper Indexing
- Database Transactions where appropriate

---

## Security

- RBAC
- Policies
- Form Requests
- Rate Limiting
- API Authentication
- Secure File Upload
- Input Validation

---

## Performance

- Eager Loading
- Pagination
- Queue Heavy Tasks
- Cache Frequently Accessed Data
- Optimize Database Queries

---

## Logging

Every important action must be logged.

Examples:

- Login
- Logout
- Create
- Update
- Delete
- Payment
- Attendance
- Examination
- Admission
- Result Publication

---

## Testing

- Feature Tests
- Unit Tests
- API Tests

---

# Estimated Project Scale

This SaaS ERP is expected to contain approximately:

- 80–120 Database Tables
- 200+ REST API Endpoints
- 50+ Vue Dashboard Modules
- Multiple Flutter Applications
- Multi-Tenant SaaS Architecture
- Enterprise-Level Security
- Enterprise-Level Performance
- Long-Term Maintainability

The AI should always prioritize **clean architecture**, **modularity**, **scalability**, and **maintainability** over short-term implementation convenience. Every new feature should integrate seamlessly into the existing architecture without creating tight coupling or technical debt.
````
