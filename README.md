# 📝 Task Management System (Laravel 11)

Task Management System adalah aplikasi berbasis Laravel 11 yang bertujuan untuk membantu pengguna mengelola tugas mereka dengan lebih efisien. Pengguna dapat membuat, mengedit, menghapus, dan menandai tugas sebagai selesai. Selain itu, mereka bisa menetapkan prioritas, deadline, dan kategori untuk setiap tugas.

## 🚀 Main Fitur
- ✅ Manajemen Pengguna (registrasi, login, dan manajemen profil)
- ✅ Manajemen tugas (tambah, edit, hapus, tandai selesai, dan filter)
- ✅ Pengingat (reminder tugas yang mendekati deadline)
- ✅ Dashboard (ringkasan tugas yang sedang berlangsung, selesai, dan overdue)

---

## 🛠️ Instalasi

### **1. Clone Repository**
```bash
git clone https://github.com/MSyaekhoni/task-management-system.git
cd repository
```

### **2. Install Dependensi**
```bash
composer install
```

### **3. Buat File `.env` dan Konfigurasi Database**
```bash
cp .env.example .env
```
Ubah konfigurasi database di file `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### **4. Generate APP_KEY**
```bash
php artisan key:generate
```

### **5. Jalankan Migrasi dan Seeder**
```bash
php artisan migrate --seed
```

### **6. Jalankan Aplikasi**
```bash
php artisan serve
```
Karena proyek menggunakan Vite untuk asset bundling, jalankan juga:
```bash
npm install
npm run dev
```
Akses aplikasi di browser:  
🔗 `http://127.0.0.1:8000`

---

## 👤 Akun Default (Seeder)
|Email                 | Password |
|----------------------|----------|
| admin@admin.com      | pass1234 |

---

## 📌 Teknologi yang Digunakan
- ⚡ Laravel 11
- ⚡ SQLite
- ⚡ Blade dan Tailwind CSS
- ⚡ Laravel Breeze
- ⚡ Laravel Task Scheduling
