# 🎓 Gačanović Academy

<div align="center">

**A full-stack e-learning platform built with Laravel, where knowledge meets clean architecture.**

[![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![jQuery](https://img.shields.io/badge/jQuery-AJAX-0769AD?style=for-the-badge&logo=jquery&logoColor=white)](https://jquery.com)
[![Stripe](https://img.shields.io/badge/Stripe-Payment-635BFF?style=for-the-badge&logo=stripe&logoColor=white)](https://stripe.com)
[![MVC](https://img.shields.io/badge/Architecture-MVC-28a745?style=for-the-badge)](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)

🔗 **[Live Demo](https://gacanovic-academy.infinityfree.me/)** &nbsp;|&nbsp; 📘 **[Documentation PDF](https://github.com/MarkoG111/gacanovic_academy/blob/master/public/Dokument.pdf)** &nbsp;|&nbsp; 🗄️ **[Database SQL](https://github.com/MarkoG111/gacanovic_academy/blob/master/gacanovic_academy.sql)**

</div>


---
 
## 📑 Table of Contents
 
- [📖 About The Project](#-about-the-project)
- [🗺️ Application Architecture](#️-application-architecture)
- [🧩 Features by Role](#-features-by-role)
  - [👨‍🎓 Students](#-students)
  - [👨‍🏫 Instructors](#-instructors)
  - [🛠️ Admins](#️-admins)
- [💳 Stripe Payment Integration](#-stripe-payment-integration)
- [🏗️ Project Structure](#️-project-structure)
  - [Models](#models-appmodels)
  - [Controllers](#controllers-apphttpcontrollers)
  - [Middlewares](#middlewares-apphttpmiddleware)
  - [Services](#services-apphttpservices)
  - [Form Requests](#form-requests-validation--apphttprequests)
- [🗄️ Database Schema](#️-database-schema)
- [🎨 Frontend & JavaScript](#-frontend--javascript)
- [📄 Key Pages & Routes](#-key-pages--routes)
- [⚙️ Technologies Used](#️-technologies-used)
- [🔐 Authentication & Security](#-authentication--security)
- [🧰 Installation & Setup](#-installation--setup)
- [🔑 Demo Credentials](#-demo-credentials)
- [📁 Project Structure Overview](#-project-structure-overview)
- [📸 Pages Overview](#-pages-overview)
- [👨‍💻 Author](#-author)
- [📚 References](#-references)

---

## 📖 About The Project

**Gačanović Academy** is a complete e-learning web application where users can browse, purchase, and access online courses across multiple categories and topics. The platform supports three distinct user roles: **Admin**, **Instructor**, and **Student**. Each with its own set of features and access levels.

The project was developed as a final thesis at the **ICT College of Vocational Studies Belgrade**, subject: *Web Programming PHP 2*, using the **Laravel 8** framework and following the **MVC architectural pattern**.

---

## 🗺️ Application Architecture

```
Gačanović Academy
│
├── 👥 User Roles
│   ├── 🛡️  Admin       → Full system control
│   ├── 🎓  Instructor  → Course management
│   └── 📚  Student     → Browse, buy & learn
│
├── 🌐 Frontend
│   ├── Blade Templates (Laravel)
│   ├── Bootstrap 4
│   ├── jQuery + AJAX
│   └── LocalStorage (cart system)
│
├── ⚙️  Backend
│   ├── Laravel 8 (MVC)
│   ├── 13 Models
│   ├── 13 Controllers
│   ├── 4 Middlewares
│   ├── 11 Form Requests (validation)
│   └── 4 Services
│
└── 💾 Database
    └── MySQL - 13 tables
```

---

## 🧩 Features by Role

### 👨‍🎓 Students

| Feature | Description |
|---|---|
| 🔍 Browse Courses | Filter by category, topic, author, price, and sort order |
| 🛒 Cart System | Add/remove courses / built with **AJAX + LocalStorage** |
| ❤️ Wishlist | Save courses for later / fully AJAX-powered |
| 💳 Checkout | Secure payment via **Stripe** (test mode) |
| 📚 My Learnings | View all purchased courses with their lessons |
| 📧 Contact Form | Send messages to admin / client + server validation |
| 🔐 Auth | Register and login with regex-validated credentials |

### 👨‍🏫 Instructors

| Feature | Description |
|---|---|
| 📝 Become Instructor | Answer a poll question to unlock instructor privileges |
| ➕ Create Courses | Add courses with multiple lessons, topics, categories, and images |
| ✏️ Edit Courses | Update course details, lessons, image, price, and topics |
| 🗑️ Delete Courses | Remove courses with cascading AJAX-powered deletion |
| 📋 Dashboard | Dynamic AJAX table showing all personal courses with pagination |

### 🛠️ Admins

| Feature | Description |
|---|---|
| 📊 System Logs | View all key platform activities via Laravel Log Viewer |
| 👤 User Management | Create, edit, delete users / manage roles and instructor status |
| 📦 Course Management | Full CRUD for all courses on the platform |
| 🗂️ Category Management | Add, edit, and delete course categories with images |
| 🏷️ Topic Management | Manage topics (tags) assigned to courses |
| 📬 Contact Inbox | View and delete messages sent by users |
| 🧾 Order History | Full paginated view of all completed purchases |

---

## 💳 Stripe Payment Integration

The checkout flow is built with the **Stripe Checkout API** and includes **Webhook support** for payment reliability:

```
1.  Browser → sends cart items to server
2.  Server  → creates a Stripe Checkout Session
3.  Stripe  → returns session object with payment URL
4.  Server  → saves "unpaid" order, links session ID
5.  User    → redirected to Stripe payment page
6.  User    → completes payment
7.  Browser → redirected to /success with session ID
8.  Server  → validates session with Stripe
9.  Server  → marks order as "paid" in the database
         ↕  (parallel, for reliability)
10. Stripe  → fires Webhook event to /webhook
11. Server  → verifies session ID from webhook payload
12. Server  → marks order as "paid" (idempotent, safe)
```

> ⚠️ The `/webhook` route is excluded from **CSRF verification** to allow Stripe to POST to it. The Stripe CLI is used for local webhook testing via `stripe listen --forward-to localhost:8000/webhook`.

---

## 🏗️ Project Structure

### Models (`app/Models/`)

| Model | Responsibility |
|---|---|
| `User` | Auth, activity tracking, contact email storage |
| `Course` | Course CRUD, filtering, single course fetch |
| `Category` | Category management, featured categories |
| `Topic` | Topic (tag) management |
| `Lesson` | Lesson URLs per course |
| `Order` | Order management, learnings per user |
| `CourseOrder` | Pivot - links courses to orders |
| `CourseTopic` | Pivot - links courses to topics |
| `Wish` | Wishlist per user |
| `Instructor` | Poll answers, voting, instructor promotion |
| `Role` | User roles (Admin / User) |
| `ContactMail` | Stored contact form messages |

### Controllers (`app/Http/Controllers/`)

| Controller | Responsibility |
|---|---|
| `FrontController` | Home, courses, single course, learnings, cart, contact, auth pages |
| `AuthController` | Register, login, logout |
| `CheckoutController` | Stripe session, success, cancel, webhook |
| `CartController` | Returns all courses as JSON for cart rendering |
| `WishController` | Add, count, list, delete wishlist items |
| `InstructorController` | Instructor course CRUD + poll voting |
| `LessonController` | Delete individual lessons |
| `Admin/CourseController` | Admin course CRUD |
| `Admin/CategoryController` | Admin category CRUD |
| `Admin/TopicController` | Admin topic CRUD |
| `Admin/UserController` | Admin user CRUD |
| `Admin/ContactController` | Admin contact mail view and delete |

### Middlewares (`app/Http/Middleware/`)

| Middleware | Description |
|---|---|
| `AdminMiddleware` | Restricts access to admin-only routes (aborts 404 if not admin) |
| `AuthoriseMiddleware` | Redirects unauthenticated users to login |
| `AuthoriseMiddleware404` | Returns 404 for unauthenticated API routes |
| `RecordAccessToPage` | Logs every page visit (IP, user, URL) to `file_access.txt` |

### Services (`app/Http/Services/`)

| Service | Description |
|---|---|
| `Helper` | Generic error responses, current time helper |
| `ImageHelper` | Processes uploaded images / Creates both **small (400px)** and **big (750px)** versions using Intervention Image |
| `Logs` | Wraps Laravel's Log facade - `loggingSuccess()` for notices, `logging()` for errors |
| `UserService` | Encapsulates user update logic (role, active, instructor, password) |

### Form Requests (Validation) - `app/Http/Requests/`

All validation is handled by Laravel's `FormRequest` classes with custom error messages:

| Request | Validates |
|---|---|
| `RegistrationRequest` | Username (regex), email (unique), password (regex), confirm match |
| `LoginRequest` | Username existence, password format |
| `AddCourseRequest` | Name, price, hours, image (mime/size), lessons (array), topics, category |
| `UpdateCourseRequest` | Same as above but image is nullable |
| `AddCategoryRequest` | Name, image (required) |
| `UpdateCategoryRequest` | Name, image (nullable) |
| `AddUpdateTopicRequest` | Topic name (required string) |
| `AddUserRequest` | Username, email, password, role / with uniqueness checks |
| `UpdateUserRequest` | Same as above / Ignores own record on unique check |
| `ContactRequest` | Email, subject, message / regex validated |
| `FilterCoursesRequest` | Search, categories, topic, sort, showing / all nullable |

---

## 🗄️ Database Schema

The database contains **13 tables** built with MySQL:

```
┌─────────────────────────────────────────────────────────┐
│                    gacanovic_academy                     │
├──────────────────┬──────────────────────────────────────┤
│ Table            │ Description                          │
├──────────────────┼──────────────────────────────────────┤
│ user             │ Users with roles, auth, activity     │
│ role             │ Admin (1) / User (2)                 │
│ course           │ E-courses with image, price, hours   │
│ category         │ Course categories with images        │
│ topic            │ Course tags/topics                   │
│ course_topic     │ M:N - courses ↔ topics               │
│ lesson           │ Lesson URLs per course               │
│ orders           │ Purchase orders (paid/unpaid)        │
│ courses_orders   │ M:N - orders ↔ courses               │
│ wish             │ Wishlist items per user              │
│ contact_mail     │ Messages from contact form           │
│ answer           │ Poll answers for instructor survey   │
│ voting           │ Which user voted for which answer    │
└──────────────────┴──────────────────────────────────────┘
```

**Key Relationships:**
- A `course` belongs to one `category`, has many `lessons`, and many `topics` (via `course_topic`)
- A `user` can have many `orders`, each order links to one or many `courses` (via `courses_orders`)
- A `user` can have many `wishes`, one per unique course
- An `instructor` status is granted after a `voting` record is created

---

## 🎨 Frontend & JavaScript

### AJAX-Powered Features

The following are implemented **without full page reloads**:

- **Cart system**: add/remove courses, stored in `localStorage`
- **Wishlist**: add, remove, count / all via jQuery AJAX
- **Admin tables**: all CRUD tables (courses, categories, topics, users, mails) are dynamically rendered
- **Pagination**: admin-side pagination is custom-built via AJAX (no full reload)
- **Registration**: client-side validated before AJAX POST
- **Instructor voting**: submits poll answer via AJAX, updates UI on success
- **Contact form**: validates client-side with regex, then sends via AJAX

### JavaScript Files

| File | Purpose |
|---|---|
| `main.js` | Admin AJAX tables, pagination, register/login UI, lesson add/remove, instructor poll |
| `cart.js` | Cart rendering from LocalStorage + Stripe cart items input |
| `wish.js` | Wishlist display, add, delete, count badge update |
| `contact.js` | Contact form client-side validation + AJAX submit |

---

## 📄 Key Pages & Routes

| Route | Page | Access |
|---|---|---|
| `/` | Home - featured categories | Public |
| `/courses` | Course listing with filters | Public |
| `/courses/{id}` | Single course detail | Public |
| `/login` | Login + Register (tabbed) | Public |
| `/contact` | Contact form | Public |
| `/author` | About the developer | Public |
| `/cart` | Shopping cart | Auth |
| `/wishlist` | Wishlist | Auth |
| `/checkout` | Stripe checkout | Auth |
| `/learnings` | Purchased courses + lessons | Auth |
| `/instructor` | Instructor dashboard / poll | Auth |
| `/instructor/{id}/edit` | Edit own course | Instructor |
| `/orders` | All orders | Admin |
| `/admin/logs` | System activity logs | Admin |
| `/admin/courses/create` | Manage all courses | Admin |
| `/admin/categories/create` | Manage categories | Admin |
| `/admin/topics/create` | Manage topics | Admin |
| `/admin/users/create` | Manage users | Admin |
| `/admin/contact/create` | View contact messages | Admin |
| `/webhook` | Stripe webhook endpoint | Stripe (no CSRF) |

---

## ⚙️ Technologies Used

**Backend**
- PHP 8.x
- Laravel 8 (MVC, Blade, Eloquent/Query Builder, Form Requests, Middleware, Mail)
- Stripe PHP SDK (`stripe/stripe-php ^10.0`)
- Intervention Image (`intervention/image ^2.7`) - for image resizing
- Laravel Log Viewer (`rap2hpoutre/laravel-log-viewer ^1.7`)

**Frontend**
- HTML5, CSS3
- Bootstrap 4
- jQuery 3 + AJAX
- LocalStorage API
- Font Awesome (icons)

**Database**
- MySQL (via phpMyAdmin / XAMPP)

**Dev Tools**
- Visual Studio Code
- XAMPP (local server)
- phpMyAdmin
- Stripe CLI (local webhook testing)

---

## 🔐 Authentication & Security

- Passwords stored as **MD5 hash** (with password in the validation regex: min. 3 letters + 1 number)
- Session-based authentication (custom, not Laravel Auth)
- **CSRF protection** on all forms (`@csrf`)
- CSRF **disabled only** for `/webhook` (required by Stripe)
- **Admin middleware** aborts with 404 (not redirect) to avoid route enumeration
- **RecordAccessToPage middleware** logs every request to `storage/app/file_access.txt`
- Client + server-side validation on all forms (regex-based)

---

## 🧰 Installation & Setup

**Requirements:** PHP 8.x, Composer, MySQL, Node.js (optional)

```bash
# 1. Clone the repository
git clone https://github.com/MarkoG111/gacanovic_academy.git
cd gacanovic_academy

# 2. Install PHP dependencies
composer update

# 3. Create environment file
cp .env.example .env

# 4. Configure your .env
# Set DB_DATABASE, DB_USERNAME, DB_PASSWORD
# Set STRIPE_SECRET_KEY (from Stripe Dashboard)
# Set MAIL_* credentials

# 5. Generate application key
php artisan key:generate

# 6. Import the database
mysql -u root -p gacanovic_academy < gacanovic_academy.sql

# 7. Link storage (for uploaded images)
php artisan storage:link

# 8. Start the development server
php artisan serve

# 9. Visit the application
# → http://127.0.0.1:8000
```

**For Stripe webhooks (local testing):**
```bash
# Install Stripe CLI, then:
stripe login
stripe listen --forward-to 127.0.0.1:8000/webhook
```

---

## 🔑 Demo Credentials

| Role | Username | Password |
|---|---|---|
| 🛡️ Admin | `Admin08` | `admin007` |
| 🎓 Instructor | `milica93` | *(see DB)* |
| 📚 Student | `jovana91` | *(see DB)* |

> 💳 **Stripe test card:** `4242 4242 4242 4242` - any future expiry, any CVC

---

## 📁 Project Structure Overview

```
gacanovic_academy/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin CRUD controllers
│   │   │   ├── AuthController
│   │   │   ├── CartController
│   │   │   ├── CheckoutController
│   │   │   ├── ContactController
│   │   │   ├── FrontController
│   │   │   ├── InstructorController
│   │   │   ├── LessonController
│   │   │   └── WishController
│   │   ├── Middleware/          # 4 custom middlewares
│   │   ├── Requests/            # 11 form request classes
│   │   └── Services/            # Helper, ImageHelper, Logs, UserService
│   └── Models/                  # 12 Eloquent/DB models
│
├── resources/views/
│   ├── components/              # Reusable form components (admin + instructor)
│   ├── email/                   # Contact email Blade template
│   ├── fixed/                   # Shared layouts (header, footer, sidebar)
│   ├── layout/                  # Admin, instructor, user layouts
│   └── pages/                   # All page views
│       ├── admin/
│       ├── instructor/
│       └── user/
│
├── public/
│   ├── js/                      # main.js, cart.js, wish.js, contact.js
│   ├── css/                     # Bootstrap, AdminLTE, custom styles
│   └── img/                     # Course and category images
│
├── routes/
│   └── web.php                  # All application routes
│
├── gacanovic_academy.sql        # Full database dump
└── composer.json
```

---

## 📸 Pages Overview

| Page | Key UI Elements |
|---|---|
| **Home** | Dynamic category cards with lowest prices per category |
| **Courses** | Filter sidebar (topics/categories), sort, search, pagination, course cards |
| **Single Course** | Course image, details, add to cart/wishlist, already-bought check |
| **Cart** | AJAX-rendered table from LocalStorage, Stripe checkout button |
| **Wishlist** | AJAX-rendered table, remove button, badge count in header |
| **Learnings** | Purchased courses with lesson links, order date, author info |
| **Login/Register** | Tabbed panel, AJAX registration, server-side login |
| **Instructor** | Poll → become instructor → course create/edit/delete dashboard |
| **Admin Logs** | Laravel Log Viewer with DataTables / filter by date, type, content |
| **Admin CRUD** | Split-panel: form on the left, AJAX table on the right |
| **Checkout** | Stripe-hosted payment page - success/cancel redirect |

---

## 👨‍💻 Author

**Marko Gačanović** <br/>
ICT College of Vocational Studies, Belgrade <br/>
Index: 38/17 <br/>
Final thesis project, 2023.

---

## 📚 References

- [Stripe Checkout Documentation](https://stripe.com/docs/payments/checkout/how-checkout-works)
- [Laravel Documentation](https://laravel.com/)
- [Stack Overflow](https://stackoverflow.com/)
- Dr Nenad Kojić, Milena Vesić - *WEB Programiranje*, Beograd 2016.

---

<div align="center">

Made with ❤️ using Laravel 8

</div>
