# Helpdesk Plus

Sistem Manajemen Tiket IT Support berbasis web yang dibangun menggunakan Laravel. Aplikasi ini dirancang untuk memudahkan pengelolaan tiket dukungan teknis dengan sistem role-based authentication untuk Administrator dan Employee.

## 📋 Fitur

### Autentikasi & Manajemen Akses
- **Login & Logout**: Sistem autentikasi berbasis session
- **Registrasi**: Pendaftaran akun employee baru dengan auto-generate Employee ID
- **Role-Based Access**: Dua role utama (Administrator dan User/Employee)

### Dashboard
- **Dashboard Admin**: Statistik lengkap meliputi jumlah employee, kategori, tiket aktif/arsip, dan distribusi status tiket (Open, In Progress, Resolved, Closed)
- **Dashboard User**: Statistik tiket personal, notifikasi status tiket, dan ringkasan aktivitas

### Manajemen Tiket (Core Feature)
- **Pembuatan Tiket**: Form lengkap dengan kategori, judul, prioritas (Low/Medium/High/Critical), deskripsi, dan attachment
- **Auto-Generate Ticket Code**: Format HD-YYYYMMDDHHmmss untuk tracking mudah
- **Upload Attachment**: Support berbagai format file (JPG, JPEG, PNG, PDF, DOC, DOCX) maksimal 2MB
- **Status Management**: Alur status tiket (Open → In Progress → Resolved → Closed)
- **Arsip Tiket**: Sistem pengarsipan tiket yang sudah selesai
- **Search & Filter**: Pencarian berdasarkan ticket code, judul, kategori, prioritas, dan status
- **Pagination**: Tampilan data dengan pagination (5 item per halaman)
- **Notifikasi Real-time**: Notifikasi otomatis saat status tiket berubah

### Manajemen Employee (Admin Only)
- **CRUD Employee**: Tambah, edit, lihat, dan hapus data employee
- **Data Lengkap**: Employee ID, nama, email, department, nomor telepon, dan password
- **List Employee**: Tampilan daftar semua employee terdaftar

### Manajemen Kategori (Admin Only)
- **CRUD Kategori**: Pengelolaan kategori tiket (Hardware, Software, Network, dll)
- **Validasi Unique**: Mencegah duplikasi nama kategori

### Profile Management (User)
- **Update Profile**: Edit nama, email, nomor telepon, dan password
- **Upload Foto Profil**: Fitur unggah dan ganti foto profil
- **Auto Delete**: Hapus foto lama otomatis saat upload foto baru

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel**: Framework PHP versi 12.x
- **PHP**: Versi 8.2 atau lebih tinggi

### Frontend
- **Blade Template Engine**: Templating Laravel
- **Tailwind CSS**: Framework CSS versi 4.0
- **Vite**: Build tool versi 7.0 untuk asset bundling
- **Axios**: HTTP client untuk request AJAX

### Database
- **SQLite**: Database default (bisa diganti dengan MySQL/PostgreSQL)
- **Query Builder**: Menggunakan DB Facade Laravel untuk query database

### Development Tools
- **Laravel Tinker**: REPL untuk testing
- **Laravel Pail**: Log viewer
- **Concurrently**: Menjalankan multiple commands secara parallel

## 📁 Struktur Project

```
helpdesk-plus/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminController.php      # Dashboard admin & statistik
│   │       ├── AuthController.php       # Login, logout, register
│   │       ├── CategoryController.php   # CRUD kategori
│   │       ├── ProfileController.php    # Manajemen profil user
│   │       ├── TicketController.php     # Core ticket management
│   │       └── UserController.php       # CRUD employee & dashboard user
│   │
│   └── Models/
│       └── User.php                     # Model User (Eloquent)
│
├── bootstrap/
│   └── app.php                          # Bootstrap aplikasi Laravel
│
├── config/                              # File konfigurasi aplikasi
│   ├── app.php                          # Config utama aplikasi
│   ├── database.php                     # Config koneksi database
│   └── ...
│
├── database/
│   ├── migrations/                      # File migrasi database
│   ├── seeders/                         # Database seeder
│   └── database.sqlite                  # File database SQLite
│
├── public/
│   ├── uploads/                         # Folder upload attachment tiket
│   ├── profile/                         # Folder upload foto profil
│   └── index.php                        # Entry point aplikasi
│
├── resources/
│   ├── css/
│   │   └── app.css                      # File CSS utama (Tailwind)
│   │
│   ├── js/
│   │   ├── app.js                       # JavaScript utama
│   │   └── bootstrap.js                 # Bootstrap JS (Axios config)
│   │
│   └── views/                           # Blade templates
│       ├── admin/                       # Views untuk admin
│       │   ├── dashboard.blade.php
│       │   ├── category/                # CRUD kategori
│       │   ├── ticket/                  # Manajemen tiket admin
│       │   └── user/                    # CRUD employee
│       │
│       ├── auth/                        # Views autentikasi
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       │
│       ├── layouts/                     # Layout templates
│       │   ├── admin.blade.php          # Layout admin
│       │   └── user.blade.php           # Layout user
│       │
│       └── user/                        # Views untuk employee
│           ├── dashboard.blade.php
│           ├── profile/                 # Manajemen profil
│           └── ticket/                  # Manajemen tiket user
│
├── routes/
│   └── web.php                          # Definisi semua route aplikasi
│
├── storage/                             # File storage (logs, cache, dll)
│
├── .env                                 # Environment variables (JANGAN commit!)
├── .env.example                         # Template environment variables
├── composer.json                        # Dependencies PHP (Laravel packages)
├── package.json                         # Dependencies Node.js (Vite, Tailwind)
├── vite.config.js                       # Konfigurasi Vite
└── artisan                              # CLI tool Laravel
```

## 🚀 Cara Menjalankan Project

### Prasyarat
Pastikan sudah terinstall:
- **PHP** >= 8.2
- **Composer**
- **Node.js** & **NPM**
- **Git**

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd helpdesk-plus
   ```

2. **Install Dependencies PHP**
   ```bash
   composer install
   ```

3. **Install Dependencies Node.js**
   ```bash
   npm install
   ```

4. **Copy File Environment**
   ```bash
   copy .env.example .env
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Buat Database SQLite** (jika belum ada)
   ```bash
   type nul > database\database.sqlite
   ```

7. **Jalankan Migrasi Database**
   ```bash
   php artisan migrate
   ```
   
   **⚠️ Catatan Penting**: Project ini belum memiliki migration files untuk tabel `tickets`, `categories`, dan field tambahan pada tabel `users` (employee_id, department, phone, role, profile_photo). Anda perlu membuat migration tersebut secara manual atau menggunakan database yang sudah ada.

8. **Jalankan Development Server**

   **Opsi 1: Menjalankan secara manual**
   ```bash
   # Terminal 1 - Laravel Server
   php artisan serve

   # Terminal 2 - Vite Dev Server
   npm run dev
   ```

   **Opsi 2: Menjalankan dengan Composer Script** (recommended)
   ```bash
   composer run dev
   ```
   Script ini akan menjalankan secara bersamaan: Laravel server, queue listener, log viewer, dan Vite dev server.

9. **Akses Aplikasi**
   - Buka browser dan akses: `http://localhost:8000`
   - Login dengan akun yang sudah dibuat melalui halaman register

### Build untuk Production

```bash
# Build assets
npm run build

# Jalankan server production
php artisan serve --env=production
```

## 📝 Catatan

- **Database Migrations**: Project ini masih memerlukan migration files untuk tabel `tickets`, `categories`, dan modifikasi tabel `users`. Implementasi saat ini menggunakan database yang sudah ada atau perlu dibuat manual.

- **Password Storage**: Saat ini password disimpan dalam **plain text** (tidak di-hash). Untuk production, sangat disarankan menggunakan `Hash::make()` saat menyimpan dan `Hash::check()` saat validasi.

- **Session-based Authentication**: Aplikasi menggunakan session manual, bukan Laravel Auth Facade. Untuk scalability yang lebih baik, pertimbangkan menggunakan Laravel Sanctum atau Passport.

- **File Upload Security**: Path upload saat ini berada di folder public. Pertimbangkan untuk memindahkan ke storage dan menggunakan symbolic link.

- **Role Middleware**: Belum ada middleware untuk proteksi route berdasarkan role. Saat ini hanya mengandalkan session checking.

- **Project Purpose**: Aplikasi ini dibuat untuk keperluan **pembelajaran dan portfolio**. Belum production-ready dan memerlukan beberapa enhancement untuk keamanan dan best practices.

## 💡 Hal yang Dipelajari

Selama pengembangan project ini, beberapa konsep yang dipelajari:

1. **Laravel Framework Fundamentals**
   - Routing & Controller pattern
   - Blade templating engine
   - Database Query Builder
   - Request validation
   - Session management

2. **CRUD Operations**
   - Create, Read, Update, Delete untuk berbagai entitas
   - Form handling dan validasi
   - Flash messages untuk user feedback

3. **File Upload Management**
   - Validasi file upload (type, size)
   - Menyimpan file ke server
   - Delete file lama saat update

4. **Search & Filter Implementation**
   - Dynamic query building
   - Multiple search parameters
   - Pagination dengan query string

5. **Role-Based Access**
   - Pemisahan akses admin dan user
   - Session-based authentication
   - Conditional view rendering

6. **Database Design**
   - Relational database structure
   - Foreign key relationships
   - Data normalization

7. **Frontend Integration**
   - Tailwind CSS untuk styling
   - Responsive design
   - Vite untuk asset bundling
   - Component-based layout

8. **Notification System**
   - Real-time status update notification
   - Session flash messages
   - User feedback implementation

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan portfolio. Anda bebas menggunakan, memodifikasi, dan mendistribusikan kode ini untuk keperluan non-komersial dengan tetap mencantumkan credit kepada pembuat asli.

---

**Disclaimer**: Aplikasi ini masih dalam tahap development dan belum dioptimalkan untuk environment production. Gunakan dengan risiko Anda sendiri dan pastikan melakukan security hardening sebelum deployment ke production.
