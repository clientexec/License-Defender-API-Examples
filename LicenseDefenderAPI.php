<?php
    // Change username to your Reseller Username
    define('RESELLER_USERNAME', 'username');
    // Change password to your Reseller Password
    define('RESELLER_PASSWORD', 'password');
    
    require_once 'classes/RestRequest.inc.php';
    class LicenseDefenderAPI {
        public $username;
        public $password;
        public $url = 'http://www.licensedefender.com/api/v1/';
        private $request;
        
        public function __construct()
        {
            $this->username = RESELLER_USERNAME;
            $this->password = RESELLER_PASSWORD;
            
            if ( $this->username == 'username' || $this->password == 'password' ) {
                throw new Exception('Please be sure to edit your reseller username and password.');
            }
        }
        
        public function getLicense($domain)
        {
            $this->request = new RestRequest($this->url . 'license/' . $domain, 'GET');
            $this->request->setUsername($this->username);
            $this->request->setPassword($this->password);
            $this->request->execute();
	    return $this->request->responseBody;
        }
        
        public function addLicense($domain)
        {
            $this->request = new RestRequest($this->url . 'license/', 'POST');
            $this->request->buildPostBody(array('domain'=>$domain));
            $this->request->setUsername($this->username);
            $this->request->setPassword($this->password);
            $this->request->execute();
        }
        
        public function deleteLicense($domain)
        {
            $this->request = new RestRequest($this->url . 'license/' . $domain, 'DELETE');
            $this->request->setUsername($this->username);
            $this->request->setPassword($this->password);
            $this->request->execute();
        }
    }
