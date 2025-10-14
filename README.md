# 🎓 Gačanović Academy 
Gačanović Academy is a full-featured web application built with the Laravel framework, designed for the presentation, purchase, and management of online e-courses across various categories and topics. <br/>
The platform supports three user roles — Admin, Instructor, and Student — each with distinct permissions and features.

🔗 Live demo: https://gacho-dev.rs/gacanovic-academy

📄 Documentation and Database: <br/>
📘 Full Project Documentation (PDF) - https://github.com/MarkoG111/gacanovic_academy/blob/master/public/Dokument.pdf <br/>
🗄️ Database SQL File - https://github.com/MarkoG111/gacanovic_academy/blob/master/gacanovic_academy.sql

---

## 🧩 Key Features:
### 👨‍🎓 For Students
- Browse all available e-courses by category, topic, or price
- Add courses to wishlist or cart (AJAX + LocalStorage) 
- Secure checkout via Stripe integration 
- View purchased courses and lessons in the Learnings section 
- Contact admin through a built-in Contact Form 

### 👨‍🏫 For Instructors
- Become an instructor by answering a survey question
- Create and edit personal e-courses (with multiple lessons and topics) 
- Manage uploaded courses using dynamic AJAX tables and pagination

### 🛠️ For Admins 
- Manage users, categories, topics, and courses 
- View and delete contact messages 
- Access full order history 
- Review system logs with filters and pagination 

---

## 💳 Stripe Payment Flow 
- The user adds courses to the cart
- A Stripe checkout session is created on the server 
- The user completes payment in test mode 
- The order status changes from unpaid → paid 
- Stripe webhooks ensure reliability (even if the connection fails)
The user is redirected to a success or cancel page
*Webhook route must be excluded from CSRF validation (/webhook) 

---

## ⚙️ Technologies Used 
- <b>Frontend:</b> HTML5, CSS3, Bootstrap 4, JavaScript (AJAX, jQuery) 
- <b>Backend:</b> PHP 8.x (Laravel 8), MySQL, Stripe API (for payments)
- <b>Development Tools:</b> Visual Studio Code, phpMyAdmin, XAMPP 

---

## 🔐 Admin Credentials (for demo): <br/>
Username: Admin08 <br/>
Password: admin007

---

## 🧰 Installation & Setup 
1. <b>Clone the repository:</b> 
```bash 
git clone https://github.com/MarkoG111/Academy-Gacanovic.git 
```
2. <b>Install dependencies:</b> composer install || composer update 
3. <b>Create a .env file:</b> cp .env.example .env 
4. <b>Configure database credentials and Stripe keys in .env</b> 
5. <b>Import the SQL database:</b> mysql -u root -p gacanovic_academy < gacanovic_academy.sql
6. <b>Generate an application key:</b> php artisan key:generate 
7. <b>Run the development server:</b> php artisan serve 
8. <b>Then visit:</b> 👉 http://localhost:8000
