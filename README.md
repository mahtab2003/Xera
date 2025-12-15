<div align="center">
    <img src="assets/default/img/xera.png" alt="Xera Community Edition Logo" width="200">
    <h1>Xera Community Edition</h1>
    <p><b>The secure, community-driven hosting management system for MyOwnFreeHost (MOFH).</b></p>

[![License](https://img.shields.io/badge/Licence-GPL_2.0-orange)](LICENSE)
[![Version](https://img.shields.io/badge/Version-v1.3.1--CE-informational)](https://github.com/mahtab2003/Xera/releases/latest)
![Build](https://img.shields.io/badge/Build-Passing-brightgreen)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue)

</div>

---

## 🛡️ What is Xera CE?

**Xera Community Edition (Xera CE)** is a dedicated fork of the original [Xera](https://github.com/mahtab2003/Xera) project.

With the original project inactive since July 2024, **Xera CE** was created to address critical security vulnerabilities and ensure a safe, reliable platform for hosting providers. Our mission is to modernize the codebase, fix legacy debt, and introduce new features while maintaining the simplicity that made Xera great.

### 🔐 Security First
Xera CE isn't just a rename; it's a hardened release. We have remediated major vulnerabilities found in the original core:

*   **🔒 Secure Password Storage**: Moved away from custom rolling hashing to industry-standard **Bcrypt** (`password_hash`). Legacy passwords are securely migrated securely upon next login.
*   **🔑 Encrypted Secrets**: Sensitive API credentials (MOFH, SMTP, SSL) are no longer stored in plaintext. They are encrypted using AES-256 via the CodeIgniter Encryption library.
*   **🛡️ XSS Protection**: Implemented rigorous output escaping in the ticketing system to prevent Stored Cross-Site Scripting attacks.
*   **🚧 Callback Security**: Secured the MOFH callback API endpoint with IP allowlisting (CIDR support) to prevent unauthorized account manipulation.

---

## 🎮 Features

Xera CE includes all the beloved features of the original, now safer than ever:

*   **User Management**: Complete client area for registration, login, and profile management.
*   **Hosting Management**: Seamless integration with **MOFH (MyOwnFreeHost)** for account provisioning.
*   **Support System**: Built-in ticketing system for customer support.
*   **Theme Engine**: Customize the look and feel of your host.
*   **Integrations**:
    *   **Captcha**: Google reCAPTCHA, hCaptcha, Cloudflare Turnstile, CryptoLoot.
    *   **SSL**: ACMEv2 (Let's Encrypt, ZeroSSL), GoGetSSL.
    *   **Builder**: SitePro integration.
    *   **Mail**: SMTP support (Mailgun, SendGrid, etc.).
*   **Multi-lingual Support**: Ready for a global audience.

---

## 🚀 Getting Started

### 📋 Prerequisites
Ensure your server meets these requirements before installation:
*   **PHP**: Version 8.1 or higher.
*   **Database**: MySQL 5.7+ or MariaDB.
*   **Web Server**: Apache (with `mod_rewrite`) or Nginx.
*   **SSL**: A valid SSL certificate is required for security features.

### 🛠️ Installation
1.  **Download**: Get the latest release of Xera CE.
2.  **Upload**: Extract the contents to your web server's public directory.
3.  **Database**: Create a new MySQL database and user.
4.  **Installer**: Navigate to `https://your-domain.com/install.php` and follow the wizard.
5.  **Post-Install**: Delete `install.php` and `db.sql` after successful installation.

### ⚙️ Critical Configuration (New in CE)
To enable the security fixes, you **must** configure the following in `app/config/config.php`:

1.  **Encryption Key**: Set a secure, random 32-byte hex string.
    *   *Recommended*: Set the `XERA_ENCRYPTION_KEY` environment variable on your server.
    *   *Fallback*: Edit `$config['encryption_key']` in `app/config/config.php`.
2.  **Trusted IPs**: Secure your MOFH callback endpoint.
    *   Edit `$config['mofh_trusted_ips']` in `app/config/config.php`.
    *   Add the IP addresses used by MOFH to send callbacks (e.g., `['185.27.134.0/24']`). *Without this, callbacks remain insecure.*

---

## 📧 SMTP Recommendations
Xera CE works best with transactional email services.
*   **Mailjet** (Free tier available)
*   **SendGrid**
*   **MailTrap** (Great for testing)
*   *Note: Mailgun's free tier is now very limited.*

---

## 🤝 Contributing
Contributions are the lifeblood of the Community Edition.
*   **Found a bug?** Open an issue.
*   **Fixed a bug?** Submit a Pull Request.
*   **Security Issue?** Please disclose responsibly.

## ©️ License & Credits
**Xera Community Edition** is released under the **GPL-2.0 License**.

*   Based on [Xera](https://github.com/mahtab2003/Xera) by [Mehtab Hassan](https://github.com/mahtab2003).
*   maintained by the Community.

<a href="//www.dmca.com/Protection/Status.aspx?ID=907c042a-ab9d-4d7b-8638-25d88c2ff2aa" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca_protected_sml_120b.png?ID=907c042a-ab9d-4d7b-8638-25d88c2ff2aa"  alt="DMCA.com Protection Status" /></a>
