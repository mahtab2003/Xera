# Xera setup Documentation
## General Settings:
Access your Xera admin section: `https://{your.domain}/{xera-directory}/a`.
- **Host Name:** Your hosting name.
- **Forum URL:** URL of your forum, including https://.
- **Alert Email:** Your hosting email to receive ticket replies and notifications of new tickets.
- **Host Status:** Option to enable or disable your hosting.
- **Records per Page:** Number of records displayed per page for accounts, SSL certificates, tickets, or ticket replies. The recommended setting for free hosting is 5, based on your server's capacity.

## MyOwnFreeHost Integration (Important):
1. Access your Xera admin section: `https://{your.domain}/{xera-directory}/a`.
2. Navigate to `Settings` -> `API Settings` -> `MyOwnFreeHost`.

### Setting Up Your MOFH Account:
1. Visit the [MOFH Panel](https://panel.myownfreehost.net/panel/index.php).
2. Go to `API` -> `Setup WHM API`.
3. Select your domain and click `Get Keys / Set Allow IP Address`.
4. Enter the Shared IP shown in Xera into the `API Allowed IP` field.
5. Enter the Callback URL shown in Xera into the `API Callback URL` field.

### Configuring MOFH in Xera:
1. Enter the API username from the MOFH API page into the username field.
2. Enter the API password from the MOFH API page into the password field.
3. Set `CPanel URL` to `cpanel.{your-reseller-domain}`.
4. Use `ns1.byet.org` and `ns2.byet.org` for nameservers, or your custom ones if available.
5. Enter the name of your created package from the MOFH Panel under `Quotas & Packages` -> `Set Packages`.
   - Select your domain and click `Add / Change Plans`.

After saving, click `Test Connection` to verify the credentials are set correctly.

## Simple Mailer Configuration:
1. Enter your SMTP credentials to enable email sending.
2. Set `Hostname` to the hostname provided by your SMTP provider.
3. Enter your `Username` and `Password` for SMTP.
4. Set `From Email` to the email address used for sending emails (must be authenticated by the SMTP provider).
5. Enter the `From Name` to display as the sender in emails from Xera.
6. Set `SMTP Port` as provided by your SMTP provider.
7. Configure `SMTP Encryption`:
   - `25/2525` = None
   - `465` = SSL
   - `587` = TLS
8. Set `SMTP Status` to `Active` to enable mailing or `Inactive` to disable it.

## Bot Protection:
To protect your site from automated abuse, Xera supports several bot protection services. Here’s how to set them up:

1. **Google reCAPTCHA:** Go to the Google reCAPTCHA website, sign up, and get the necessary site and secret keys. Enter these credentials in Xera.
2. **Human Captcha:** If you have a preferred human captcha service, obtain the credentials from the service provider and enter them in Xera.
3. **CryptoLoot:** Visit the CryptoLoot website, register, and get the required API key. Enter this key in Xera.
4. **Cloudflare Turnstile:** Sign up on the Cloudflare website, get the required credentials, and enter them in Xera.

To enable or disable a specific bot protection service, toggle its status in Xera.

## SSL Certificates (GoGetSSL):
To manage SSL certificates through GoGetSSL, follow these steps:
1. Obtain your API credentials from [GoGetSSL](https://my.gogetssl.com) by navigating to `Reseller Modules` -> `API Settings`.
2. Enter the obtained API credentials into Xera under the SSL configuration section.

## ACME SSL Configuration:
Xera supports the provision of ACME SSL certificates from multiple providers. Configure them as follows:

**Important:** CloudFlare API is mandatory for ACME SSL because it is used to delegate the DNS CNAME records.

### Let's Encrypt:
Refer to [Let's Encrypt Get Started Page](https://letsencrypt.org/getting-started/)
- **Directory URL:** Enter the directory URL provided by Let's Encrypt.

### ZeroSSL:
Refer to [ZeroSSL ACME Documentation](https://zerossl.com/documentation/acme/)
- **Directory URL:** Enter the directory URL provided by ZeroSSL.
- **EAB Key ID:** Enter your External Account Binding (EAB) Key ID from ZeroSSL.
- **EAB HMAC Key:** Enter your EAB HMAC Key from ZeroSSL.

### Google Trust:
Refer to [Public CA Tutorial](https://cloud.google.com/certificate-manager/docs/public-ca-tutorial)
- **Directory URL:** Enter the directory URL provided by Google Trust Services.
- **EAB Key ID:** Enter your EAB Key ID from Google Trust Services.
- **EAB HMAC Key:** Enter your EAB HMAC Key from Google Trust Services.

### Cloudflare API:
Refer to [How to get CloudFlare API Key](https://developers.cloudflare.com/fundamentals/api/get-started/keys/)
- **Account Email:** Enter the email address associated with your Cloudflare account.
- **Domain Name Added in Cloudflare:** Enter the domain name you have added to Cloudflare.
- **Account API Key:** Enter your Cloudflare account API key.

### ACME:
- **DNS over HTTPS:** To avoid issues with free hosting, enable DNS over HTTPS.

**DNS over HTTPS:**
- Enable this option to use DNS over HTTPS.

**DNS Resolver:**
- Set this to the respective from your preferred DNS resolver.

**Google Public DNS:**
- Normal DNS: `8.8.8.8`
- DNS over HTTPS: `dns.google`

**Status:**
- Set to `Active` to enable this feature.

## Sitepro Integration:
Refer to [Sitepro API Documentation](https://site.pro/API-documentation/create-session-sso/1141640/)
**Hostname:**
- Set to `https://site.pro`.

**Username:**
- Enter your Sitepro username.

**Password:**
- Enter your Sitepro password.

**Status:**
- Set to `Active` to enable the integration.

## GitHub OAuth Configuration:
To enable GitHub OAuth for user authentication, follow these steps:

### GitHub:
Refer to [How to Create GitHub oAuth App](https://docs.github.com/en/apps/oauth-apps/building-oauth-apps/creating-an-oauth-app)
- **Client Key:** Enter the client key obtained from GitHub.
- **Secret Key:** Enter the secret key obtained from GitHub.
- **Status:** Set to `Active` to enable GitHub OAuth authentication.
