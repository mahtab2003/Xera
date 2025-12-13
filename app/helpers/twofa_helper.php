<?php

use OTPHP\TOTP;

if (!function_exists('twofa_generate_secret')) {
        function twofa_generate_secret()
        {
                $totp = TOTP::create();
                return $totp->getSecret();
        }
}

if (!function_exists('twofa_provisioning_uri')) {
        function twofa_provisioning_uri($secret, $label, $issuer)
        {
                $totp = TOTP::create($secret);
                $totp->setLabel($label);
                $totp->setIssuer($issuer);
                return $totp->getProvisioningUri();
        }
}

if (!function_exists('twofa_verify_code')) {
        function twofa_verify_code($secret, $code)
        {
                if (empty($secret) || empty($code)) {
                        return false;
                }
                $code = preg_replace('/\s+/', '', $code);
                $totp = TOTP::create($secret);
                return $totp->verify($code, null, 1);
        }
}

if (!function_exists('twofa_format_secret')) {
        function twofa_format_secret($secret)
        {
                return trim(chunk_split($secret, 4, ' '));
        }
}

?>
