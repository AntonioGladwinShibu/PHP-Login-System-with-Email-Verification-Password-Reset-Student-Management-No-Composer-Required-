🎯 PHP Login System with Email Verification, Password Reset & Student Management (No Composer Required)
A complete, mobile-friendly PHP authentication and student management system with secure login, registration, email verification (token-based), and password reset functionality using PHPMailer — all without using Composer. Also includes a student detail module with image uploads and profile viewing.

📌 Features
✅ User registration with token-based email verification
✅ Login using email, name, or mobile
✅ Forgot password with favorite color verification
✅ Send reset link via email (PHPMailer without Composer)
✅ Secure session-based dashboard
✅ Student registration with image upload
✅ Student listing and profile view (with images)
✅ Auto-export selected student data to Excel
✅ Responsive, elegant red-white UI with inline styling
✅ Built using pure PHP and PDO with MySQL

📁 Key Files
register.php → User registration with email token
login.php → Multi-method login page
logout.php → Logout user session
welcome.php → Dashboard with welcome message and background
forgot_password.php → Forgot password form
send_reset_link.php → Verifies favorite color, sends reset email
reset_password.php → Validates token and sets new password
update_password.php → Updates password in DB
student.php → Student registration form with image upload
list_students.php → Student list (name, age, contact as links)
detail.php → View full student profile
export.php → Exports name, age, contact to Excel (PhpSpreadsheet)
config.php → DB connection (PDO)
reon-logo.jpg.jpg → Logo background
README.md → This file

🧰 Tech Stack
Frontend: HTML5, CSS3 (Red & white themed UI)
Backend: Core PHP (No frameworks)
Database: MySQL (user_portal)
Email: PHPMailer (manually included)
Excel: PhpSpreadsheet (manually included, no Composer)

🚀 How to Use

Clone the repo:
git clone https://github.com/AntonioGladwinShibu/PHP-Login-System-with-Email-Verification-Password-Reset-Student-Management-No-Composer-Required-.git

Import the MySQL database (user_portal) and create required tables

Update DB settings in config.php

Place project in htdocs (XAMPP) or www (WAMP)

Start Apache/MySQL and visit:
http://localhost/[folder-name]/register.php

Register, verify via email, and explore all modules

🧩 Optional Enhancements
🔐 Add role-based dashboards (admin/user)
📊 Add student analytics chart
🌙 Dark mode toggle
📧 Add email notification on student registration
📂 Filter/sort student data on dashboard

👨‍💻 Author
Antonio Gladwin Shibu
GitHub: https://github.com/AntonioGladwinShibu
Email: antoniogladwinshibu29@gmail.com
