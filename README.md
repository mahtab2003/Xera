<div align="center">
    <img src="assets/img/xera.png">
</div>

## ❗ Consumer Warning

While Xera is safer and more secure than its predecessor, MOFHY-Lite, it has not yet been fully cleared by the community, and is not yet recomended to be used in a production or public envirement. If you do decided to use this software publically, you claim full responsability, and release mahtab2003 and all maintainers from any legal action.

We invite you to search for vulnerabilities amd report them (Or better yet, fix them and make a pull request), so we can have a safe and secure MOFH client area for all!

## 👀 What is Xera ?
Xera is a hosting account and support management system especially designed to work with MOFH (MyOwnFreeHost). Xera currently has a limited number of feature which are listed below

### 🎮 Features
- User Management
- Theme Management
- Support Management
- Administative Access
- Integration With:
	- MOFH (MyOwnFreeHost)
	- Google Recaptcha
	- CryptoLoot
	- hCaptcha
	- GoGetSSL
	- SitePro
	- SMTP
- Update Manager

## 🤸 Getting Started

### 🚅 Requirements
Your server needs to meet the following minimal requirements to run Xera:
- PHP v7.2 or above.
- MySQL v5.7 or above.
- Valid Trusted SSL Certificate.

### 💾 Installation 
Installation of Xera is much eaiser then you think!
- Download the latest Xera installation file [here](https://github.com/mahtab2003/Xera/releases/latest). 
- Extract the .zip file and upload the contents to your web hosting account. 
- Create an new database for Xera.
- Modify then import the ```db.sql``` file into your database.
- Edit the ```app/config/config.php``` file and replace the base url ```http://localhost/xera/``` with your site url ```https://your-domain.com/``` or ```https://your-domain.com/directory/```(The URL must end in a backslash, and HTTPS is recomened for all installations).
- Edit the ```app/config/database.php``` file and replace database credantials with your own.
- Open your browser and enter ```https://yourdomain.com/a/``` to create an admin account. 
- Register an admin account and login to your admin panel. 
- Replace the logo and favicon located in ```assets/img/``` with your own.
- Setup SMTP (See Below)
- All done! 

### 📧 SMTP
Here are some widely used SMTP services. They have a free plan with some limitations, though most importantly, they are compatible with Xera.
- [Mailgun](https://www.mailgun.com/).
- [Mailjet](https://mailjet.com/).
- [SendGrid](https://sendgrid.com/free/).

### 🤔 Help
If you require assistance, please proceed to https://fourm.xera.eu.org/

### ©️ Copyright
This build is created and maintaned by [Mehtab Hassan](https://github.com/mahtab2003). Code released under the GPL-2.0 license.
