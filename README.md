🎓 Gačanović Academy <br/>
Gačanović Academy is a full-featured web application built with the Laravel framework, designed for the presentation, purchase, and management of online e-courses across various categories and topics. <br/>
The platform supports three user roles — Admin, Instructor, and Student — each with distinct permissions and features.

📄 Documentation and Database: <br/>
📘 Full Project Documentation (PDF) - https://github.com/MarkoG111/gacanovic_academy/blob/master/public/Dokument.pdf <br/>
🗄️ Database SQL File - https://github.com/MarkoG111/gacanovic_academy/blob/master/gacanovic_academy.sql

🧩 Key Features:<br/>
👨‍🎓 For Students<br/>
Browse all available e-courses by category, topic, or price <br/>
Add courses to wishlist or cart (AJAX + LocalStorage) <br/>
Secure checkout via Stripe integration <br/>
View purchased courses and lessons in the Learnings section <br/>
Contact admin through a built-in Contact Form <br/>

👨‍🏫 For Instructors <br/>
Become an instructor by answering a survey question <br/>
Create and edit personal e-courses (with multiple lessons and topics) <br/>
Manage uploaded courses using dynamic AJAX tables and pagination <br/>

🛠️ For Admins <br/>
Manage users, categories, topics, and courses <br/>
View and delete contact messages <br/>
Access full order history <br/>
Review system logs with filters and pagination <br/>

💳 Stripe Payment Flow <br/>
The user adds courses to the cart <br/>
A Stripe checkout session is created on the server <br/>
The user completes payment in test mode <br/>
The order status changes from unpaid → paid <br/>
Stripe webhooks ensure reliability (even if the connection fails) <br/>
The user is redirected to a success or cancel page <br/>
*Webhook route must be excluded from CSRF validation (/webhook) <br/>

⚙️ Technologies Used <br/>
<b>Frontend:</b> HTML5, CSS3, Bootstrap 4, JavaScript (AJAX, jQuery) <br/>
<b>Backend:</b> PHP 8.x (Laravel 8), MySQL, Stripe API (for payments) <br/>
<b>Development Tools:</b> Visual Studio Code, phpMyAdmin, XAMPP <br/>

🔐 Admin Credentials (for demo): <br/>
Username: Admin08 <br/>
Password: admin007

🧰 Installation & Setup <br/>
<b>Clone the repository:</b> git clone https://github.com/MarkoG111/Academy-Gacanovic.git <br/>
<b>Install dependencies:</b> composer install || composer update <br/>
<b>Create a .env file:</b> cp .env.example .env <br/>
<b>Configure database credentials and Stripe keys in .env</b> <br/>
<b>Import the SQL database:</b> mysql -u root -p gacanovic_academy < gacanovic_academy.sql <br/>
<b>Generate an application key:</b> php artisan key:generate <br/>
<b>Run the development server:</b> php artisan serve <br/>
    
<b>Then visit:</b>
👉 http://localhost:8000
