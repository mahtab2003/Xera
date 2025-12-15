<?php 
use AcmePhp\Ssl\Certificate;
use AcmePhp\Ssl\Generator\KeyPairGenerator;
use AcmePhp\Ssl\Generator\RsaKey\RsaKeyOption;
use InfinityFree\AcmeCore\Http\Base64SafeEncoder;
use InfinityFree\AcmeCore\Http\SecureHttpClientFactory;
use InfinityFree\AcmeCore\Http\ServerErrorHandler;
use AcmePhp\Ssl\KeyPair;
use AcmePhp\Ssl\PrivateKey;
use AcmePhp\Ssl\PublicKey;
use AcmePhp\Ssl\Parser\KeyParser;
use AcmePhp\Ssl\Signer\DataSigner;
use GuzzleHttp\Client as GuzzleHttpClient;
use InfinityFree\AcmeCore\AcmeClient;
use AcmePhp\Ssl\DistinguishedName;
use AcmePhp\Ssl\CertificateRequest;
use AcmePhp\Ssl\Signer\CertificateRequestSigner;
use InfinityFree\AcmeCore\Protocol\ExternalAccount;
use InfinityFree\AcmeCore\Protocol\CertificateOrder;

class acme extends CI_Model
{
    protected $acme;
    private $keyPair;
    private $publicKeyPath;
    private $privateKeyPath;

	function __construct()
	{
        $this->publicKeyPath = './acme-storage/'.$this->user->get_email().'/eab/account.pub.pem';
        $this->privateKeyPath = './acme-storage/'.$this->user->get_email().'/eab/account.pem';
        $directory = './acme-storage/'.$this->user->get_email().'/eab/';
        if (!file_exists($directory )) {
            mkdir($directory , 0777, true);
        }
        /*
        $publicKeyPath = 'account.pub.pem';
        $privateKeyPath = 'account.pem';
        */
        
        if (file_exists($this->privateKeyPath)) {
            $publicKey = new PublicKey(file_get_contents($this->publicKeyPath));
            $privateKey = new PrivateKey(file_get_contents($this->privateKeyPath));
            $this->keyPair = new KeyPair($publicKey, $privateKey);
        }
	}

    function initilize($autority, $key = null)
    {
        $ca_settings = $this->fetch_base();
        if (!array_key_exists('acme_'.$autority, $ca_settings)) {
            return 'Autority not valid.';
        }
        $ca_settings = $ca_settings['acme_'.$autority];
        if ($ca_settings == 'not-set') {
            return 'Autority not set by the admin, please use another.';
        }

        if ($key != null) {
            $res = $this->fetch(['key' => $key]);
		    if($res !== []) {
                $userKey = $res[0]['ssl_for'];
            } else {
                return False;
            }
            $res2 = $this->base->fetch(
                'is_user',
                ['key' => $userKey],
                'user_'
            );
            if ($res2 != []) {
                $this->publicKeyPath = './acme-storage/'.$res2[0]['user_email'].'/eab/account.pub.pem';
                $this->privateKeyPath = './acme-storage/'.$res2[0]['user_email'].'/eab/account.pem';
                $email = $res2[0]['user_email'];
            } else {
                return False;
            }
        } else {
            $email = $this->user->get_email();
        }
        
        if (!file_exists($this->privateKeyPath)) {
            $keyPairGenerator = new KeyPairGenerator();
            $this->keyPair = $keyPairGenerator->generateKeyPair();
            file_put_contents($this->publicKeyPath, $this->keyPair->getPublicKey()->getPEM());
            file_put_contents($this->privateKeyPath, $this->keyPair->getPrivateKey()->getPEM());
            
            $secureHttpClientFactory = new SecureHttpClientFactory(
                new GuzzleHttpClient(),
                new Base64SafeEncoder(),
                new KeyParser(),
                new DataSigner(),
                new ServerErrorHandler()
            );

            $secureHttpClient = $secureHttpClientFactory->createSecureHttpClient($this->keyPair);
            if ($autority == 'letsencrypt') {
                $this->acme = new AcmeClient($secureHttpClient, $ca_settings);
                $this->acme->registerAccount($email);
                return True;
            } elseif ($autority == 'zerossl') {
                $ca_settings = $this->get_zerossl();
                if ($ca_settings['url'] != '' && $ca_settings['eab_kid'] != '' && $ca_settings['eab_hmac_key'] != '') {
                    $this->acme = new AcmeClient($secureHttpClient, $ca_settings['url']);
                    $this->acme->registerAccount($email, new ExternalAccount($ca_settings['eab_kid'], $ca_settings['eab_hmac_key']));
                    return True;
                }
            } elseif ($autority == 'googletrust') {
                $ca_settings = $this->get_googletrust();
                if ($ca_settings['url'] != '' && $ca_settings['eab_kid'] != '' && $ca_settings['eab_hmac_key'] != '') {
                    $this->acme = new AcmeClient($secureHttpClient, $ca_settings['url']);
                    $this->acme->registerAccount($email, new ExternalAccount($ca_settings['eab_kid'], $ca_settings['eab_hmac_key']));
                    return True;
                }
            }
            return False;
        } else {
            $publicKey = new PublicKey(file_get_contents($this->publicKeyPath));
            $privateKey = new PrivateKey(file_get_contents($this->privateKeyPath));
            $this->keyPair = new KeyPair($publicKey, $privateKey);

            $secureHttpClientFactory = new SecureHttpClientFactory(
                new GuzzleHttpClient(),
                new Base64SafeEncoder(),
                new KeyParser(),
                new DataSigner(),
                new ServerErrorHandler()
            );

            $secureHttpClient = $secureHttpClientFactory->createSecureHttpClient($this->keyPair);
            if ($autority == 'letsencrypt') {
                $this->acme = new AcmeClient($secureHttpClient, $ca_settings);
                $this->acme->registerAccount($email);
                return True;
            } elseif ($autority == 'zerossl') {
                $ca_settings = $this->get_zerossl();
                if ($ca_settings['url'] != '' && $ca_settings['eab_kid'] != '' && $ca_settings['eab_hmac_key'] != '') {
                    $this->acme = new AcmeClient($secureHttpClient, $ca_settings['url']);
                    $this->acme->registerAccount($email, new ExternalAccount($ca_settings['eab_kid'], $ca_settings['eab_hmac_key']));
                    return True;
                }
            } elseif ($autority == 'googletrust') {
                $ca_settings = $this->get_googletrust();
                if ($ca_settings['url'] != '' && $ca_settings['eab_kid'] != '' && $ca_settings['eab_hmac_key'] != '') {
                    $this->acme = new AcmeClient($secureHttpClient, $ca_settings['url']);
                    $this->acme->registerAccount($email, new ExternalAccount($ca_settings['eab_kid'], $ca_settings['eab_hmac_key']));
                    return True;
                }
            }
            return False;
        }
    }
    
    function registerAccount()
    {
        $this->acme->registerAccount(null, new ExternalAccount($this->user->get_id(), 'mailto:'.$this->user->get_email()));
    }

    public function create_ssl($domain, $autority)
    {
    try {
        $directory = './acme-storage/'.$this->user->get_email().'/certificates/';
        if (!file_exists($directory )) {
            mkdir($directory , 0777, true);
        }

        $keyPairGenerator = new KeyPairGenerator();
        $domainKeyPair = $keyPairGenerator->generateKeyPair(new RsaKeyOption(2048));

        $certificateOrder = $this->acme->requestOrder([$domain]);

        $allChallenges = $certificateOrder->getAuthorizationChallenges();
        $challenges = $allChallenges[$domain];
        $dnsChallenge = null;
        foreach ($challenges as $challenge) {
            if ($challenge->getType() === 'dns-01') {
                $dnsChallenge = $challenge;
                break;
            }
        }
        if (!$dnsChallenge) {
            throw new Exception('DNS-01 challenge not found.');
        }

        $digest = hash('sha256', $dnsChallenge->getPayload(), true);
        $base64urlDigest = rtrim(strtr(base64_encode($digest), '+/', '-_'), '=');
        $dnsContent = $base64urlDigest;

        $key = md5($this->base->get_hostname() . ':' . $this->user->get_email() . ':' . $certificateOrder->getOrderEndpoint() . ':' . time());
        $key = substr($key, 0, 20);

        $this->load->library('acmedns');
        $acmednsUrl = 'https://auth.acme-dns.io';
        $acmedns = new Acmedns();
        $acmedns->setProvider($acmednsUrl);

        $addResult = true;
        $registrationDetails = $acmedns->registerDomain();
        if ($registrationDetails) {
            $username = $registrationDetails['username'];
            $password = $registrationDetails['password'];
            $subdomain = $registrationDetails['subdomain'];
            $cnameRecord = $registrationDetails['fulldomain'];
        
            if (!$acmedns->updateTxtRecord($username, $password, $subdomain, $dnsContent)) {
                $addResult = false;
            }
        } else {
            $addResult = false;
        }
        $registrationDetails = json_encode($registrationDetails);

        $data = [
            'ssl_pid' => $certificateOrder->getOrderEndpoint(),
            'ssl_key' => $key,
            'ssl_for' => $this->user->get_key(),
            'ssl_type' => $autority,
            'ssl_status' => 'pending',
            'ssl_domain' => $domain,
            'ssl_dns' => $dnsContent,
            'ssl_dnsid' => ''
        ];
        if ($addResult) {
            $data['ssl_dns'] = $cnameRecord;
            $data['ssl_dnsid'] = $registrationDetails;
        }
        $res = $this->db->insert('is_ssl', $data);

		if($res !== false)
		{
            $privateDir = './acme-storage/'.$this->user->get_email().'/certificates/'.$key.'.priv.pem';
            $privateKey = $domainKeyPair->getPrivateKey()->getPEM();
            file_put_contents($privateDir, $privateKey);
			return true;
		}
    } catch (Throwable $e) {
      return $e->getMessage();
    }
		return false;
    }

    public function checkValidation($key, $domain, $dnsContent)
    {
        $dnsSettings = $this->get_dns();
        $domain = '_acme-challenge.'.$domain;
        $recordType = "CNAME";
        $this->load->library('dnsquery');
        $dnsRes = new DNSQuery();

        if ($dnsSettings['resolver'] == '' || $dnsSettings['resolver'] == null) {
            return false;
        }

        if ($dnsSettings['doh'] == 'active') {
            $record = $dnsRes->queryDnsRecordHttp($dnsSettings['resolver'], $domain, $recordType);
        } else {
            $record = $dnsRes->queryDnsRecord($dnsSettings['resolver'], $domain, $recordType);
        }

        if ($record == false) {
            return false;
        }

        if ($record == $dnsContent || $record == $dnsContent.'.') {
            $res = $this->base->update(
                ['status' => 'ready'],
                ['key' => $key],
                'is_ssl',
                'ssl_'
            );
            if ($res != false) {
                return true;
            }
        }
        return false;
    }

    public function validateOrder($key) {
        $res = $this->fetch(['key' => $key]);
		if($res !== [] && $res[0]['ssl_status'] == 'ready') {
            $orderId = $res[0]['ssl_pid'];
            $domain = $res[0]['ssl_domain'];
            $userKey = $res[0]['ssl_for'];
            $dnsid = $res[0]['ssl_dnsid'];
        } else {
            return False;
        }
        $res2 = $this->base->fetch(
			'is_user',
			['key' => $userKey],
			'user_'
		);
        if ($res2 == [] || $res2 == False) {
            return False;
        }

        $privateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.priv.pem';
        if (file_exists($privateDir)) {
            $privateKey = file_get_contents($privateDir);
        }

        $res_in = $this->initilize($res[0]['ssl_type'], $res[0]['ssl_key']);
        if(!is_bool($res_in))
		{
			return 'Cant connect to CA autority.';
		}
		elseif(is_bool($res_in) AND $res_in == false)
		{
            return False;
		}

        $order = new CertificateOrder([], $orderId);
        $order = $this->acme->reloadOrder($order);

        $privateKey = new PrivateKey($privateKey);
        $publicKey = $privateKey->getPublicKey();
        $domainKeyPair = new KeyPair($publicKey, $privateKey);

        $allChallenges = $order->getAuthorizationChallenges();
        $challenges = $allChallenges[$domain];

        $dnsChallenge = null;
        foreach ($challenges as $challenge) {
            if ($challenge->getType() === 'dns-01') {
                $dnsChallenge = $challenge;
                break;
            }
        }
        if (!$dnsChallenge) {
            return false;
        }
        try {
            $challenge = $this->acme->challengeAuthorization($dnsChallenge);
            if ($challenge->getStatus() == 'valid') {
                $dn = new DistinguishedName($domain);
                $csr = new CertificateRequest($dn, $domainKeyPair);
                $this->acme->finalizeOrder($order, $csr, 180, false);
                $res = $this->base->update(
                    ['status' => 'processing'],
                    ['key' => $key],
                    'is_ssl',
                    'ssl_'
                );
                if ($res != false) {
                    return true;
                }
            }
        } catch (Throwable $e) {
            if (strpos($e->getMessage(), 'authorization must be pending') !== false) {                
                $res = $this->base->update(
                    ['status' => 'cancelled'],
                    ['key' => $key],
                    'is_ssl',
                    'ssl_'
                );
            }
            return false;
        }
        return false;
    }

    public function getCertificate($orderId, $privateKey)
    {
    try {
        $privateKey = new PrivateKey($privateKey);
        $publicKey = $privateKey->getPublicKey();
        $domainKeyPair = new KeyPair($publicKey, $privateKey);

        $order = new CertificateOrder([], $orderId);
        $order = $this->acme->reloadOrder($order);

        if ($order->getStatus() == 'valid') {
            $certificate = $this->acme->retrieveCertificate($order);

            $privateKey = $domainKeyPair->getPrivateKey()->getPem();
            $certificateCode = $certificate->getPem();
            $intermediateCode = $certificate->getIssuerCertificate()->getPEM();

            $return = [
                'private_key' => $privateKey,
                'certificate_code' => $certificateCode,
                'intermediate_code' => $intermediateCode,
            ];

            return $return;
        }
    } catch (Throwable $e) {
      return false;
    }
        return False;
    }

    function get_ssl_info($key)
    {
        $res = $this->fetch(['key' => $key]);
		if($res !== []) {
            $orderId = $res[0]['ssl_pid'];
            $status = $res[0]['ssl_status'];
            $domain = $res[0]['ssl_domain'];
            $userKey = $res[0]['ssl_for'];
            $dnsContent = $res[0]['ssl_dns'];
            $dnsid = $res[0]['ssl_dnsid'];
        } else {
            return False;
        }

        $res2 = $this->base->fetch(
			'is_user',
			['key' => $userKey],
			'user_'
		);
        if ($res2 == [] && $res2 == False) {
            return False;
        }

        $directory = './acme-storage/'.$res2[0]['user_email'].'/certificates/';
        if (!file_exists($directory )) {
            mkdir($directory , 0777, true);
        }

        $privateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.priv.pem';
        if (!file_exists($privateDir)) {
            $privateKey = $res[0]['ssl_private'];
            file_put_contents($privateDir, $privateKey);
        } else {
            $privateKey = file_get_contents($privateDir);
        }

        $type = 'Unknow';
        switch ($res[0]['ssl_type']) {
            case 'letsencrypt':
                $type = "Let's Encrypt";
                break;
            case 'zerossl':
                $type = "ZeroSSL";
                break;
            case 'googletrust':
                $type = "Google Trust Services";
                break;
            default:
                $type = "GoGetSSL";
                break;
        }

        $csrDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.csr';
        if (!file_exists($csrDir)) {
            $privateKeyObj = new PrivateKey($privateKey);
            $publicKey = $privateKeyObj->getPublicKey();
            $domainKeyPair = new KeyPair($publicKey, $privateKeyObj);

            $dn = new DistinguishedName($domain);
            $csr = new CertificateRequest($dn, $domainKeyPair);
            $csrSigner = new CertificateRequestSigner();
            $csrCode = $csrSigner->signCertificateRequest($csr);
            file_put_contents($csrDir, $csrCode);
        } else {
            $csrCode = file_get_contents($csrDir);
        }
        
        $return = [
            'status' => $status,
            'begin_date' => '---- -- --',
            'end_date' => '---- -- --',
            'csr_code' => $csrCode,
            'domain' => $domain,
            'type' => $type
        ];

        if ($status == 'active') {
            $certificateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.pem';
            $intermediateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.ca.pem';
            if (!file_exists($certificateDir) || !file_exists($intermediateDir)) {
                $res_in = $this->initilize($res[0]['ssl_type']);
                if(!is_bool($res_in))
			    {
			    	return 'Cant connect to CA autority.';
			    }
			    elseif(is_bool($res_in) AND $res_in == false)
			    {
                    return False;
			    }
                $certificate = $this->getCertificate($orderId, $privateKey);
                if ($certificate == False) {
                    return False;
                }
                file_put_contents($certificateDir, $certificate['certificate_code']);
                file_put_contents($intermediateDir, $certificate['intermediate_code']);
            } else {
                $certificate['certificate_code'] = file_get_contents($certificateDir);
                $certificate['intermediate_code'] = file_get_contents($intermediateDir);
            }
            $cert = openssl_x509_read($certificate['certificate_code']);
            $creationDate = openssl_x509_parse($cert)['validFrom_time_t'];
            $expirynDate = openssl_x509_parse($cert)['validTo_time_t'];
            $creationDate = new DateTime("@$creationDate");
            $expirynDate = new DateTime("@$expirynDate");

            if (new DateTime() >= $expirynDate) {
                $status = 'expired';
                $res = $this->base->update(
                    ['status' => $status],
                    ['key' => $key],
                    'is_ssl',
                    'ssl_'
                );
            }
            $return['private_key'] = $privateKey;
            $return['begin_date'] = $creationDate->format('Y-m-d');
            $return['end_date'] = $expirynDate->format('Y-m-d');
            $return['crt_code'] = $certificate['certificate_code'];
            $return['ca_code'] = $certificate['intermediate_code'];
        } elseif ($status == 'cancelled' || $status == 'expired') {
            $return['private_key'] = $privateKey;
            $return['begin_date'] = '---- -- --';
            $return['end_date'] = '---- -- --';
            $return['crt_code'] = '';
            $return['ca_code'] = '';
        } elseif ($status == 'pending') {
            $return['ready'] = false;
            if ($this->checkValidation($key, $domain, $dnsContent)) {
                $return['status'] = 'ready';
                $return['ready'] = true;
            }
            $return['approver_method']['dns']['record'] = '_acme-challenge.'.$domain.' TXT '.$dnsContent;
            if ($dnsid != '' && $dnsid != null) {
                $return['approver_method']['dns']['record'] = '_acme-challenge.'.$domain.' CNAME '.$dnsContent;
            }
        } elseif ($status == 'ready') {
            $return['ready'] = true;
            $return['approver_method']['dns']['record'] = '_acme-challenge.'.$domain.' TXT '.$dnsContent;
            if ($dnsid != '' && $dnsid != null) {
                $return['approver_method']['dns']['record'] = '_acme-challenge.'.$domain.' CNAME '.$dnsContent;
            }
        } elseif ($status == 'processing') {
            $return['approver_method']['dns']['record'] = '_acme-challenge.'.$domain.' TXT '.$dnsContent;
            $this->initilize($res[0]['ssl_type']);
            if ($this->getCertificate($orderId, $privateKey)) {
                $status = 'active';
                $return['private_key'] = $privateKey;
    
                $certificateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.pem';
                $intermediateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.ca.pem';
                if (!file_exists($certificateDir) || !file_exists($intermediateDir)) {
                    $certificate = $this->getCertificate($orderId, $privateKey);
                    if ($certificate == False) {
                        return False;
                    }
                    file_put_contents($certificateDir, $certificate['certificate_code']);
                    file_put_contents($intermediateDir, $certificate['intermediate_code']);
                } else {
                    $certificate['certificate_code'] = file_get_contents($certificateDir);
                    $certificate['intermediate_code'] = file_get_contents($intermediateDir);
                }
    
                $cert = openssl_x509_read($certificate['certificate_code']);
    
                $creationDate = openssl_x509_parse($cert)['validFrom_time_t'];
                $expirynDate = openssl_x509_parse($cert)['validTo_time_t'];
                $creationDate = new DateTime("@$creationDate");
                $expirynDate = new DateTime("@$expirynDate");
    
                if (new DateTime() >= $expirynDate) {
                    $status = 'expired';
                }
    
                $res = $this->base->update(
                    ['status' => $status],
                    ['key' => $key],
                    'is_ssl',
                    'ssl_'
                );

                $return['status'] = $status;
                $return['begin_date'] = $creationDate->format('Y-m-d');
                $return['end_date'] = $expirynDate->format('Y-m-d');
                $return['crt_code'] = $certificate['certificate_code'];
                $return['ca_code'] = $certificate['intermediate_code'];
            }
        }
        return $return;
    }

    function getOrderStatus($orderId) {
        $res = $this->fetch(['pid' => $orderId]);
		if($res !== []) {
            $status = $res[0]['ssl_status'];
            $domain = $res[0]['ssl_domain'];
            $key = $res[0]['ssl_key'];
            $userKey = $res[0]['ssl_for'];
            $dnsContent = $res[0]['ssl_dns'];
        }

        $res2 = $this->base->fetch(
			'is_user',
			['key' => $userKey],
			'user_'
		);
        if ($res2 == [] && $res2 == False) {
            return False;
        }

        $privateDir = './acme-storage/'.$res2[0]['user_email'].'/certificates/'.$key.'.priv.pem';
        if (file_exists($privateDir)) {
            $privateKey = file_get_contents($privateDir);
        }

        if ($status == 'active') {
            return [
                'status' => $status,
                'domain' => $domain
            ];
        } elseif ($status == 'cancelled' || $status == 'expired') {
            return [
                'status' => $status,
                'domain' => $domain
            ];
        } elseif ($status == 'pending') {
            if ($this->checkValidation($key, $domain, $dnsContent)) {
                $status = 'ready';
            }
            return [
                'status' => $status,
                'domain' => $domain
            ];
        } elseif ($status == 'ready') {
            return [
                'status' => $status,
                'domain' => $domain
            ];
        }
        return False;
    }

    function cancel_ssl($key, $reason)
    {
        $res = $this->fetch(['key' => $key]);
		if($res !== []) {
            $orderId = $res[0]['ssl_pid'];
            $privateKey = $res[0]['ssl_private'];
        } else {
            return False;
        }

        $certificate = $this->getCertificate($orderId, $privateKey);

        if ($this->acme->revokeCertificate(new Certificate($certificate['certificate_code'], $reason))) {
            return True;
        }
        return False;
    }

    function get_ssl_list()
	{
		$res = $this->fetch(['for' => $this->user->get_key()]);
		if($res !== false)
		{
			$arr = [];
			if(count($res)>0)
			{
				foreach ($res as $key) {
					if ($key['ssl_type'] == 'letsencrypt') {
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "Let's Encrypt";
                    } elseif ($key['ssl_type'] == 'zerossl') {
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "ZeroSSL";
                    } elseif ($key['ssl_type'] == 'googletrust') {
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "Google Trust Services";
                    } else {
						continue; // Skip GoGetSSL or unknown
					}
					$data['key'] = $key['ssl_key'];
					$arr[] = $data;
				}
				return $arr;
			}
			return $arr;
		}
		return false;
	}

	function get_ssl_list_all($count = 0)
	{
		$res = $this->fetch();
		if($res !== false)
		{
			$arr = [];
			if(count($res)>0)
			{
				foreach ($res as $key) {
					if ($key['ssl_type'] == 'letsencrypt') {
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "Let's Encrypt";
                    } elseif ($key['ssl_type'] == 'zerossl') {
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "ZeroSSL";
                    } elseif ($key['ssl_type'] == 'googletrust') {
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "Google Trust Services";
                    } else {
						continue; // Skip GoGetSSL or unknown
					}
					$data['key'] = $key['ssl_key'];
					$arr[] = $data;
				}
			}
			$list = [];
			if($count != 0)
			{
				$count = $count * $this->base->rpp();
			}
			for ($i = $count; $i < count($arr); $i++) { 
				if($i >= $count + $this->base->rpp())
				{
					break;
				}
				else
				{
					$list[] = $arr[$i];
				}
			}
			return $list;
		}
		return false;
	}

	function list_count()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			$arr = [];
			if(count($res)>0)
			{
				foreach ($res as $key) {
					if ($key['ssl_type'] == 'letsencrypt') {
                        $this->initilize($key['ssl_type']);
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "Let's Encrypt";
                    } elseif ($key['ssl_type'] == 'zerossl') {
                        $this->initilize($key['ssl_type']);
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "ZeroSSL";
                    } elseif ($key['ssl_type'] == 'googletrust') {
                        $this->initilize($key['ssl_type']);
                        $data = $this->getOrderStatus($key['ssl_pid']);
                        $data['type'] = "Google Trust Services";
                    } else {
						continue; // Skip GoGetSSL
					}
					$data['key'] = $key['ssl_key'];
					$arr[] = $data;
				}
			}
			return count($arr);
		}
		return false;
	}

    function get_letsencrypt()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['acme_letsencrypt'];
		}
		return false;
	}

    function get_zerossl()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
            if ($res['acme_zerossl'] != 'not-set') {
                $zerossl = json_decode($res['acme_zerossl'], true);
                $return = [
                    'url' => $zerossl['url'],
                    'eab_kid' => $zerossl['eab_kid'],
                    'eab_hmac_key' => $zerossl['eab_hmac_key']
                ];
			    return $return;
            } else {
                return 'not-set';
            }
		}
		return false;
	}

    function get_googletrust()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
            if ($res['acme_googletrust'] != 'not-set') {
                $googletrust = json_decode($res['acme_googletrust'], true);
                $return = [
                    'url' => $googletrust['url'],
                    'eab_kid' => $googletrust['eab_kid'],
                    'eab_hmac_key' => $googletrust['eab_hmac_key']
                ];
			    return $return;
            } else {
                return 'not-set';
            }
		}
		return false;
	}

    function get_dns()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
            if ($res['acme_dns'] != '') {
                $dnsSettings = json_decode($res['acme_dns'], true);
                $return = [
                    'doh' => $dnsSettings['doh'],
                    'resolver' => $dnsSettings['resolver']
                ];
			    return $return;
            } else {
                return [
                    'doh' => 'active',
                    'resolver' => 'dns.google'
                ];
            }
		}
		return false;
	}

    function set_letsencrypt($acme_directory)
	{
		$res = $this->update('letsencrypt', $acme_directory);
		if($res)
		{
			return true;
		}
		return false;
	}

    function set_zerossl($zerossl)
	{
        if ($zerossl == 'not-set') {
            $res = $this->update('zerossl', $zerossl);
        } else {
            if ($zerossl['url'] == '' && $zerossl['eab_kid'] == '' && $zerossl['eab_hmac_key'] == '') {
                $zerossl = 'not-set';
            } else {
                $zerossl = json_encode($zerossl);
            }
            $res = $this->update('zerossl', $zerossl);
        }
		if($res)
		{
			return true;
		}
		return false;
	}

    function set_googletrust($googletrust)
	{
        if ($googletrust == 'not-set') {
            $res = $this->update('googletrust', $googletrust);
        } else {
            if ($googletrust['url'] == '' && $googletrust['eab_kid'] == '' && $googletrust['eab_hmac_key'] == '') {
                $googletrust = 'not-set';
            } else {
                $googletrust = json_encode($googletrust);
            }
            $res = $this->update('googletrust', $googletrust);
        }
		if($res)
		{
			return true;
		}
		return false;
	}

    function set_dns($dnsSetings)
	{
        $dnsSetings = json_encode($dnsSetings);
        $res = $this->update('dns', $dnsSetings);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function is_active()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			if($res['acme_status'] === 'active')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_status()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['acme_status'];
		}
		return false;
	}

    function set_status(bool $status)
	{
		if($status === true)
		{ 
			$status = 'active';
		}
		else
		{
			$status = 'inactive';
		}
		$res = $this->update('status', $status);
		if($res)
		{
			return true;
		}
		return false;
	}

    private function update($index, $value)
	{
		$res = $this->base->update(
			[$index => $value],
			['id' => 'xera_acme'],
			'is_acme',
			'acme_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

    private function fetch_base()
	{
		$res = $this->base->fetch(
			'is_acme',
			['id' => 'xera_acme'],
			'acme_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}

	private function fetch($where = [])
	{
		$res = $this->base->fetch(
			'is_ssl',
			$where,
			'ssl_'
		);
		return $res;
	}
}
