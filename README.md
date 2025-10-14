🎓 Gačanović Academy

Gačanović Academy is a full-featured web application built with the Laravel framework, designed for the presentation, purchase, and management of online e-courses across various categories and topics.
The platform supports three user roles — Admin, Instructor, and Student — each with distinct permissions and features.

📄 Documentation and Database:
📘 Full Project Documentation (PDF)
🗄️ Database SQL File

🧩 Key Features:
👨‍🎓 For Students
Browse all available e-courses by category, topic, or price
Add courses to wishlist or cart (AJAX + LocalStorage)
Secure checkout via Stripe integration
View purchased courses and lessons in the Learnings section
Contact admin through a built-in Contact Form

👨‍🏫 For Instructors
Become an instructor by answering a survey question
Create and edit personal e-courses (with multiple lessons and topics)
Manage uploaded courses using dynamic AJAX tables and pagination

🛠️ For Admins
Manage users, categories, topics, and courses
View and delete contact messages
Access full order history
Review system logs with filters and pagination

💳 Stripe Payment Flow
The user adds courses to the cart
A Stripe checkout session is created on the server
The user completes payment in test mode
The order status changes from unpaid → paid
Stripe webhooks ensure reliability (even if the connection fails)
The user is redirected to a success or cancel page
*Webhook route must be excluded from CSRF validation (/webhook)

⚙️ Technologies Used
Frontend:
HTML5, CSS3, Bootstrap 4
JavaScript (AJAX, jQuery)

Backend:
PHP 8.x (Laravel 8)
MySQL
Stripe API (for payments)

Development Tools:
Visual Studio Code
phpMyAdmin
XAMPP

🔐 Admin Credentials (for demo):
Username: Admin08
Password: admin007

🧰 Installation & Setup
Clone the repository: git clone https://github.com/MarkoG111/Academy-Gacanovic.git
Install dependencies: composer install || composer update
Create a .env file: cp .env.example .env
Configure database credentials and Stripe keys in .env
Import the SQL database: mysql -u root -p gacanovic_academy < gacanovic_academy.sql
Generate an application key: php artisan key:generate
Run the development server: php artisan serve
    
Then visit:
👉 http://localhost:8000
