<?php

/**
 * Class Geoip.
 *
 * Provide GeoIP through SypexGeo API
 * @link http://sypexgeo.net/
 *
 */

namespace kostikpenzin\geoip;

class Geoip
{
    /**
     * @var \SxGeo instance.
     */
    private $_sypex = null;

    /**
     * @var string $ip remote client IP-address
     */
    public $ip = '';
    /**
     * @var int $ipAsLong remote client IP-address as integer value
     */
    public $ipAsLong = 0;
    /**
     * @var array $city geo information about city
     */
    public $city = [];
    /**
     * @var array $region geo information about region
     */
    public $region = [];
    /**
     * @var array $country geo information about country
     */
    public $country = [];

    /**
     * Get full geo info by remote IP-address
     * @param string $ip source ip, if empty then determine
     * @return array geo info|false if error
     * result array example:
     *  ```php
     * 
     * array (
     * 'ip' => '135.181.47.216',
     * 'city' => 
     * array (
     * 'id' => 658225,
     * 'lat' => 60.16952,
     * 'lon' => 24.93545,
     * 'name_ru' => 'Хельсинки',
     * 'name_en' => 'Helsinki',
     * 'name_de' => 'Helsinki',
     * 'name_fr' => 'Helsinki',
     * 'name_it' => 'Helsinki',
     * 'name_es' => 'Helsinki',
     * 'name_pt' => 'Helsínquia',
     * 'okato' => '',
     * 'vk' => 0,
     * 'population' => 558457,
     * 'tel' => '',
     * 'post' => '',
     * ),
     * 'region' => 
     * array (
     * 'id' => 828987,
     * 'lat' => 60.83,
     * 'lon' => 26,
     * 'name_ru' => 'Южная Финляндия',
     * 'name_en' => 'Southern Finland Province',
     * 'name_de' => 'Südfinnland (Provinz)',
     * 'name_fr' => 'Finlande méridionale',
     * 'name_it' => 'Finlandia meridionale',
     * 'name_es' => 'Finlandia Meridional',
     * 'name_pt' => 'Finlândia Meridional',
     * 'iso' => 'FI-ES',
     * 'timezone' => 'Europe/Helsinki',
     * 'okato' => '',
     * 'auto' => '',
     * 'vk' => 0,
     * 'utc' => 2,
     * ),
     * 'country' => 
     * array (
     * 'id' => 69,
     * 'iso' => 'FI',
     * 'continent' => 'EU',
     * 'lat' => 64,
     * 'lon' => 26,
     * 'name_ru' => 'Финляндия',
     * 'name_en' => 'Finland',
     * 'name_de' => 'Finnland',
     * 'name_fr' => 'Finlande',
     * 'name_it' => 'Finlandia',
     * 'name_es' => 'Finlandia',
     * 'name_pt' => 'Finlândia',
     * 'timezone' => 'Europe/Helsinki',
     * 'area' => 337030,
     * 'population' => 5244000,
     * 'capital_id' => 658225,
     * 'capital_ru' => 'Хельсинки',
     * 'capital_en' => 'Helsinki',
     * 'cur_code' => 'EUR',
     * 'phone' => '358',
     * 'neighbours' => 'NO,RU,SE',
     * 'vk' => 207,
     * 'utc' => 2,
     * ),
     * 'error' => '',
     * 'request' => -1,
     * 'created' => '2021.03.18',
     * 'timestamp' => 1616099629,
     * )
     *  ```
     */
    public function get($ip = '')
    {
        if (empty($ip))
            $this->getIP();
        else if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return false;
        } else {
            $this->ip = $ip;
            $this->ipAsLong = sprintf('%u', ip2long($ip));
        }

        $this->getSypexGeo();
        $data = $this->_sypex->getCityFull($this->ip);
        if (isset($data['city']))
            $this->city = $data['city'];
        if (isset($data['region']))
            $this->region = $data['region'];
        if (isset($data['country']))
            $this->country = $data['country'];
        return empty($data) ? false : $data;
    }

    /**
     * Detect client IP address
     * @return string IP
     */
    public function getIP()
    {
        if (getenv('HTTP_CLIENT_IP'))
            $ip = getenv('HTTP_CLIENT_IP');
        elseif (getenv('HTTP_X_FORWARDED_FOR'))
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        elseif (getenv('HTTP_X_FORWARDED'))
            $ip = getenv('HTTP_X_FORWARDED');
        elseif (getenv('HTTP_FORWARDED_FOR'))
            $ip = getenv('HTTP_FORWARDED_FOR');
        elseif (getenv('HTTP_FORWARDED'))
            $ip = getenv('HTTP_FORWARDED');
        elseif (getenv('HTTP_CF_CONNECTING_IP')) // for cloudflare.com
            $ip = getenv('HTTP_CF_CONNECTING_IP');
        else
            $ip = getenv('REMOTE_ADDR');

        $this->ip = $ip;
        $this->ipAsLong = sprintf('%u', ip2long($ip));
        return $ip;
    }

    /**
     * @return \SxGeo instance.
     */
    public function getSypexGeo()
    {
        if (!is_object($this->_sypex)) {
            $this->_sypex = $this->createSxGeo();
        }

        return $this->_sypex;
    }

    /**
     * Creates SxGeo instance.
     * @return \SxGeo instance.
     */
    protected function createSxGeo()
    {
        return new \kostikpenzin\geoip\SxGeo();
    }
}
