# Security Guidelines

## 🔐 Important Security Practices

### API Keys & Secrets

**NEVER commit API keys or secrets to version control!**

✅ **DO:**
- Store API keys in the database (via Admin Panel → Payment Settings)
- Use environment variables for sensitive configuration
- Keep `.env` files in `.gitignore`
- Use placeholders in code examples (e.g., "Enter your API key")

❌ **DON'T:**
- Hardcode API keys in source code
- Commit `.env` files
- Use real API keys in placeholders
- Share API keys in documentation

---

## 🔑 Paystack API Keys

### Where to Store Keys

**Admin Panel (Recommended):**
1. Login to admin panel
2. Go to Settings → Payment Settings
3. Enter your Paystack keys
4. Keys are stored encrypted in the database

**Database Location:**
- Table: `site_settings`
- Keys: `paystack_public_key`, `paystack_secret_key`

### Key Formats

- **Public Key:** `pk_test_xxxxx` (test) or `pk_live_xxxxx` (production)
- **Secret Key:** `sk_test_xxxxx` (test) or `sk_live_xxxxx` (production)

**Never share your secret key publicly!**

---

## 🛡️ Production Security Checklist

Before deploying to production:

### 1. Authentication
- [ ] Change default admin credentials
- [ ] Use strong passwords (min 12 characters)
- [ ] Enable two-factor authentication (if available)
- [ ] Limit admin IP addresses (optional)

### 2. Database
- [ ] Change database username and password
- [ ] Use strong database password
- [ ] Restrict database access to localhost only
- [ ] Regular database backups
- [ ] Enable query logging for auditing

### 3. Configuration
- [ ] Set `ENVIRONMENT` to `production` in `index.php`
- [ ] Update `encryption_key` in `config.php`
- [ ] Disable error display in production
- [ ] Enable CSRF protection
- [ ] Set secure session cookies

### 4. File Permissions
```bash
# Recommended permissions
chmod 755 application/
chmod 644 application/config/*.php
chmod 755 application/cache/
chmod 755 application/logs/
chmod 755 uploads/
```

### 5. HTTPS
- [ ] Install SSL certificate
- [ ] Force HTTPS in `.htaccess`
- [ ] Update `base_url` to use HTTPS
- [ ] Enable secure cookies

### 6. Payment Security
- [ ] Use live API keys (not test keys)
- [ ] Verify webhook signatures
- [ ] Enable Paystack webhook URL
- [ ] Test payment flow thoroughly
- [ ] Monitor failed transactions

### 7. File Uploads
- [ ] Validate file types
- [ ] Limit file sizes
- [ ] Scan for malware
- [ ] Store outside web root (if possible)
- [ ] Use random filenames

### 8. Input Validation
- [ ] Sanitize all user inputs
- [ ] Use prepared statements (CodeIgniter does this)
- [ ] Validate email addresses
- [ ] Escape output (XSS protection)
- [ ] Implement rate limiting

---

## 🚨 If API Keys Are Exposed

If you accidentally commit API keys:

### Immediate Actions

1. **Revoke the exposed keys immediately**
   - Login to Paystack Dashboard
   - Go to Settings → API Keys
   - Generate new keys
   - Delete old keys

2. **Update your application**
   - Add new keys in Admin Panel
   - Test payment functionality
   - Verify webhook still works

3. **Clean Git history**
   ```bash
   # Remove from latest commit
   git reset --soft HEAD~1
   git add .
   git commit -m "Your message"
   git push --force origin main
   ```

4. **Notify stakeholders**
   - Inform your team
   - Check for unauthorized transactions
   - Monitor account activity

---

## 🔍 Security Monitoring

### Regular Checks

**Weekly:**
- Review failed login attempts
- Check for suspicious orders
- Monitor payment failures
- Review error logs

**Monthly:**
- Update dependencies
- Review user permissions
- Check file integrity
- Audit database access

**Quarterly:**
- Security audit
- Penetration testing
- Code review
- Update security policies

### Log Files to Monitor

```
application/logs/log-YYYY-MM-DD.php
```

Look for:
- Failed login attempts
- SQL errors
- Payment failures
- Webhook errors
- File upload errors

---

## 🔐 Password Security

### Admin Passwords

**Requirements:**
- Minimum 12 characters
- Mix of uppercase, lowercase, numbers, symbols
- No common words or patterns
- Change every 90 days

**Example Strong Password:**
```
V#k9mP$2xL@qR7nF
```

### Password Hashing

CodeIgniter uses `password_hash()` with bcrypt:
```php
$hashed = password_hash($password, PASSWORD_BCRYPT);
```

Never store plain text passwords!

---

## 🌐 HTTPS Configuration

### Apache (.htaccess)

```apache
# Force HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### Nginx

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl;
    server_name yourdomain.com;
    
    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;
    
    # Your other config...
}
```

---

## 📧 Email Security

### SMTP Configuration

**Use authenticated SMTP:**
```php
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_user'] = 'your-email@gmail.com';
$config['smtp_pass'] = 'your-app-password'; // Use app password, not real password
$config['smtp_port'] = 587;
$config['smtp_crypto'] = 'tls';
```

**Never commit SMTP credentials to Git!**

---

## 🔒 Session Security

### Secure Session Settings

In `application/config/config.php`:

```php
$config['sess_cookie_name'] = 'vheeki_session';
$config['sess_expiration'] = 7200; // 2 hours
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Production settings
$config['cookie_secure'] = TRUE; // Only over HTTPS
$config['cookie_httponly'] = TRUE; // Prevent JavaScript access
$config['cookie_samesite'] = 'Lax'; // CSRF protection
```

---

## 🛡️ SQL Injection Prevention

CodeIgniter's Query Builder provides automatic protection:

✅ **Safe (Automatic escaping):**
```php
$this->db->where('user_id', $user_id);
$this->db->get('users');
```

❌ **Unsafe (Never do this):**
```php
$this->db->query("SELECT * FROM users WHERE user_id = $user_id");
```

---

## 🚫 XSS Prevention

Always escape output:

```php
// In views
<?= htmlspecialchars($user_input) ?>

// Or use CodeIgniter's helper
<?= html_escape($user_input) ?>
```

---

## 📞 Reporting Security Issues

If you discover a security vulnerability:

1. **DO NOT** create a public GitHub issue
2. Email: security@vheekikrafts.com
3. Include:
   - Description of the vulnerability
   - Steps to reproduce
   - Potential impact
   - Suggested fix (if any)

We'll respond within 48 hours.

---

## 📚 Additional Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [CodeIgniter Security](https://codeigniter.com/userguide3/general/security.html)
- [Paystack Security](https://paystack.com/docs/security/)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)

---

**Last Updated:** January 2024  
**Version:** 1.0

**Remember: Security is an ongoing process, not a one-time setup!**
