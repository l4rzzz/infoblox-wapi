<?php

namespace L4rzzz\InfobloxWapi;

/**
 * Infoblox WAPI Client
 *
 * @package L4rzzz\InfobloxWapi
 */
class InfobloxWapi
{
    /**
     * @var GuzzleHttp\Client $client
     */
    protected $client;

    /**
     * @var string $adr IP addr or FQDN
     */
    private $adr;

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $certUri Infoblox web server cert uri. Download it from Infoblox web console.
     */
    private $certUri;

    /**
     * @var string $version WAPI version.
     */
    private $version;

    /**
     * @var integer $maxResults max results in a given query
     */
    private $maxResults=1000;

    /**
     * Sets object variables and initializes new \GuzzleHttp\Client.
     *
     * @param string $adr IP adr or FQDN
     * @param string $username
     * @param string $password
     * @param string $certUri Infoblox web server cert uri. Download it from Infoblox web console.
     * @param string $version WAPI version.
     */
    public function __construct($adr, $username, $password, $certUri, $version = '2.6.1')
    {
        $this->adr = $adr;
        $this->username = $username;
        $this->password = $password;
        $this->certUri = $certUri;
        $this->version = $version;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'https://' . $this->adr
        ]);
    }

    /**
     * Makes an authenticated HTTP GET request.
     *
     * @param  string $uri API endpoint URI.
     * @param  string $returnFields (optionnal) Will return default object fields if not set.
     * @return array Associative array with default return fields OR array containing StatusCode if query failed
     */
    public function httpGet($uri, $returnFields = '')
    {
        if (strpos($uri, '?')) {
            $return_type = '&_return_type=json';
        } else {
            $return_type = '?_return_type=json';
        }

        if ($returnFields != '') {
            $returnFields = '&_return_fields%2B=' . $returnFields;
        }

        if ($this->maxResults != '') {
            $maxResults = '&_max_results=' . $this->maxResults;
        }

        try {
            $response = $this->client->request(
                'GET',
                '/wapi/v' . $this->version . $uri . $return_type . $returnFields . $maxResults,
                [
                    'auth' => [$this->username, $this->password],
                    'verify' => $this->certUri
                ]
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ['StatusCode' => $e->getResponse()->getStatusCode(), 'Message' => $e->getMessage()];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return ['StatusCode' => '', 'Message' => $e->getMessage()];
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * Makes an authenticated HTTP POST request.
     *
     * @param  string $uri API endpoint URI.
     * @param  array $data Array will be converted to JSON.
     * @return string Object Reference for created object OR array containing StatusCode if query failed
     */
    public function httpPost($uri, $data)
    {
        if (strpos($uri, '?')) {
            $return_type = '&_return_type=json';
        } else {
            $return_type = '?_return_type=json';
        }

        try {
            $response = $this->client->request(
                'POST',
                '/wapi/v' . $this->version . $uri . $return_type,
                [
                    'auth' => [$this->username, $this->password],
                    'verify' => $this->certUri,
                    'json' => $data
                ]
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ['StatusCode' => $e->getResponse()->getStatusCode(), 'Message' => $e->getMessage()];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return ['StatusCode' => '', 'Message' => $e->getMessage()];
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * Makes an authenticated HTTP DELETE request to base URL with the obj reference added to URL string.
     *
     * @param  string Object Reference for object to delete.
     * @return string Object Reference for deleted object OR array containing StatusCode if query failed
     */
    public function httpDelete($objRef)
    {
        try {
            $response = $this->client->request(
                'DELETE',
                '/wapi/v' . $this->version . '/' . $objRef . '?_return_type=json',
                [
                    'auth' => [$this->username, $this->password],
                    'verify' => $this->certUri
                ]
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ['StatusCode' => $e->getResponse()->getStatusCode(), 'Message' => $e->getMessage()];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return ['StatusCode' => '', 'Message' => $e->getMessage()];
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * Makes an authenticated HTTP PUT request to base URL with obj reference added to URL string plus data as arg
     *
     * @param  string $objRef Object Reference for object to update
     * @param  array $data Array will be converted to JSON.
     * @return string Object Reference for updated object OR array containing StatusCode if query failed
     */
    public function httpPut($objRef, $data)
    {
        try {
            $response = $this->client->request(
                'PUT',
                '/wapi/v' . $this->version . '/' . $objRef . '?_return_type=json',
                [
                    'auth' => [$this->username, $this->password],
                    'verify' => $this->certUri,
                    'json' => $data
                ]
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ['StatusCode' => $e->getResponse()->getStatusCode(), 'Message' => $e->getMessage()];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return ['StatusCode' => '', 'Message' => $e->getMessage()];
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * Get object by object reference
     *
     * @param  string $objRef           ib object reference
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getObj($objRef, $returnFields = '')
    {
        $arr = self::httpGet('/' . $objRef, $returnFields);

        return $arr;
    }

    /**
     * Update object by object reference
     *
     * @param  string $objRef       object reference
     * @param  array $data          array representation of json data. see infoblox wapidoc
     * @return string               object reference of updated object
     */
    public function updateObj($objRef, $data)
    {
        $ref = self::httpPut($objRef, $data);

        return $ref;
    }

    /**
     * Delete object by object reference
     *
     * @param  string $objRef       object reference
     * @return string               object reference of deleted object
     */
    public function deleteObj($objRef)
    {
        $ref = self::httpDelete($objRef);

        return $ref;
    }

    /**
     * Set max results in a given query
     *
     * @param integer $maxResults max results in a given query
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
    }
}
