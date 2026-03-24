# 🛒 E-Commerce Platform (Laravel + Yajra DataTables + Algolia)

A full-featured E-Commerce platform built with **Laravel**, featuring a custom admin dashboard powered by **Yajra DataTables**, blazing-fast search using **Algolia**, and secure online payments via **MyFatoorah**.

This project focuses on performance, scalability, and delivering a smooth user experience.

---

## 🚀 Features

### 👤 Authentication & Users

* User Registration & Login
* Secure authentication using Laravel
* Role & Permission system (Admin / Users)

---

### 🧑‍💼 Admin Dashboard (Custom + Yajra DataTables)

* Custom-built dashboard (without Filament)
* Integrated with **Yajra DataTables** for:

  * Server-side processing
  * Fast pagination & search
  * Sorting & filtering
* Manage:

  * Products
  * Categories
  * Orders
  * Users

---

### 🛍️ Products Management

* Full CRUD for products
* Product categories support
* Pricing system
* Image uploads
* Optimized product listing with server-side tables

---

### 🔎 Advanced Search (Algolia)

* Integrated with **Algolia Search**
* Features:

  * Ultra-fast search results
  * Typo-tolerant search
  * Real-time suggestions
* Indexed:

  * Products
  * Categories (optional)
* Improves user experience significantly

---

### 🛒 Cart System

* Add to cart functionality
* Session-based cart for guests
* Persistent cart for authenticated users

---

### 📦 Orders System

* Complete order lifecycle management:

  * Pending
  * Paid
  * Shipped
  * Delivered
  * Cancelled
* Uses **Database Transactions** لضمان consistency
* Order history for users

---

### 💳 Payment Integration (MyFatoorah)

* Integrated with **MyFatoorah Payment Gateway**
* Supports:

  * Online payments (cards, wallets)
* Secure payment flow
* Handles:

  * Payment success
  * Payment failure
  * Pending payments
* Includes callback & webhook handling

---

### ⚙️ Technical Highlights

* Built with Laravel MVC architecture
* Clean and maintainable code
* Server-side rendering using Blade
* Optimized queries using Eloquent
* Fast tables using **Yajra DataTables**
* Lightning-fast search powered by **Algolia**

---

## 🛠️ Tech Stack

* **Backend:** Laravel
* **Frontend:** Blade
* **Admin Dashboard:** Custom + Yajra DataTables
* **Database:** MySQL
* **Search Engine:** Algolia
* **Payment Gateway:** MyFatoorah
* **Tables Engine:** Yajra DataTables

---

## 📂 Project Structure Highlights

* `app/Http/Controllers` → Application logic
* `app/Models` → Eloquent models
* `resources/views` → Blade templates
* `routes/web.php` → Web routes
* `database/migrations` → Database schema

---

## 🔒 Security

* CSRF Protection
* Input validation
* Secure authentication system
* Payment verification (callbacks & webhooks)

---

## 📈 Future Improvements

* Add real-time notifications (WebSockets)
* Add advanced analytics dashboard
* Multi-language support
* Coupon & discount system
* Wishlist feature

---

## 🧑‍💻 Author

Developed by **Ahmed Abdelhamid**
Full Stack Laravel Developer 🚀

---

## 📄 License

This project is open-source and available under the MIT License.

---

