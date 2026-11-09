# 🔄 System Integration and End-to-End Workflows

This document integrates the frontend, backend, and database components into cohesive end-to-end workflow diagrams, showing the exact lifecycle of data and control flow across the entire Blood Donation Portal.

---

## 1. System Integration Overview

The system operates across four coordinated runtime boundaries:

```mermaid
graph LR
    subgraph ClientLayer["1. Client Tier"]
        Browser["User / Admin Browser"]
    end

    subgraph PresentationLayer["2. Presentation & Asset Tier"]
        ViteDev["Vite Dev Server (Port 5173)"]
        BladeEngine["Blade Templating Engine"]
    end

    subgraph LogicLayer["3. Business Logic Tier"]
        LaravelServer["Artisan HTTP Server (Port 8000)"]
        Controllers["Controllers (Home, Admin, Fortify)"]
    end

    subgraph DataLayer["4. Persistence & Storage Tier"]
        MariaDB[("MariaDB Database (Port 3306)")]
        LocalDisk[("File System (donorphotos)")]
    end

    Browser <-->|HTTP / HTML / JSON| LaravelServer
    Browser <-->|Hot Module Replacement| ViteDev
    LaravelServer --> BladeEngine
    LaravelServer --> Controllers
    Controllers <-->|SQL Queries via Eloquent| MariaDB
    Controllers <-->|File Upload Operations| LocalDisk
```

---

## 2. End-to-End Sequence Diagrams

### 2.1 Workflow 1: Public Visitor Homepage & Donor Listing

```mermaid
sequenceDiagram
    autonumber
    actor Visitor as Public Visitor
    participant Browser as Client Browser
    participant Router as Laravel Router (web.php)
    participant HomeCtrl as HomeController@index
    participant Model as Donor Model
    participant DB as MariaDB (blooddonation)
    participant Blade as Blade Engine (user.home)
    participant Disk as Local Assets & donorphotos

    Visitor->>Browser: Enters http://127.0.0.1:8000/
    Browser->>Router: GET /
    Router->>HomeCtrl: index()
    HomeCtrl->>HomeCtrl: Check Auth::id() -> null (Guest)
    HomeCtrl->>Model: Donor::all()
    Model->>DB: SELECT * FROM `donors`
    DB-->>Model: Returns collection of donor rows
    Model-->>HomeCtrl: Eloquent Collection ($donors)
    HomeCtrl->>Blade: view('user.home', compact('donors'))
    Blade->>Blade: Evaluates @include('user.donors')
    Blade->>Disk: Pulls CSS/JS from public/assets/
    Blade->>Disk: Resolves image paths: donorphotos/{photo}
    Blade-->>Browser: Full HTML5 document with donor cards & contact buttons
    Browser-->>Visitor: Displays interactive home portal with donors
```

---

### 2.2 Workflow 2: User Registration & Role-Based Redirection

```mermaid
sequenceDiagram
    autonumber
    actor User as New User
    participant Browser as Browser
    participant Fortify as Fortify (RegisteredUserController)
    participant DB as MariaDB (users table)
    participant Session as MariaDB (sessions table)
    participant HomeCtrl as HomeController@redirect

    User->>Browser: Fills Register Form (/register)
    Browser->>Fortify: POST /register (name, email, password, password_confirmation)
    Fortify->>Fortify: Validates password rules & unique email check
    Fortify->>DB: INSERT INTO `users` (name, email, password, usertype='0')
    DB-->>Fortify: User record created
    Fortify->>Session: Create authenticated session for user ID
    Fortify-->>Browser: Redirects to /home
    Browser->>HomeCtrl: GET /home
    HomeCtrl->>HomeCtrl: Auth::id() is valid
    HomeCtrl->>HomeCtrl: Evaluate Auth::user()->usertype == '0'
    Note over HomeCtrl: User type '0' is regular user
    HomeCtrl-->>Browser: Returns view('user.home')
    Browser-->>User: Displays user home portal with personalized session
```

---

### 2.3 Workflow 3: Administrator Donor Registration with Image Upload

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Browser as Admin Browser
    participant AdminCtrl as AdminController
    participant Disk as public/donorphotos
    participant DB as MariaDB (donors table)
    participant Session as Session Store

    Admin->>Browser: Navigates to /add_donor_view
    Browser->>AdminCtrl: GET /add_donor_view
    AdminCtrl-->>Browser: Renders admin.add_donor form
    Admin->>Browser: Fills name, phone, place, blood_group, selects image
    Admin->>Browser: Clicks "Submit"
    Browser->>AdminCtrl: POST /upload_donor (multipart form + CSRF token)
    
    AdminCtrl->>AdminCtrl: Extract $photo = $request->file('file')
    AdminCtrl->>AdminCtrl: Generate $photoname = time() . '.' . ext
    AdminCtrl->>Disk: $request->file->move('donorphotos', $photoname)
    Disk-->>AdminCtrl: Image saved successfully
    
    AdminCtrl->>DB: INSERT INTO `donors` (`name`, `number`, `place`, `blood_group`, `photo`) VALUES (...)
    DB-->>AdminCtrl: New Donor row created
    AdminCtrl->>Session: flash('message', 'Donor Added Successfully')
    AdminCtrl-->>Browser: Redirect back to /add_donor_view
    Browser-->>Admin: Displays green success alert: "Donor Added Successfully"
```

---

### 2.4 Workflow 4: Emergency Blood Request Interaction

```mermaid
sequenceDiagram
    autonumber
    actor Requester as Patient / Relative
    participant Browser as Mobile / Desktop Browser
    actor Donor as Registered Blood Donor

    Requester->>Browser: Visits http://127.0.0.1:8000/#donors
    Browser-->>Requester: Displays available donors filtered by location & blood group
    
    alt Option A: Direct Voice Call
        Requester->>Browser: Taps Phone Call icon (mai-call)
        Browser->>Browser: Triggers `tel:+91XXXXXXXXXX` scheme
        Browser-->>Requester: Opens device dialer with donor phone preloaded
        Requester->>Donor: Places telephone call to coordinate blood donation
    else Option B: WhatsApp Messaging
        Requester->>Browser: Taps WhatsApp icon (mai-logo-whatsapp)
        Browser->>Browser: Triggers `tel:` or `whatsapp:` handler
        Requester->>Donor: Initiates chat directly with donor
    end
```

---

## 3. Runtime Orchestration and Process Health

The application runs via three concurrently managed processes:

```mermaid
stateDiagram-v2
    [*] --> StartingServices
    
    state StartingServices {
        MySQL : Port 3306 (MariaDB Engine)
        Artisan : Port 8000 (Laravel PHP Server)
        Vite : Port 5173 (Node.js Dev Server)
    }

    StartingServices --> Operational : All Ports Listening

    state Operational {
        state "Incoming Web Traffic" as Traffic
        Traffic --> Artisan : HTTP GET / POST
        Artisan --> MySQL : SQL Query Execution
        Artisan --> Vite : Asset Resolution & Script Injection
    }

    Operational --> [*] : Server Shutdown
```

### Process Verification Checklist
- **MySQL Engine**: `Test-NetConnection -ComputerName 127.0.0.1 -Port 3306` (TCP Succeeded: `True`)
- **Laravel Backend**: `Invoke-WebRequest -Uri "http://127.0.0.1:8000/"` (Status: `200 OK`)
- **Vite Asset Server**: `Invoke-WebRequest -Uri "http://localhost:5173/@vite/client"` (Status: `200 OK`)
- **Uploaded Photos Directory**: `public/donorphotos` (Read/Write permitted)
