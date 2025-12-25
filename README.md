# 🏘️ Society Management System

A complete **Society Management System** built using **PHP, MySQL, Bootstrap, JavaScript, and AJAX**.
This project helps manage society members, zones, cities, memberships, approvals, and role-based dashboards (Admin, Accountant, User) through a centralized web platform.

---

## 🚀 Features

### 👤 User Module

* User registration & login
* Profile view with photo
* Edit **password only** (secure update)
* Membership request status (Pending / Approved)
* Zone & City assignment
* Responsive user dashboard

### 🛠️ Admin Module

* Approve / reject member requests
* Manage members
* Manage zones & cities
* View all registered users
* Role-based access control
* Secure session handling

### 📊 Accountant Module

* Limited access dashboard
* View member data
* Financial / record-based operations (extendable)
* Restricted admin privileges

### 🔍 Advanced Filtering

* Filter members by:

  * Zone
  * City
  * Marital Status
* Dynamic **zone → city dependent dropdown**
* DataTables integration (search, pagination, sorting)

---

## 🧰 Tech Stack

* **Backend:** PHP (Procedural)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **JavaScript:** jQuery, AJAX
* **Plugins/Libraries:**

  * DataTables
  * Bootstrap Icons
  * AOS Animations



## 🔐 Authentication & Roles

| Role       | Access Level         |
| ---------- | -------------------- |
| Admin      | Full Access          |
| Accountant | Limited Access       |
| User       | Profile & Membership |

Role validation example:

```php
if(isset($_SESSION["uname"]) && in_array($_SESSION["utype"], ['admin','accountant'])){
    // access allowed
}
```

---



## ⚙️ Installation Steps

1. Clone the repository:

```bash
git clone https://github.com/your-username/Society-Management-System.git
```

2. Import database:

* Open **phpMyAdmin**
* Create a database
* Import `.sql` file

3. Update database connection:

```php
$con = mysqli_connect("localhost","root","","database_name");
```

4. Run project:

```
http://localhost/Society-Management-System
```

---

## 🔒 Security Highlights

* Session-based authentication
* Password change with confirmation
* Email & phone uniqueness checks
* SQL joins with controlled access
* Role-based UI restrictions

---

## 📌 Future Enhancements

* Payment integration
* Notifications (email / SMS)
* Reports & analytics
* Member ID card PDF export
* API integration

---

## 👨‍💻 Developer

**Vishal**
🔗 GitHub: [vishal21803](https://github.com/vishal21803)
🌐 Live Demo: [https://vsociety.kesug.com/](https://vsociety.kesug.com/)

---

## 📄 License

This project is for **learning & personal use**.
You are free to modify and enhance it.


