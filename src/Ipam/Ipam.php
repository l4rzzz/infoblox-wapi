<?php

namespace L4rzzz\InfobloxWapi\Ipam;

/**
 * Infoblox Ipam
 *
 * @package L4rzzz\InfobloxWapi
 */
class Ipam extends \L4rzzz\InfobloxWapi\InfobloxWapi
{
	/**
     * Get IPAM IPv4 Address information by IP Address
     *
     * @param  string   $ipv4addr       client hostname
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getIpv4addrByAddr($ipv4addr, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/ipv4address?ip_address=' . $ipv4addr,
            $returnFields
        );

        return $arr;
    }

    /**
     * Get IPAM IPv4 Addresses information by network
     *
     * @param  string   $network        network (CIDR notation)
     * @param  string   $returnFields   comma separated return fields needed in response. see infoblox wapidoc
     * @return array                    associative array
     */
    public function getIpv4addrByNetwork($network, $returnFields = '')
    {
        $arr = $this->httpGet(
            '/ipv4address?network=' . $network,
            $returnFields
        );

        return $arr;
    }
}