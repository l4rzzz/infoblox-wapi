<?php

namespace L4rzzz\InfobloxWapi\Dns;

/**
 * Infoblox Dns
 *
 * @package L4rzzz\InfobloxWapi
 */
class Dns extends \L4rzzz\InfobloxWapi\InfobloxWapi
{
    /**
     * Entry type
     *
     * @var string
     */
    private $creator = 'STATIC';    //defaults to STATIC to filter DDNS records

    /**
     * Get all records by zone
     *
     * @param  string $zone DNS zone
     * @return array        Associative array
     */
    public function getAllRecord($zone)
    {
        $arr = $this->httpGet('/allrecords?zone=' . $zone);

        return $arr;
    }

    /**
     * Get A record by name
     *
     * @param  string $name             FQDN
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getAByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?name=' . $name .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get A record by IP address
     *
     * @param  string $ipv4addr         IPv4 address
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getAByAddr($ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?ipv4addr=' . $ipv4addr .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get A Record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getAByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get A record by Name and IP address.
     *
     * @param  string $name             FQDN
     * @param  string $ipv4addr         IPv4 address
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getAByNameAddr($name, $ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?name=' . $name .
            '&ipv4addr=' . $ipv4addr .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get A record by Name and extensible attribute
     *
     * @param  string $name             FQDN
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getAByNameAttr($name, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?name=' . $name .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get A record by IP address and extensible attribute
     *
     * @param  string $ipv4addr         IPv4 address
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getAByAddrAttr($ipv4addr, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?ipv4addr=' . $ipv4addr .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get A record object reference
     *
     * @param  string $name         name
     * @param  string $ipv4addr     IP address
     * @param  string $view         view
     * @return string               Object reference or empty string if record not found
     */
    public function getAObj($name, $ipv4addr, $view)
    {
        $obj = $this->httpGet('/record:a?ipv4addr=' . $ipv4addr . '&name=' . $name . '&view=' . $view);

        if (!empty($obj)) {
            return $obj[0]['_ref'];
        } else {
            return "";
        }
    }

    /**
     * Search A record by name
     *
     * @param  string $name             string to match in name field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchAByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?name~=' . $name .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search A record by address
     *
     * @param  string $ipv4addr         IP address
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchAByAddr($ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?ipv4addr~=' . $ipv4addr .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search A record by address and extensible attribute
     *
     * @param  string $ipv4addr         IP address
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchAByAddrAttr($ipv4addr, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?ipv4addr~=' . $ipv4addr .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search A record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValueString  string to search in extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchAByAttr($attrName, $attrValueString, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?*' . $attrName . '~=' . $attrValueString .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search A record by name and extensible attribute
     *
     * @param  string $name             string to match in name field
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchAByNameAttr($name, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:a?name~=' . $name .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record by name
     *
     * @param  string $name             FQDN
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getCnameByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?name=' . $name,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record by canonical
     *
     * @param  string $canonical        canonical name
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getCnameByCanon($canonical, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?canonical=' . $canonical,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getCnameByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record by name and canonical
     *
     * @param  string $name             FQDN
     * @param  string $canonical        canonical name
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getCnameByNameCanon($name, $canonical, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?name=' . $name .
            '&canonical=' . $canonical,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record by name and extensible attribute
     *
     * @param  string $name             FQDN
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getCnameByNameAttr($name, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?name=' . $name .
            '&*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record by canonical and extensible attribute
     *
     * @param  string $canonical        canonical name
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getCnameByCanonAttr($canonical, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?canonical=' . $canonical .
            '&*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get CNAME record object reference
     *
     * @param  string $name         name
     * @param  string $canonical    canonical name
     * @param  string $view         view
     * @return string Object        Object reference or empty string if record not found
     */
    public function getCnameObj($name, $canonical, $view)
    {
        $obj = $this->httpGet('/record:cname?canonical=' . $canonical . '&name=' . $name . '&view=' . $view);

        if (!empty($obj)) {
            return $obj[0]['_ref'];
        } else {
            return "";
        }
    }

    /**
     * Search CNAME record by name
     *
     * @param  string $name             string to match in name field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchCnameByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?name~=' . $name .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search CNAME record by canonical name
     *
     * @param  string $canonical        string to match in canonical name field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchCnameByCanon($canonical, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?canonical~=' . $canonical .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search CNAME record by canonical name and extensible attribute
     *
     * @param  string $canonical        string to match in canonical name field
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchCnameByCanonAttr($canonical, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?canonical~=' . $canonical .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search CNAME record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValueString  string to search in extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchCnameByAttr($attrName, $attrValueString, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?*' . $attrName . '~=' . $attrValueString .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search CNAME record by name and extensible attribute
     *
     * @param  string $name             string to match in name field
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchCnameByNameAttr($name, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:cname?name~=' . $name .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get PTR record by PTR name
     *
     * @param  string $name             reverse mapping FQDN (ie: 1.0.168.192.in-addr.arpa)
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getPtrByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:ptr?name=' . $name,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get PTR record by PTR domain name
     *
     * @param  string $ptrdname         forward FQDN (ie: test.mydomain.com)
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getPtrByDname($ptrdname, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:ptr?ptrdname=' . $ptrdname,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get PTR record by IP addr
     *
     * @param  string $ipv4addr         IPv4 address
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getPtrByAddr($ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:ptr?ipv4addr=' . $ipv4addr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get PTR record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getPtrByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:ptr?*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get PTR record by PTR domain name and IP address
     *
     * @param  string $ptrdname         forward FQDN (ie: test.mydomain.com)
     * @param  string $ipv4addr         IPv4 address
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getPtrByDnameAddr($ptrdname, $ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:ptr?ptrdname=' . $ptrdname .
            '&ipv4addr=' . $ipv4addr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get PTR record object reference
     *
     * @param  string $ptrdname     FQDN
     * @param  string $ipv4addr     IP address
     * @param  string $view         view
     * @return string               Object reference or empty string if record not found
     */
    public function getPtrObj($ptrdname, $ipv4addr, $view)
    {
        $obj = $this->httpGet('/record:ptr?ipv4addr=' . $ipv4addr . '&ptrdname=' . $ptrdname . '&view=' . $view);

        if (!empty($obj)) {
            return $obj[0]['_ref'];
        } else {
            return "";
        }
    }

    /**
     * Get MX record by name
     *
     * @param  string $name             FQDN
     * @param  string $returnFields     comma separated return fields needed in response
     * @return array                    array of associative arrays
     */
    public function getMxByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?name=' . $name,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get MX record by mail exchanger
     *
     * @param  string $mailExchgr    FQDN
     * @param  string $returnFields     comma separated return fields needed in response
     * @return array                    array of associative arrays
     */
    public function getMxByExchgr($mailExchgr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?mail_exchanger=' . $mailExchgr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get MX record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getMxByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get MX record by name and mail exchanger
     *
     * @param  string $name             FQDN
     * @param  string $mailExchgr       FQDN
     * @param  string $returnFields     comma separated return fields needed in response
     * @return array                    array of associative arrays
     */
    public function getMxByNameExchgr($name, $mailExchgr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?name=' . $name .
            '&mail_exchanger=' . $mailExchgr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get MX record by name and extensible attribute
     *
     * @param  string $name             FQDN
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response
     * @return array                    array of associative arrays
     */
    public function getMxByNameAttr($name, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?name=' . $name .
            '&*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get MX record by mail exchanger and extensible attribute
     *
     * @param  string $mailExchgr       FQDN
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response
     * @return array                    array of associative arrays
     */
    public function getMxByExchgrAttr($mailExchgr, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?mail_exchanger=' . $mailExchgr .
            '&*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get MX record object reference
     *
     * @param  string $name             FQDN
     * @param  string $mailExchgr       mail exchanger FQDN
     * @param  string $view             view
     * @return string                   Object reference or empty string if record not found
     */
    public function getMxObj($name, $mailExchgr, $view)
    {
        $obj = $this->httpGet('/record:mx?mail_exchanger=' . $mailExchgr . '&name=' . $name . '&view=' . $view);

        if (!empty($obj)) {
            return $obj[0]['_ref'];
        } else {
            return "";
        }
    }

    /**
     * Search MX record by name
     *
     * @param  string $name             string to match in name field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchMxByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?name~=' . $name .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search MX record by mail exchanger
     *
     * @param  string $exchgr           string to match in mail exchanger field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchMxByExchgr($exchgr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?mail_exchanger~=' . $exchgr .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search MX record by mail exchanger and extensible attribute
     *
     * @param  string $exchgr           string to match in mail exchanger field
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchMxByExchgrAttr($exchgr, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:mx?mail_exchanger~=' . $exchgr .
            '&*' . $attrName . '=' . $attrValue .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT record by name
     *
     * @param  string $name             FQDN
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getTxtByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?name=' . $name,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT record by text value
     *
     * @param  string $text             Text value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getTxtByText($text, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?text=' . $text,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT Record by extensible attribute
     *
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getTxtByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT record by name and text
     *
     * @param  string $name             FQDN
     * @param  string $text             TXT record value (wrap inside double quotes when value contains spaces)
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getTxtByNameText($name, $text, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?name=' . $name . '&text=' . $text,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT record by name and extensible attribute
     *
     * @param  string $name             FQDN
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getTxtByNameAttr($name, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?name=' . $name . '&*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT record by text and extensible attribute
     *
     * @param  string $text             TXT record value (wrap inside double quotes when value contains spaces)
     * @param  string $attrName         extensible attribute name
     * @param  string $attrValue        extensible attribute value
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function getTxtByTextAttr($text, $attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?text=' . $text . '&*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get TXT record object reference
     *
     * @param  string $name             FQDN
     * @param  string $text             TXT record value (wrap inside double quotes when value contains spaces)
     * @param  string $view             view
     * @return string                   Object reference or empty string if record not found
     */
    public function getTxtObj($name, $text, $view)
    {
        $obj = $this->httpGet('/record:txt?text=' . $text . '&name=' . $name . '&view=' . $view);

        if (!empty($obj)) {
            return $obj[0]['_ref'];
        } else {
            return "";
        }
    }

    /**
     * Search TXT record by name
     *
     * @param  string $name             string to match in name field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchTxtByName($name, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?name~=' . $name .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search TXT record by text
     *
     * @param  string $text             string to match in text field
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of associative arrays
     */
    public function searchTxtByText($text, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/record:txt?text~=' . $text .
            '&creator=' . $this->creator,
            $returnFields
        );

        return $arr;
    }

    /**
     * Set A record. Will create in default view if view isn't passed in optParams.
     *
     * @param string $name          FQDN
     * @param string $ipv4addr      IP address
     * @param array  $optParams     array representation of json data. see infoblox wapidoc
     * @return string               object reference of created record
     */
    public function setA($name, $ipv4addr, $optParams = [])
    {
        $params = ['ipv4addr' => $ipv4addr, 'name' => $name];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/record:a', $data);

        return $obj;
    }

    /**
     * Set CNAME record. Will create in default view if view isn't passed in optParams.
     *
     * @param string $name          FQDN
     * @param string $canonical     canonical name FQDN
     * @param array $optParams      array representation of json data. see infoblox wapidoc
     * @return string               object reference of created record
     */
    public function setCname($name, $canonical, $optParams = [])
    {
        $params = ['canonical' => $canonical, 'name' => $name];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/record:cname', $data);

        return $obj;
    }

    /**
     * Set reverse-mapping zone PTR record. Will create in default view if view isn't passed in optParams.
     *
     * @param string $ptrdname      FQDN
     * @param string $ipv4addr      IP address
     * @param array $optParams      array representation of json data. see infoblox wapidoc
     * @return string               object reference of created record
     */
    public function setPtr($ptrdname, $ipv4addr, $optParams = [])
    {
        $params = ['ipv4addr' => $ipv4addr, 'ptrdname' => $ptrdname];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/record:ptr', $data);

        return $obj;
    }

    /**
     * Set MX record. Will create in default view if view isn't passed in optParams.
     *
     * @param string $name              FQDN
     * @param string $mailExchanger     mail exchanger FQDN
     * @param integer $preference       preference. 0 to 65535 (inclusive)
     * @param array $optParams          array representation of json data. see infoblox wapidoc
     * @return string                   object reference of created record
     */
    public function setMx($name, $mailExchanger, $preference, $optParams = [])
    {
        $params = ['mail_exchanger' => $mailExchanger, 'name' => $name, 'preference' => $preference];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/record:mx', $data);

        return $obj;
    }

    /**
     * Set TXT record. Will create in default view if view isn't passed in optParams.
     *
     * @param string $name              FQDN
     * @param string $text              TXT record value (wrap inside double quotes when value contains spaces)
     * @param array $optParams          array representation of json data. see infoblox wapidoc
     * @return string                   object reference of created record
     */
    public function setTxt($name, $text, $optParams = [])
    {
        $params = ['name' => $name, 'text' => $text];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/record:txt', $data);

        return $obj;
    }

    /**
     * Get All delegated zones
     *
     * @return array    array of delegated zone arrays
     */
    public function getZoneDelegated($returnFields = '')
    {
        $arr = $this->httpGet(
            '/zone_delegated',
            $returnFields
        );

        return $arr;
    }

    /**
     * Get delegated zones by view
     *
     * @param  string $view             view
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of delegated zone arrays
     */
    public function getZoneDelegatedByView($view, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/zone_delegated?view=' . $view,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get delegated zones by FQDN
     *
     * @param  string $fqdn             FQDN of delegated zone
     * @param  string $returnFields     comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    array of delegated zone arrays
     */
    public function getZoneDelegatedByFqdn($fqdn, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/zone_delegated?fqdn=' . $fqdn,
            $returnFields
        );

        return $arr;
    }

    /**
     * Create delegated zone
     *
     * @param string $fqdn          FQDN of the delegated zone
     * @param string $view          the view to create the zone in
     * @param array $delegatedTo    array of server(s) to delegate the zone to
     *                              delegatedTo example:
     *                              [
     *                                  ['fqdn' => 'ns1.mydomain.com', 'address' => '10.10.10.1'],
     *                                  ['fqdn' => 'ns2.mydomain.com', 'address' => '10.10.10.101']
     *                              ]
     *
     */
    public function setZoneDelegated($fqdn, $view, $delegatedTo)
    {
        $params = ['fqdn' => $fqdn, 'view' => $view];

        $data = array_merge($params, ['delegate_to' => $delegatedTo]);

        $obj = $this->httpPost('/zone_delegated', $data);

        return $obj;
    }

    /**
     * Set creator
     *
     * @param string $creator STATIC/DYNAMIC
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }
}
