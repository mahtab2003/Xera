## Warning 
This is a beta version of Xera. Use it for testing purpose only. You are be responsible for any loss or damages that may occor from using this code. Please create PRs with security and overall fixes.

## Introduction
Xera is a hosting account and support management system especially designed to work with MOFH (MyOwnFreeHost). Xera currently has a limited number of feature which are listed below:
- User Management
- Theme Management
- Support Management
- Administative Access
- Integration With:
	- MOFH (MyOwnFreeHost)
	- Google Recaptcha
	- SMTP

## Requirements
Your server needs to meet the following minimal requirements to run Xera:
- PHP v7.2 or above
- MySQL v5.7 or above
- Valid Trusted SSL Certificate

## Installation 
Installation of Xera is much eaiser then you think!
- Download the ```Xera-dev.zip``` file. 
- Extract the .zip file and upload the contents to your web hosting account. 
- Create an new database for Xera.
- Import the ```db.sql``` file into your database.
- Edit the ```app/config/config.php``` file and replace the base url ```http://localhost/xera/``` with your site url ```https://your-domain.com/``` or ```https://your-domain.com/directory/```(The URL must end in a backslash, and HTTPS is recomened for all installations).
- Edit the ```app/config/database.php``` file and replace database credantials with your own.
- Open your browser and enter ```https://yourdomain.com/a/``` to create an admin account. 
- Register an admin account and login to your admin panel. 
- Replace the logo and favicon located in ```assets/img/``` with your own.
- Setup SMTP (See Below)
- All done! 

## SMTP
Here are some widely used SMTP services. They have a free plan with some limitations, though most importantly, they are compatible with Xera.
- [Mailgun](https://www.mailgun.com/).
- [Mailjet](https://mailjet.com/).
- [SendGrid](https://sendgrid.com/free/).

## Copyright
This build is created and maintaned by [Mehtab Hassan](https://github.com/mahtab2003). Code released under the GPL-2.0 license.
