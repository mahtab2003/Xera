<div align="center">
    <img src="assets/default/img/xera.png">
</div>

# MOFH Client Area Manager (Fork of Xera)

> **Note:**  
> This repo is an **active fork** of [Xera by Mehtab Hassan](https://github.com/mahtab2003/Xera).  
> This fork is **maintained by me**, and pull requests are welcome!  
> If you’d like to add features, bugfixes, or improvements — feel free to contribute. 🚀

---

## 👀 What is this?
This is a **client area & hosting account management system** designed to work with **MOFH (MyOwnFreeHost)**.  
It makes managing hosting accounts, clients, and integrations much easier — all in one place.

[![AppVeyor](https://img.shields.io/badge/Licence-GPL_2.0-orange)](LICENSE)
[![AppVeyor](https://img.shields.io/badge/Version-v1.3.1-informational)](https://github.com/mahtab2003/Xera/releases/latest)
![AppVeyor](https://img.shields.io/badge/Build-Passed-brightgreen)
![AppVeyor](https://img.shields.io/badge/Interface-Tabler-lightgreen)
![AppVeyor](https://img.shields.io/badge/Development-Live-brightgreen)
![AppVeyor](https://img.shields.io/badge/Dependencies-PHP,_MySQL,_cUrl-red)

---

## 🎮 Features
- User Management  
- Theme Management  
- Support Management  
- Administrative Access  
- Integration With:  
  - MOFH (MyOwnFreeHost)  
  - Google reCAPTCHA  
  - hCaptcha  
  - Cloudflare Turnstile  
  - CryptoLoot  
  - GoGetSSL (No support after March 10, 2025)  
  - ACMEv2 (Let's Encrypt, ZeroSSL)  
  - SitePro  
  - SMTP  
- Update Manager  
- Multi-lingual  

---

## 🤸 Getting Started

### 🚅 Requirements
Your server needs to meet the following minimum requirements:
- PHP v8.1 or above  
- MySQL v5.7 or above  
- A valid, trusted SSL certificate  

👉 **Note about PostgreSQL / 404 Error after Installation**  
Some hosting accounts use **PostgreSQL** instead of **MySQL**. Since Xera was built for MySQL, this can cause installation issues (like a `404 error` after setup).  

✅ To fix this:
- Make sure your hosting provider supports **MySQL**.  
- Ensure required PHP extensions are enabled (pdo_mysql, mysqli, cURL, openssl, mbstring, etc.).  

---

### 💾 Installation 
1. Download the latest release [here](https://github.com/mahtab2003/Xera/releases/latest). Or grab the dev build [here](https://github.com/mahtab2003/Xera/archive/refs/heads/dev.zip).  
2. Extract and upload contents to your web hosting account.  
3. Create a new MySQL database.  
4. Go to `https://{your.domain}/{xera-directory}/install.php` → click **Get Started**.  
5. Enter your `Website URL`, `Cookie Prefix`, enable `CSRF Protection` → Next.  
6. Add your database credentials → Next (tables will auto-import).  
7. Register an admin account → log into the admin panel.  
8. Replace the logo & favicon (`assets/default/img/`).  
9. Setup SMTP (see options below).  
10. Done! 🎉  

For a full guide, see [Setup Guide](Setup-Guide.md).

---

### 📧 SMTP
Recommended SMTP providers:
- [Mailgun](https://www.mailgun.com/) *(Trial only, CC required after a month)*  
- [Mailjet](https://mailjet.com/)  
- [SendGrid](https://sendgrid.com/free/)  
- [MailTrap](https://mailtrap.io)  

---

## 🤔 Help
- Found a bug or need help? [Open an issue here](https://github.com/yourusername/yourrepo/issues).  
- Before opening, please check if your topic already exists. If so, contribute to the discussion instead of opening a duplicate.  

---

## 🙌 Contributing
This repo is maintained by **me**.  
- Pull requests are **welcome and encouraged**.  
- Feel free to fork, improve, and submit PRs.  

---

## 🚀 Looking for Hosting?
This project was built for **MyOwnFreeHost users**, but if you’re looking for **free & affordable hosting** without the hassle — check out [**InfySite**](https://infysite.com). 💻✨  

---

## ©️ Copyright
- Original project: [Xera by Mehtab Hassan](https://github.com/mahtab2003/Xera)  
- Fork maintained by: **[Yang](https://github.com/yourusername)**  
- License: [GPL-2.0](LICENSE)  