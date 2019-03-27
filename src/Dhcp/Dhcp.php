<?php

namespace L4rzzz\InfobloxWapi\Dhcp;

/**
 * Infoblox Dhcp
 *
 * @package L4rzzz\InfobloxWapi
 */
class Dhcp extends \L4rzzz\InfobloxWapi\InfobloxWapi
{

    /**
     * Get a IPv4 fixed address by IP address
     *
     * @param  string   $ipv4addr       IP Address.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getFixedAddrByIp($ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?ipv4addr=' . $ipv4addr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get a IPv4 fixed address by MAC address
     *
     * @param  string   $mac            MAC Address.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getFixedAddrByMac($mac, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?mac=' . $mac,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get a IPv4 fixed address by network
     *
     * @param  string   $network        network CIDR notation.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getFixedAddrByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?network=' . $network,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get a IPv4 fixed address by extensible attribute
     *
     * @param  string   $attrName       extensible attribute name
     * @param  string   $attrValue      extensible attribute value
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getFixedAddrByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search IPv4 fixed addresses by IPv4 address
     *
     * @param  string   $ipv4addr       string to match in ipv4 address field.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findFixedAddrByIp($ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?ipv4addr~=' . $ipv4addr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search IPv4 fixed addresses by MAC address
     *
     * @param  string   $mac            string to match in mac address field.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findFixedAddrByMac($mac, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?mac~=' . $mac,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search IPv4 fixed addresses by network
     *
     * @param  string   $network        string to match in network field.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findFixedAddrByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/fixedaddress?network~=' . $network,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get IPv4 fixed address object reference
     *
     * @param  string   $ipv4addr   IPv4 address
     * @param  string   $mac        MAC address in 00:00:00:00:00:00 format.
     * @return string               Object Reference.
     */
    public function getFixedAddrObj($ipv4addr, $mac)
    {
        $obj = $this->httpGet('/fixedaddress?ipv4addr=' . $ipv4addr . '&mac=' . $mac);

        if (!empty($obj)) {
            return $obj[0]['_ref'];
        } else {
            return "";
        }
    }

    /**
     * Fix an IPv4 Address
     *
     * @param  string   $ipv4addr   IPv4 address
     * @param  string   $mac        MAC address in 00:00:00:00:00:00 format.
     * @param  array    $optParams  array representation of json data. see infoblox wapidoc
     * @return string               Object reference.
     */
    public function setFixedAddr($ipv4addr, $mac, $optParams = [])
    {
        $params = ['ipv4addr' => $ipv4addr, 'mac' => $mac];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/fixedaddress', $data);

        return $obj;
    }

    /**
     * Get lease information by IP address
     *
     * @param  string   $address       IP Address.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getLeaseByAddr($address, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?address=' . $address,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get lease information by MAC address
     *
     * @param  string   $mac            MAC address
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getLeaseByMac($mac, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?hardware=' . $mac,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get lease information by client hostname
     *
     * @param  string   $hostname       client hostname
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getLeaseByHostname($hostname, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?client_hostname=' . $hostname,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get lease information by client fingerprint
     *
     * @param  string   $fingerprint    fingerprint
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getLeaseByFingerprint($fingerprint, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?fingerprint=' . $fingerprint,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search lease information by IP address
     *
     * @param  string   $address        IP address
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findLeaseByAddr($address, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?address~=' . $address,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search lease information by MAC address
     *
     * @param  string   $mac            MAC address
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findLeaseByMac($mac, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?hardware~=' . $mac,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search lease information by client hostname
     *
     * @param  string   $hostname       client hostname
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findLeaseByHostname($hostname, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?client_hostname~=' . $hostname,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search lease information by client fingerprint
     *
     * @param  string   $fingerprint    client fingerprint
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findLeaseByFingerprint($fingerprint, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/lease?fingerprint~=' . $fingerprint,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get network by network CIDR
     *
     * @param  string   $network        network (CIDR)
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getNetworkByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/network?network=' . $network,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get network by comment
     *
     * @param  string   $comment        comment
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getNetworkByComment($comment, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/network?comment=' . $comment,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get networks by extensible attribute
     *
     * @param  string   $attrName       extensible attribute name
     * @param  string   $attrValue      extensible attribute value
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getNetworkByAttr($attrName, $attrValue, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/network?*' . $attrName . '=' . $attrValue,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search networks by network
     *
     * @param  string   $network        string to match in network field.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findNetworkByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/network?network~=' . $network,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search networks by comment
     *
     * @param  string   $comment        string to match in comment field.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findNetworkByComment($comment, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/network?comment~=' . $comment,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get network next available IP
     *
     * @param  string   $refId          object reference
     * @param  string   $number         number of IP adresses to return
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getNetworkNextIp($refId, $number = 1)
    {
        $arr = $this->httpPost(
            '/' . $refId . '?_function=next_available_ip',
            ['num' => $number]
        );

        return $arr;
    }

    /**
     * Create network
     *
     * @param string $network       network (CIDR)
     * @param array  $optParams     array representation of json data. see infoblox wapidoc
     * @return string               object reference of created record
     */
    public function setNetwork($network, $optParams = [])
    {
        $params = ['network' => $network];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/network', $data);

        return $obj;
    }

    /**
     * Get range by network
     *
     * @param  string   $network        CIDR format
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getRangeByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/range?network=' . $network,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get range by start IP address
     *
     * @param  string   $address        first IP address of range
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getRangeByStartAddr($address, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/range?start_addr=' . $address,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get range by end IP address
     *
     * @param  string   $address        last IP address of range
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getRangeByEndAddr($address, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/range?end_addr=' . $address,
            $returnFields
        );

        return $arr;
    }

    /**
     * Search range by network
     *
     * @param  string   $network        string to match in network field.
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function findRangeByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/range?network~=' . $network,
            $returnFields
        );

        return $arr;
    }

    /**
     * Create range
     *
     * @param string $startAddr     start IPv4 address
     * @param string $endAddr       end IPv4 address
     * @param array  $optParams     array representation of json data. see infoblox wapidoc
     * @return string               object reference of created record
     */
    public function setRange($startAddr, $endAddr, $optParams = [])
    {
        $params = [
            'start_addr' => $startAddr,
            'end_addr' => $endAddr
        ];

        $data = array_merge($params, $optParams);

        $obj = $this->httpPost('/range', $data);

        return $obj;
    }

    /**
     * Get network templates
     *
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getTemplateNetwork($returnFields = '')
    {
        $arr = $this->httpGet(
            '/networktemplate',
            $returnFields
        );

        return $arr;
    }

    /**
     * Get range templates
     *
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getTemplateRange($returnFields = '')
    {
        $arr = $this->httpGet(
            '/rangetemplate',
            $returnFields
        );

        return $arr;
    }
}
