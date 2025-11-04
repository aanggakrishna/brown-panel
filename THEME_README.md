# 🎨 Modern Brown-Orange Theme - Installation & Usage

## ✨ Fitur Utama

- **Palet Warna Modern**: Tema coklat-oranye yang elegan dan profesional
- **Komponen Reusable**: Button, Card, Form, Table, Badge, Alert, dan lainnya
- **Gradient Effects**: Efek gradient pada button, card header, dan backgrounds
- **Hover Animations**: Smooth transitions dan lift effects
- **Responsive Design**: Mobile-friendly dan responsive
- **Easy Customization**: Mudah disesuaikan dengan kebutuhan

## 📦 Installation

### 1. Compile Assets

Setelah file SASS sudah dibuat, compile assets dengan command berikut:

```bash
# Development mode
npm run dev

# Production mode (optimized)
npm run build

# Watch mode (auto-compile on changes)
npm run watch
```

### 2. Lihat Demo

Akses halaman demo untuk melihat semua komponen:

```
http://your-app.test/components-demo
```

Atau gunakan route name:
```php
route('components.demo')
```

## 🎨 Struktur File

```
resources/
├── sass/
│   ├── _variables.scss       # Variable warna utama
│   ├── _custom.scss          # Custom components styling
│   ├── _layout.scss          # Layout dan global styles
│   ├── app.scss              # Main SASS file
│   └── coreui/
│       └── _variables.scss   # CoreUI variable overrides
```

## 🚀 Quick Start

### 1. Button

```html
<button class="btn btn-primary">Primary Button</button>
<button class="btn btn-outline-primary">Outline Button</button>
<button class="btn btn-success">Success Button</button>
```

### 2. Card

```html
<div class="card">
    <div class="card-header">
        <h5>Card Title</h5>
    </div>
    <div class="card-body">
        Card content
    </div>
</div>
```

### 3. Card Elegant (Gradient Header)

```html
<div class="card card-elegant">
    <div class="card-header">
        <h5>Elegant Card</h5>
    </div>
    <div class="card-body">
        Content
    </div>
</div>
```

### 4. Form

```html
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" placeholder="Email">
</div>
```

### 5. Table

```html
<table class="table table-striped">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data 1</td>
            <td>Data 2</td>
        </tr>
    </tbody>
</table>
```

### 6. Badge

```html
<span class="badge badge-primary">Primary</span>
<span class="badge badge-success">Success</span>
```

### 7. Alert

```html
<div class="alert alert-primary">
    <strong>Info!</strong> This is an alert.
</div>
```

## 🎨 Color Palette

### Primary Colors
```scss
#5D3A1A  // Dark Brown
#8B5E34  // Medium Brown  
#C17F4C  // Brown-Orange (Primary)
#E4B894  // Light Brown-Orange
#F9EDE2  // Very Light Brown
```

### Accent Colors
```scss
#E67E22  // Orange Accent
#F39C12  // Yellow-Orange
#52A068  // Success Green
#C94C4C  // Danger Red
```

## 🛠️ Customization

### Mengubah Warna Primary

Edit `/resources/sass/_variables.scss`:

```scss
$brown-orange-500: #YOUR_COLOR;  // Ganti dengan warna pilihan
```

### Mengubah Border Radius

Edit `/resources/sass/coreui/_variables.scss`:

```scss
$border-radius: .5rem;      // Default
$border-radius-sm: .375rem; // Small
$border-radius-lg: .75rem;  // Large
```

### Menambah Custom Component

Tambahkan di `/resources/sass/_custom.scss`:

```scss
.my-custom-component {
    background: linear-gradient(135deg, #C17F4C 0%, #A47148 100%);
    padding: 1rem;
    border-radius: 0.5rem;
    // ... your styles
}
```

Setelah edit, compile ulang:
```bash
npm run build
```

## 📚 Component Classes

### Buttons
- `.btn-primary` - Primary button
- `.btn-secondary` - Secondary button
- `.btn-success` - Success button
- `.btn-danger` - Danger button
- `.btn-warning` - Warning button
- `.btn-outline-primary` - Outline button
- `.btn-sm` - Small button
- `.btn-lg` - Large button

### Cards
- `.card` - Standard card
- `.card-elegant` - Card with gradient header
- `.card-accent` - Card with left accent border
- `.hover-lift` - Add lift effect on hover

### Badges
- `.badge-primary` - Primary badge
- `.badge-secondary` - Secondary badge
- `.badge-success` - Success badge
- `.badge-danger` - Danger badge
- `.badge-warning` - Warning badge

### Utilities
- `.bg-primary-gradient` - Primary gradient background
- `.bg-secondary-gradient` - Secondary gradient background
- `.bg-light-brown` - Light brown background
- `.text-primary-dark` - Dark brown text
- `.text-brown-orange` - Brown-orange text
- `.shadow-brown` - Brown shadow
- `.shadow-brown-lg` - Large brown shadow

## 📱 Responsive

Semua komponen sudah responsive dan akan menyesuaikan dengan ukuran layar:

```html
<div class="row">
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card">...</div>
    </div>
</div>
```

## ⚡ Performance Tips

1. **Production Build**: Selalu gunakan `npm run build` untuk production
2. **Cache Clearing**: Clear cache Laravel setelah perubahan:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```
3. **Asset Versioning**: Vite sudah menangani versioning otomatis

## 🐛 Troubleshooting

### Styles tidak muncul
```bash
# Clear cache dan rebuild
npm run build
php artisan cache:clear
php artisan view:clear
```

### Warna tidak sesuai
```bash
# Pastikan sudah compile ulang setelah edit
npm run build
```

### Error saat compile
```bash
# Reinstall dependencies
rm -rf node_modules
npm install
npm run build
```

## 📖 Documentation

Lihat dokumentasi lengkap di `THEME_GUIDE.md`

## 🔄 Update Theme

Untuk update warna atau styling:

1. Edit file SASS di `/resources/sass/`
2. Compile assets: `npm run build`
3. Clear cache: `php artisan view:clear`
4. Refresh browser

## 💡 Best Practices

1. **Konsistensi**: Gunakan class yang sama untuk komponen yang sama
2. **Spacing**: Gunakan utility classes Bootstrap untuk spacing (mb-3, mt-4, dll)
3. **Colors**: Gunakan variabel SASS untuk warna, bukan hardcode
4. **Reusability**: Manfaatkan class utilities yang sudah ada
5. **Performance**: Hindari inline styles, gunakan class

## 🎯 Examples

### Dashboard Card

```html
<div class="card card-elegant hover-lift">
    <div class="card-header">
        <h5>Statistics</h5>
    </div>
    <div class="card-body text-center">
        <h2 class="text-brown-orange">1,234</h2>
        <p class="text-muted mb-0">Total Users</p>
    </div>
</div>
```

### User Form

```html
<div class="card">
    <div class="card-header">
        <h5>User Profile</h5>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
```

### Data Table

```html
<div class="card">
    <div class="card-header">
        <h5>Users List</h5>
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

## 🤝 Support

Jika ada pertanyaan atau masalah:
1. Cek dokumentasi di `THEME_GUIDE.md`
2. Lihat contoh di `/components-demo`
3. Periksa console browser untuk error

---

**Dibuat dengan ❤️ untuk Laravel CoreUI**
**Modern Brown-Orange Theme v1.0**
