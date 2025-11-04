# 🎨 Modern Brown-Orange Theme Guide

Panduan lengkap penggunaan tema coklat-oranye modern untuk Laravel CoreUI.

## 📋 Daftar Isi
- [Palet Warna](#palet-warna)
- [Buttons](#buttons)
- [Cards](#cards)
- [Forms](#forms)
- [Tables](#tables)
- [Badges](#badges)
- [Alerts](#alerts)
- [Utilities](#utilities)

---

## 🎨 Palet Warna

### Warna Utama (Brown-Orange)
```scss
$brown-orange-900: #5D3A1A  // Dark brown
$brown-orange-800: #734A28
$brown-orange-700: #8B5E34
$brown-orange-600: #A47148
$brown-orange-500: #C17F4C  // Medium (Primary)
$brown-orange-400: #D49A6A
$brown-orange-300: #E4B894
$brown-orange-200: #F0D5BE
$brown-orange-100: #F9EDE2
$brown-orange-50:  #FDF8F4
```

### Warna Aksen
```scss
$orange-accent:      #E67E22  // Vibrant orange
$orange-accent-light: #F39C12
$orange-accent-dark: #D35400
```

---

## 🔘 Buttons

### Primary Button
```html
<button class="btn btn-primary">Primary Button</button>
<button class="btn btn-primary btn-sm">Small Button</button>
<button class="btn btn-primary btn-lg">Large Button</button>
```

**Features:**
- Gradient background (#C17F4C → #A47148)
- Hover effect dengan transform dan shadow
- Smooth transitions

### Secondary Button
```html
<button class="btn btn-secondary">Secondary Button</button>
```

### Outline Button
```html
<button class="btn btn-outline-primary">Outline Button</button>
```

### Button Variants
```html
<button class="btn btn-success">Success</button>
<button class="btn btn-danger">Danger</button>
<button class="btn btn-warning">Warning</button>
<button class="btn btn-info">Info</button>
```

### Button Sizes
```html
<button class="btn btn-primary btn-sm">Small</button>
<button class="btn btn-primary">Default</button>
<button class="btn btn-primary btn-lg">Large</button>
```

---

## 🃏 Cards

### Standard Card
```html
<div class="card">
    <div class="card-header">
        <h5>Card Title</h5>
    </div>
    <div class="card-body">
        <p>Card content goes here...</p>
    </div>
    <div class="card-footer">
        Footer content
    </div>
</div>
```

### Elegant Card (dengan gradient header)
```html
<div class="card card-elegant">
    <div class="card-header">
        <h5>Elegant Card</h5>
    </div>
    <div class="card-body">
        Content with elegant styling
    </div>
</div>
```

### Card dengan Accent Border
```html
<div class="card card-accent">
    <div class="card-body">
        Card with left accent border
    </div>
</div>
```

### Hover Lift Effect
```html
<div class="card hover-lift">
    <div class="card-body">
        Card dengan hover effect
    </div>
</div>
```

**Features:**
- Rounded corners (1rem)
- Smooth shadow transitions
- Hover lift effect
- Gradient headers

---

## 📝 Forms

### Input Fields
```html
<div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email">
</div>
```

### Select Dropdown
```html
<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <select class="form-select" id="country">
        <option selected>Choose...</option>
        <option value="1">Indonesia</option>
        <option value="2">Malaysia</option>
    </select>
</div>
```

### Textarea
```html
<div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea class="form-control" id="message" rows="3"></textarea>
</div>
```

**Features:**
- Border color: rgba(193, 127, 76, 0.2)
- Focus state dengan shadow
- Smooth transitions

---

## 📊 Tables

### Basic Table
```html
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td>Admin</td>
            <td>
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>
    </tbody>
</table>
```

### Striped Table
```html
<table class="table table-striped">
    <!-- ... -->
</table>
```

**Features:**
- Gradient header (#C17F4C → #A47148)
- Hover effect pada rows
- Rounded corners

---

## 🏷️ Badges

```html
<span class="badge badge-primary">Primary</span>
<span class="badge badge-secondary">Secondary</span>
<span class="badge badge-success">Success</span>
<span class="badge badge-warning">Warning</span>
<span class="badge badge-danger">Danger</span>
```

**Features:**
- Pill-shaped (border-radius: 2rem)
- Gradient backgrounds
- Font weight: 600

---

## ⚠️ Alerts

```html
<!-- Primary Alert -->
<div class="alert alert-primary">
    <strong>Info!</strong> This is a primary alert.
</div>

<!-- Success Alert -->
<div class="alert alert-success">
    <strong>Success!</strong> Operation completed successfully.
</div>

<!-- Warning Alert -->
<div class="alert alert-warning">
    <strong>Warning!</strong> Please check your input.
</div>

<!-- Danger Alert -->
<div class="alert alert-danger">
    <strong>Error!</strong> Something went wrong.
</div>
```

**Features:**
- Gradient backgrounds
- Left accent border (4px)
- Rounded corners (0.75rem)

---

## 🛠️ Utilities

### Background Utilities
```html
<div class="bg-primary-gradient p-4">Primary Gradient Background</div>
<div class="bg-secondary-gradient p-4">Secondary Gradient Background</div>
<div class="bg-light-brown p-4">Light Brown Background</div>
```

### Text Utilities
```html
<p class="text-primary-dark">Dark brown text</p>
<p class="text-brown-orange">Brown-orange text</p>
```

### Shadow Utilities
```html
<div class="shadow-brown p-4">Element with brown shadow</div>
<div class="shadow-brown-lg p-4">Element with large brown shadow</div>
```

### Hover Lift Effect
```html
<div class="card hover-lift">
    <!-- Card akan terangkat saat di-hover -->
</div>
```

---

## 📱 Pagination

```html
<nav>
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <li class="page-item active">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
```

**Features:**
- Rounded page links
- Hover lift effect
- Gradient active state

---

## 🍞 Breadcrumb

```html
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Library</a></li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
</nav>
```

**Features:**
- Gradient background
- Rounded corners
- Styled links

---

## 🪟 Modal

```html
<div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Modal content goes here...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
```

**Features:**
- Gradient header
- Large shadow
- Rounded corners (1rem)

---

## 💡 Tips Penggunaan

### 1. Kombinasi Komponen
```html
<div class="card card-elegant hover-lift">
    <div class="card-header">
        <h5>User Profile</h5>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>
        </form>
    </div>
</div>
```

### 2. Dashboard Cards
```html
<div class="row">
    <div class="col-md-3">
        <div class="card hover-lift">
            <div class="card-body text-center">
                <h3 class="text-brown-orange">1,234</h3>
                <p class="text-muted mb-0">Total Users</p>
            </div>
        </div>
    </div>
    <!-- Repeat for other stats -->
</div>
```

### 3. Data Table dengan Actions
```html
<div class="card">
    <div class="card-header">
        <h5>Users Management</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
```

---

## 🎨 Customization

Untuk mengubah warna tema, edit file `/resources/sass/_variables.scss`:

```scss
// Ubah warna primary
$brown-orange-500: #YOUR_COLOR;

// Ubah warna aksen
$orange-accent: #YOUR_ACCENT_COLOR;
```

Kemudian compile ulang assets:
```bash
npm run dev
# atau
npm run build
```

---

## 📦 Build Assets

Setelah melakukan perubahan, compile assets dengan:

```bash
# Development
npm run dev

# Production
npm run build

# Watch mode (auto-compile on changes)
npm run watch
```

---

## ✨ Best Practices

1. **Konsistensi**: Gunakan komponen yang sama untuk elemen yang sama
2. **Spacing**: Gunakan margin bottom (mb-3, mb-4) untuk spacing yang konsisten
3. **Responsive**: Semua komponen sudah responsive-ready
4. **Accessibility**: Gunakan label untuk form inputs
5. **Performance**: Kompile assets untuk production sebelum deploy

---

**Dibuat dengan ❤️ untuk Laravel CoreUI**
