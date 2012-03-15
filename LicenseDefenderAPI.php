<?php

require_once('classes/RestRequest.inc.php');

class LicenseDefenderRestAPI {
    public $username;
    public $password;
    public $url = 'http://www.licensedefender.com/api/v1/';
    private $request;

    public function __construct($user, $pass)
    {
        $this->username = $user;
        $this->password = $pass;

        if ( $this->username == '' || $this->password == '' ) {
            throw new Exception('Please be sure to edit your reseller username and password.');
        }
    }

    public function getLicense($domain)
    {
        $this->request = new RestRequest($this->url . 'license/' . $domain, 'GET');
        $this->request->setUsername($this->username);
        $this->request->setPassword($this->password);
        $this->request->execute();
        return $this->request->getResponseBody();
    }

    public function addLicense($domain)
    {
        $this->request = new RestRequest($this->url . 'license/', 'POST');
        $this->request->buildPostBody(array('domain'=>$domain));
        $this->request->setUsername($this->username);
        $this->request->setPassword($this->password);
        $this->request->execute();
        return $this->request->getResponseBody();
    }

    public function deleteLicense($domain)
    {
        $this->request = new RestRequest($this->url . 'license/' . $domain, 'DELETE');
        $this->request->setUsername($this->username);
        $this->request->setPassword($this->password);
        $this->request->execute();
        return $this->request->getResponseBody();
    }
}