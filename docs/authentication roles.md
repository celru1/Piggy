
---

# 🔐 Custom Authentication and Role-Based Dashboards in FilamentPHP

## 📦 Step 1: Panel Installation

Install Filament panels:

```bash
php artisan filament:install --panels
```

Create a new panel called `boar-sync`:

```bash
php artisan make:filament-panel boar-sync
```

This creates:
`app/Providers/BoarSyncPanelProvider.php`

---

## ⚙️ Step 2: Customize the Panel

Edit the panel configuration in `BoarSyncPanelProvider.php`.

### 🔸 Remove default routing and pages

```php
// Remove the default path and page routing
->path('')
->pages([
    // We’re using custom pages, so this is empty
])
```

### 🔸 Add additional features

```php
->registration()                    // Enables user registration
->spa()                             // Enables single-page application behavior
->sidebarCollapsibleOnDesktop()     // Allows sidebar to be collapsible
```

---

## 🧭 Step 3: Create Role-Based Dashboards

### ✅ User Dashboard

```bash
php artisan make:filament-page Dashboard
```

In `app/Filament/Pages/Dashboard.php`:

```php
// This defines the blade view used
protected static string $view = 'filament.pages.dashboard';

// Restrict access to users only
public static function canAccess(): bool
{
    return auth()->check() && auth()->user()->role === 'user';
}
```

In `resources/views/filament/pages/dashboard.blade.php`:

```blade
<x-filament::page>
    <h1>Welcome to the User Dashboard</h1>
</x-filament::page>
```

---

### 🔐 Admin Dashboard

```bash
php artisan make:filament-page AdminDashboard
```

In `app/Filament/Pages/AdminDashboard.php`:

```php
// Set the URL path as /admin-dashboard
protected static ?string $slug = 'admin-dashboard';

// Only allow access if the logged-in user is an admin
public static function canAccess(): bool
{
    return auth()->user()?->role === 'admin';
}
```

In `resources/views/filament/pages/admin-dashboard.blade.php`:

```blade
<x-filament::page>
    <h1>Welcome to the Admin Dashboard</h1>
</x-filament::page>
```

---

## 🔁 Step 4: Custom Login Response

Create the login redirect logic:

### 📄 `app/Http/Responses/LoginResponse.php`

```php
<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Redirect the user after login based on their role.
     */
    public function toResponse($request)
    {
        $admin_url = 'admin-dashboard';   // Admin redirect path
        $user_url = 'dashboard';          // User redirect path
        $role = auth()->user()->role;     // Get the authenticated user's role

        // Redirect to respective dashboard
        return redirect()->intended($role === 'user' ? $user_url : $admin_url);
    }
}
```

---

## 🔌 Step 5: Bind Login Response in Service Provider

Edit `app/Providers/AppServiceProvider.php`:

```php
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;

public function register(): void
{
    // Override Filament’s default login response with our custom one
    $this->app->bind(LoginResponseContract::class, LoginResponse::class);
}
```

---

## 🗺️ Authentication Flow Diagram

```plaintext
+--------------------+
|  User submits form |
+--------------------+
           |
           v
+-------------------------+
|     Filament Auth       |
+-------------------------+
           |
           v
+---------------------------------+
| Check user role (LoginResponse) |
+---------------------------------+
       |                |
       |                |
       v                v
  +---------+       +-------------+
  | role:   |       | role:       |
  |  user   |       |   admin     |
  +----+----+       +------+------+
       |                   |
       v                   v
+---------------+    +---------------------+
| /dashboard    |    | /admin-dashboard    |
| User Dashboard|    | Admin Dashboard     |
+---------------+    +---------------------+
```

---
Excellent! Now that your middleware and panel setup is fully working and correctly configured, here's your **GitHub-flavored Markdown documentation** for this implementation — clean, detailed, and structured for your repo.

---

# 🔐 Role-Based Dashboard Redirection in Filament 

This guide explains how to implement **role-based dashboard protection** in a Filament panel for **Laravel 12**, using a **single middleware** to ensure users are always redirected to the correct dashboard based on their role — without triggering a `403 Forbidden` error.

---

## 📋 Table of Contents

* [Overview](#overview)
* [1. Create Middleware](#1-create-middleware)
* [2. Update Middleware Logic](#2-update-middleware-logic)
* [3. Register Middleware in Panel Provider](#3-register-middleware-in-panel-provider)
* [4. Result](#4-result)
---

## 🧠 Overview

* **Users** are redirected to `/dashboard`
* **Admins** are redirected to `/admin-dashboard`
* If they try to access each other’s dashboards by typing the URL manually, they are silently redirected instead of seeing a 403 error.

---

## ✅ 1. Create Middleware

Create a new middleware using Artisan:

```bash
php artisan make:middleware RedirectIfAccessingWrongDashboard
```

---

## 🧾 2. Update Middleware Logic

Update the generated file:
**`app/Http/Middleware/RedirectIfAccessingWrongDashboard.php`**

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAccessingWrongDashboard
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // Or your login route
        }

        $role = auth()->user()->role;
        $uri = $request->path();

        // If user is 'user' but trying to access admin dashboard
        if ($role === 'user' && str_contains($uri, 'admin-dashboard')) {
            return redirect()->route('filament.boar-sync.pages.dashboard');
        }

        // If user is 'admin' but trying to access user dashboard
        if (
            $role === 'admin' &&
            str_contains($uri, 'dashboard') &&
            !str_contains($uri, 'admin-dashboard')
        ) {
            return redirect()->route('filament.boar-sync.pages.admin-dashboard');
        }

        return $next($request);
    }
}
```

> ✅ Uses simple URI matching and `auth()->user()->role` logic

---

## 🧩 3. Register Middleware in `BoarSyncPanelProvider.php`

In your panel provider file:
**`app/Providers/BoarSyncPanelProvider.php`**

Add the middleware in the `panel()` method:

```php
use App\Http\Middleware\RedirectIfAccessingWrongDashboard;
use Illuminate\Cookie\Middleware\EncryptCookies;

public function panel(Panel $panel): Panel
{
    return $panel
        ->middleware([
            EncryptCookies::class,
            //other default middleware
            RedirectIfAccessingWrongDashboard::class, // Custom role-check middleware
        ])
        ->authMiddleware([
            Authenticate::class,
        ]);
}
```

> if logged in as admin unya mu type sya sa url /dashboard for users redirect balik sa /admin-dashboard instead of showing Forbidden | 403 page.

---

## ✅ 4. Result

| Scenario                             | Redirected To          |
| ------------------------------------ | ---------------------- |
| `user` accesses `/admin-dashboard`   | `/dashboard`           |
| `admin` accesses `/dashboard`        | `/admin-dashboard`     |
| Unauthenticated tries dashboard URLs | Redirected to `/login` |

---

## ✅ Final Output

| User Role | Redirect Path      | Message                          |
| --------- | ------------------ | -------------------------------- |
| `user`    | `/dashboard`       | "Welcome to the User Dashboard"  |
| `admin`   | `/admin-dashboard` | "Welcome to the Admin Dashboard" |

---