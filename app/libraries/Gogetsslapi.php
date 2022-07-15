<?php

class GoGetSSLApi
{
    protected $key;
    protected $lastError;
    protected $lastStatus;
    protected $lastResponse;
    protected $apiUrl = 'https://my.gogetssl.com/api';

    public function __construct($key = null)
    {
        if (isset($key)) {
            $this->setKey($key);
        }
    }

    public function auth($user, $pass)
    {
        $response = $this->call('/auth/', [], [
            'user' => $user,
            'pass' => $pass
        ]);

        if (isset($response ['key'])) {
            $this->setKey($response ['key']);
            return $response;
        }

        return false;
    }

    public function addSslSan($orderId, $count)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call(
            '/orders/add_ssl_san_order/',
            ['auth_key' => $this->key],
            ['order_id' => $orderId, 'count' => $count]
        );
    }

    public function cancelSSLOrder($orderId, $reason)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call(
            '/orders/cancel_ssl_order/',
            ['auth_key' => $this->key],
            ['order_id' => $orderId, 'reason' => $reason]);
    }

    public function changeDcv($orderId, $data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/ssl/change_dcv/{$orderId}",
            ['auth_key' => $this->key],
            $data);
    }

    public function changeValidationEmail($orderId, $data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/ssl/change_validation_email/{$orderId}",
            ['auth_key' => $this->key],
            $data);
    }

    public function decodeCSR($csr, $brand = 1, $wildcard = 0)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/tools/csr/decode/',
            ['auth_key' => $this->key],
            ['csr' => $csr, 'brand' => $brand, 'wildcard' => $wildcard]);
    }

    /*
     * Get Domain Emails List
     */

    public function getWebServers($type)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/tools/webservers/{$type}", ['auth_key' => $this->key]);
    }

    public function getDomainAlternative($csr)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/tools/domain/alternative/',
            ['auth_key' => $this->key],
            ['csr' => trim($csr)]);
    }

    /*
     * Get Domain Emails List
     */

    public function getDomainEmails($domain)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/tools/domain/emails/',
            ['auth_key' => $this->key],
            ['domain' => $domain]);
    }

    public function getDomainEmailsForGeotrust($domain)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/tools/domain/emails/geotrust',
            ['auth_key' => $this->key],
            ['domain' => $domain]);
    }

    /**
     * @deprecated
     * @return mixed
     * @throws GoGetSSLAuthException
     */
    public function getAllProductPrices()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/products/all_prices/', ['auth_key' => $this->key]);
    }

    /**
     * @deprecated
     * @return mixed
     * @throws GoGetSSLAuthException
     */
    public function getAllProducts()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/products/', ['auth_key' => $this->key]);
    }

    public function getProduct($productId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/products/ssl/{$productId}", ['auth_key' => $this->key]);
    }

    public function getProducts()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/products/ssl/', ['auth_key' => $this->key]);
    }

    /**
     * @deprecated
     * @param int $productId
     * @return array
     * @throws GoGetSSLAuthException
     */
    public function getProductDetails($productId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/products/details/{$productId}", ['auth_key' => $this->key]);
    }

    /**
     * @deprecated
     * @param int $productId
     * @return array
     * @throws GoGetSSLAuthException
     */
    public function getProductPrice($productId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/products/price/{$productId}", ['auth_key' => $this->key]);
    }

    public function getUserAgreement($productId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/products/agreement/{$productId}", ['auth_key' => $this->key]);
    }

    public function getAccountBalance()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/account/balance/', ['auth_key' => $this->key]);
    }

    public function getAccountDetails()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthExceptio();
        }

        return $this->call('/account/', ['auth_key' => $this->key]);
    }

    public function getTotalOrders()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/account/total_orders/', ['auth_key' => $this->key]);
    }

    public function getAllInvoices()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/account/invoices/', ['auth_key' => $this->key]);
    }

    public function getUnpaidInvoices()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException ();
        }

        return $this->call('/account/invoices/unpaid/', ['auth_key' => $this->key]);
    }

    public function getTotalTransactions()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/account/total_transactions/', ['auth_key' => $this->key]);
    }

    public function addSSLOrder($data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/orders/add_ssl_order/', ['auth_key' => $this->key], $data);
    }

    public function addSSLRenewOrder($data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/orders/add_ssl_renew_order/', ['auth_key' => $this->key], $data);
    }

    public function reIssueOrder($orderId, $data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/ssl/reissue/{$orderId}", ['auth_key' => $this->key], $data);
    }
    
    public function addSandboxAccount($data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/accounts/sandbox/add/', ['auth_key' => $this->key], $data);
    }

    public function getOrderStatus($orderId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/status/{$orderId}", ['auth_key' => $this->key]);
    }

    public function comodoClaimFreeEV($orderId, $data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/ssl/comodo_claim_free_ev/{$orderId}" , ['auth_key' => $this->key], $data);
    }

    public function getOrderInvoice($orderId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/invoice/{$orderId}", ['auth_key' => $this->key]);
    }

    public function getUnpaidOrders()
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/orders/list/unpaid/', ['auth_key' => $this->key]);
    }

    public function resendEmail($orderId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/ssl/resend_validation_email/{$orderId}", ['auth_key' => $this->key]);
    }

    public function resendValidationEmail($orderId)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call("/orders/ssl/resend_validation_email/{$orderId}", ['auth_key' => $this->key]);
    }

    public function getCSR($data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/tools/csr/get/', ['auth_key' => $this->key], $data);
    }

    public function generateCSR($data)
    {
        if (!$this->key) {
            throw new GoGetSSLAuthException();
        }

        return $this->call('/tools/csr/generate/', ['auth_key' => $this->key], $data);
    }

    protected function call($uri, $getData = [], $postData = [])
    {
        $curl = curl_init();

        $endpoint = count($getData)
            ? "{$this->apiUrl}{$uri}?" . http_build_query($getData)
            : "{$this->apiUrl}{$uri}";

        $options = [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
        ];

        if (count($postData)) {
            $options[CURLOPT_CUSTOMREQUEST] = "POST";
            $options[CURLOPT_POSTFIELDS] = http_build_query($postData);
            $options[CURLOPT_HTTPHEADER] = ["Content-Type: application/x-www-form-urlencoded"];
        }

        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        $this->lastError = curl_error($curl);
        $this->lastStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $this->lastResponse = json_decode($response, true);
        curl_close($curl);

        return $this->lastResponse;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setUrl($url)
    {
        $this->apiUrl = $url;
    }

    public function getLastStatus()
    {
        return $this->lastStatus;
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }

}

class GoGetSSLAuthException extends Exception
{

    public function __construct()
    {
        parent::__construct('Please authorize first');
    }
}
