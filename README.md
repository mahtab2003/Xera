## Warning 
THis is a beta version of Xera so use it for testing purpose only or you will be responsible for your own loss.

## Introduction
Xera is a hosting account and support management system especially designed to work MyOwnFreeHost. Xera have a limited number of feature which are described below:
- User Management.
- Theme Management.
- Support Management.
- Integration:
	- MyOwnFreeHost
	- Google Recaptcha
	- SMTP Server

## Requirements
Your server need to met minimal requirements to run Xera:
- PHP v7.2 or above.
- MySQL v5.7 or above.
- Valid SSL Certificate.

## Installation 
Installation of Xera is much eaiser then you think!
- Download the ```Xera-dev.zip``` file. 
- Extract the .zip file and upload them to your web hosting account. 
- Create an new database for web host.
- Import ```db.sql``` file into your database.
- Edit ```app/config/config.php``` file and replace base url ```http://localhost/xera/``` with your site url ```http://your-domain.com/``` or ```http://your-domain.com/directory/```(Remember HTTPS is recommended).
- Edit ```app/config/database.php``` file and replace database credantials.
- Open your browser and type ```http://yourdomain.com/a/``` to create an admin account. 
- Register an admin account and login to your admin panel. 
- Replace logo and favicon from ```assets/img/```.
- All done! 

## Recommended
Here are some widely used SMTP services. They have a free plan with some limitations though, most importantly they are compatible with Xera.
- [Mailgun](https://www.mailgun.com/).
- [Mailjet](https://mailjet.com/).
- [SendGrid](https://sendgrid.com/free/).

## Copyright
This build is created by [Mehtab Hassan](https://github.com/mahtab2003). Code released under the GPL-2.0 license.
