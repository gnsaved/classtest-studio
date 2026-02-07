# cPanel Installation Guide - UPDATED

## 🚨 Quick Fix for 404 Errors

### ✅ IMPORTANT: Login Should Auto-Load

When you visit your site, you should **automatically** see the login page.

If you see a blank page or 404:
1. Make sure Document Root is set to `public` folder (see Option 1 below)
2. Check that `.htaccess` files are present
3. Verify PHP version is 7.4+

### Option 1: Set Document Root (EASIEST - RECOMMENDED)

1. **Upload Files**
   - Upload ZIP to cPanel File Manager
   - Extract to: `public_html/classtest-studio/`

2. **Change Document Root**
   - Go to cPanel → **Domains**
   - Click on your domain
   - Change **Document Root** to: `public_html/classtest-studio/public`
   - Save changes

3. **Set Permissions**
   ```
   Right-click on 'storage' folder
   → Change Permissions → 755
   ```

4. **Run Setup via Browser**
   - Visit: `http://yourdomain.com/setup.php`
   - Or use Terminal: `php /home/username/public_html/classtest-studio/setup.php`

5. **Login**
   - Visit: `http://yourdomain.com`
   - Admin: admin@classtest.com / admin123
   - Student: emma.w@student.edu / student123

---

### Option 2: Using Subdomain

1. **Create Subdomain**
   - cPanel → Subdomains
   - Subdomain: `exams` (or any name)
   - Document Root: `public_html/classtest-studio/public`

2. **Upload & Extract**
   - Upload to `public_html/classtest-studio/`

3. **Set Permissions**
   ```
   storage/ → 755
   ```

4. **Visit**
   - http://exams.yourdomain.com

---

### Option 3: Main Domain Installation

If you want it on your main domain (yourdomain.com):

1. **Upload to Root**
   - Extract ZIP to `public_html/`
   - You should see: `public_html/classtest-studio/`

2. **Move Public Contents**
   ```bash
   cd public_html/classtest-studio
   mv public/* ../
   mv public/.htaccess ../
   ```

3. **Update Paths**
   
   Edit `public_html/index.php`:
   ```php
   // Change this line:
   require_once __DIR__ . '/../vendor/autoload.php';
   
   // To this:
   require_once __DIR__ . '/classtest-studio/vendor/autoload.php';
   ```

4. **Run Setup**
   ```bash
   cd public_html/classtest-studio
   php setup.php
   ```

---

## Troubleshooting Common Issues

### 1. Still Getting 404?

**Check PHP Version:**
- cPanel → Select PHP Version
- Must be 7.4 or higher
- Enable extensions: `pdo`, `pdo_sqlite`, `pdo_mysql`

**Check .htaccess Files:**
```bash
# Make sure you can see hidden files
File Manager → Settings → ✓ Show Hidden Files

# You should see:
/public_html/classtest-studio/.htaccess
/public_html/classtest-studio/public/.htaccess
```

**Test .htaccess Working:**
Create file: `public_html/classtest-studio/public/test.html`
```html
<h1>Test</h1>
```
Visit: http://yourdomain.com/test.html
If you see "Test", .htaccess is working.

### 2. Blank White Page

**Enable Error Display (temporarily):**

Edit `public/index.php`, add at top after `<?php`:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

Visit site to see actual error.

**Common Causes:**
- Wrong PHP version (needs 7.4+)
- Missing PHP extensions
- File permissions

### 3. Database Errors

**Check Storage Permissions:**
```bash
chmod 755 storage/
chmod 644 storage/database.sqlite (after creation)
```

**For MySQL Instead:**

1. Create database in cPanel → MySQL Databases
2. Edit `config/config.php`:
```php
'database' => [
    'driver' => 'mysql',
    'mysql' => [
        'host' => 'localhost',
        'database' => 'username_classtest',
        'username' => 'username_dbuser',
        'password' => 'your_password'
    ]
]
```

### 4. CSS/JS Not Loading

**Check File Paths:**
Visit: http://yourdomain.com/css/style.css

If 404:
- Verify Document Root points to `/public` directory
- Check `.htaccess` exists in public folder

**Clear Browser Cache:**
```
Ctrl + Shift + Delete (Chrome/Firefox)
Hard refresh: Ctrl + F5
```

### 5. Routes Not Working (e.g., /dashboard gives 404)

**Verify mod_rewrite:**
- Contact hosting support
- Ask: "Is mod_rewrite enabled?"

**Test Rewrite:**
Create: `public/.htaccess` with just:
```apache
RewriteEngine On
```

If you get 500 error, mod_rewrite is disabled.

---

## Demo Data Included

The system comes pre-loaded with:

**Admin Account:**
- Email: admin@classtest.com
- Password: admin123

**6 Student Accounts:**
- emma.w@student.edu / student123
- michael.b@student.edu / student123
- sophia.d@student.edu / student123
- james.w@student.edu / student123
- olivia.t@student.edu / student123
- noah.a@student.edu / student123

**5 Sample Assessments:**
- Mathematics Midterm (Published, with submissions)
- Physics Final (Published)
- Chemistry Quiz (Published, with submissions)
- Mathematics Final (Draft)
- Programming Quiz (Published)

**9 Student Submissions** showing realistic activity

---

## File Structure

```
public_html/
└── classtest-studio/
    ├── public/              ← Document Root should point here
    │   ├── index.php       ← Main entry point
    │   ├── .htaccess       ← Routing rules
    │   ├── css/
    │   └── js/
    ├── src/                ← Application code
    ├── config/             ← Configuration
    ├── storage/            ← Database (needs 755)
    └── vendor/             ← Dependencies
```

---

## Security After Installation

1. **Delete setup.php**
```bash
rm /home/username/public_html/classtest-studio/setup.php
```

2. **Protect Config**
Create `config/.htaccess`:
```apache
Deny from all
```

3. **Enable SSL**
- cPanel → SSL/TLS
- Install free SSL certificate

4. **Change Admin Password**
- Login as admin
- Create new admin user with strong password

---

## Need More Help?

**Check Error Logs:**
```
cPanel → Errors
Or: public_html/error_log
```

**Common Error Messages:**

| Error | Solution |
|-------|----------|
| "No such file or directory" | Wrong path in require_once |
| "Permission denied" | chmod 755 on storage/ |
| "Class not found" | Run: composer dump-autoload (or re-upload) |
| "Database connection failed" | Check storage/ permissions |

---

## Success Indicators

✅ You should see:
1. Professional blue/navy interface
2. Login page with gradient background
3. Dashboard with 4 stat boxes
4. 5 sample assessments
5. Student accounts working

If you see all of these, installation is successful!

---

**Still not working?** Share the exact error message and I'll help troubleshoot.
