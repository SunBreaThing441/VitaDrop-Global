# VitaDrop Global: A UNESCO Humanitarian Blood Initiative

<div align="center">

![VitaDrop Global Protocol](https://img.shields.io/badge/UNESCO_Protocol-14--B_Active-0077D4?style=for-the-badge&logo=shield)
![Laravel](https://img.shields.io/badge/Laravel_10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS_3.3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js_3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)
![Vite](https://img.shields.io/badge/Vite_4.3-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)

**A decentralized, real-time humanitarian blood telemetry protocol and volunteer donor mobilization platform.**

[Live Portal (Port 8000)](http://127.0.0.1:8000/) • [Vite HMR (Port 5173)](http://localhost:5173/) • [Architecture Workflows](workflows/README.md) • [QA Audit Report](workflows/qa-code-review-report.md)

</div>

---

## 🩸 Overview

**VitaDrop Global** is a modernized presentation-tier overhaul of the Laravel Blood Donation Portal. Operating under international humanitarian directives (UNESCO Protocol 14-B), VitaDrop Global replaces legacy Bootstrap/Corona themes with an ultra-modern, glassmorphic, telemetry-driven UI architecture while maintaining 100% compatibility with untouched Laravel 10 backend controllers, Fortify authentication, and the MariaDB database schema.

### Core Value Propositions
- **Instant Life Support Dispatch**: One-tap emergency peer-to-peer mobilization via direct `tel:` dialing and preformatted WhatsApp dispatch routing.
- **Real-Time Client-Side Registry Filtering**: Alpine.js-powered instant search by donor name, city, hospital sector, and clinical blood classification pills (O-, O+, A-, A+, B-, B+, AB-, AB+).
- **Strict Role-Based Security**: Jetstream/Fortify session cookie authentication with `@csrf` mechanics, separating verified Volunteer Donors (`usertype: 0`) from Health Coordinators (`usertype: 1`).
- **High-Tech Clinical Command Center**: Responsive health coordinator dashboard for rapid emergency donor intake and live public registry synchronization.

---

## 🎨 Design System & Palette

VitaDrop Global implements a futuristic, high-contrast, sterile-clean aesthetic tailored for mission-critical health systems:

| Design Token | Hex Code | Purpose |
| :--- | :--- | :--- |
| **UNESCO Blue** | `#0077D4` | Primary brand authority, interactive primary buttons, telemetry badges, and links |
| **Vitality Crimson** | `#E63946` | Blood indicators, emergency status rings, critical alerts, and intake triggers |
| **Cosmic Dark** | `#030712` / `#0B1120` | Telemetry header ribbons, command docks, and high-contrast footers |
| **Glassmorphism** | `rgba(255, 255, 255, 0.85)` | Frosted glass containers (`backdrop-blur-xl`, `border-white/80`, `shadow-xl`) |
| **Sterile Surface** | `#F8FAFC` to `#F1F5F9` | Subtle radial gradient mesh backdrop for medical clarity |

---

## 🏗️ Architecture & Component Hierarchy

```
blooddonation/
├── app/
│   ├── Actions/Fortify/               # Untouched Fortify user creation pipelines
│   ├── Http/Controllers/
│   │   ├── HomeController.php         # Untouched: index() & redirect() role router
│   │   └── AdminController.php        # Untouched: addview() & upload() multipart file handler
│   └── Models/
│       ├── Donor.php                  # Eloquent model for 'donors' table
│       └── User.php                   # Authenticatable Jetstream User model
├── public/
│   ├── build/                         # Vite compiled production assets (CSS/JS)
│   └── donorphotos/                   # Publicly served donor identification headshots
├── resources/
│   ├── css/app.css                    # Tailwind layers, glassmorphism, pulse radars
│   ├── js/app.js                      # Alpine.js core initialization
│   └── views/
│       ├── admin/                     # Health Operations Command Center
│       │   ├── add_donor.blade.php    # Intake form with drag-and-drop preview & multipart POST
│       │   ├── home.blade.php         # Coordinator metrics deck & SLA monitoring
│       │   ├── navbar.blade.php       # Operational telemetry topbar
│       │   └── sidebar.blade.php      # Responsive administrative dock
│       ├── auth/                      # Fortify Identity Gateways
│       │   ├── login.blade.php        # Glassmorphic login with password toggle
│       │   └── register.blade.php     # Donor intake with phone and sector validation
│       ├── components/                # Reusable Blade / Alpine Components
│       │   ├── flash-toast.blade.php  # Auto-dismissing 5s progress bar toast
│       │   └── vitadrop-logo.blade.php# UNESCO Blood Protocol vector insignia
│       ├── layouts/                   # Modern Blade Shells (app.blade.php, guest.blade.php)
│       └── user/                      # Public Life Support Portal
│           ├── home.blade.php         # Animated hero, ECG telemetry, mission statistics
│           └── donors.blade.php       # Alpine.js instant-filter emergency donor card grid
├── routes/
│   └── web.php                        # Untouched Laravel 10 route definitions
└── workflows/                         # Architectural workflow specifications
    ├── README.md                      # System Master Architecture Index
    ├── frontend-workflow.md           # Blade, Vite, Tailwind & Alpine UI Architecture
    ├── backend-workflow.md            # Controller Data Flows & Fortify Auth Pipelines
    ├── database-workflow.md           # MariaDB Schema, Indexing & Storage Engine
    ├── system-integration-workflow.md # End-to-End Data Lifecycle & Security
    └── qa-code-review-report.md       # Comprehensive Virtual QA Audit & Bug-Fix Report
```

---

## ⚡ Quick Start & Installation

### Prerequisites
- **PHP** $\ge$ 8.1 (PHP 8.2 or 8.3 recommended) with extensions: `pdo_mysql`, `mbstring`, `fileinfo`, `gd`, `openssl`
- **Node.js** $\ge$ 18.x and **npm**
- **Composer** $\ge$ 2.x
- **MariaDB / MySQL** $\ge$ 10.4 running on Port 3306

### 1. Clone & Enter Repository
```bash
git clone https://github.com/SunBreaThing441/VitaDrop-Global.git
cd VitaDrop-Global
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Frontend dependencies
npm install
```

### 3. Environment & Database Configuration
Configure your `.env` file with database credentials:
```env
APP_NAME="VitaDrop Global"
APP_ENV=local
APP_KEY=base64:your_generated_app_key
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blooddonation
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
```

Run database migrations to initialize tables (including `users`, `donors`, `sessions`, `failed_jobs`):
```bash
php artisan migrate
```

### 4. Create Donor Photos Directory Link (Windows Junction / Linux Symlink)
Because `AdminController@upload` executes `$request->file->move('donorphotos', $photoname)`, create a directory link ensuring uploaded files immediately serve from `public/donorphotos/`:

**On Windows (Command Prompt as Admin or PowerShell):**
```cmd
mklink /J donorphotos public\donorphotos
```

**On Linux / macOS:**
```bash
ln -s public/donorphotos donorphotos
```

### 5. Run Development Servers

**Terminal 1 — Laravel Backend Server:**
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

**Terminal 2 — Vite Frontend Dev Server:**
```bash
npm run dev
```

Visit **[http://127.0.0.1:8000](http://127.0.0.1:8000)** in your browser.

---

## 🔒 Security & Role Routing

The application strictly implements role-based privilege isolation via `HomeController@redirect`:

- **Unauthenticated Visitors**: Can explore the live emergency donor grid, execute client-side blood group filters, and initiate direct phone / WhatsApp communications.
- **Volunteer Donors (`usertype: 0`)**: Access the Volunteer Hub, update availability profile credentials, and configure Two-Factor Authentication (2FA). Restricted from coordinator intake.
- **Health Coordinators (`usertype: 1`)**: Granted full access to the Command Center (`/home`) and Emergency Donor Intake (`/add_donor_view`).

All session terminations require a secure `POST /logout` with valid `@csrf` tokens.

---

## 🧪 Testing & Verification

A comprehensive automated QA audit has been performed on the codebase:
- **Zero console warnings & zero Blade parsing collisions**: Native HTML `onerror` fallbacks and native Blade `{{-- --}}` comments.
- **Multipart Stream Persistence**: Verified end-to-end multipart POST to `/upload_donor`, file movement to `public/donorphotos`, MariaDB persistence, and instant rendering on the public grid.
- **Production Asset Compilation**: `npm run build` bundles assets in ~1.3s producing clean, minified production assets in `public/build/`.

Review the complete [QA Code Review Report](workflows/qa-code-review-report.md) for full audit metrics.

---

## 📄 License & Credits

- **Initiative**: VitaDrop Global — UNESCO Humanitarian Blood Initiative
- **Framework**: [Laravel](https://laravel.com) by Taylor Otwell & Contributors
- **License**: Open Source under the [MIT License](LICENSE)
