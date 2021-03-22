# yii2-geoip
Geo ip for Yii2

Sypex Geo is an IP location based product from the creators of Sypex Dumper. Having received the IP-address, Sypex Geo gives out information about the visitor's location - country, region, city, geographic coordinates.

Sypex Geo - distributed under the BSD license, that is, it is completely free.

As a database, Sypex Geo uses a binary file of its own format. This format is open and universal. When developing the format, a lot of work was done to optimize the algorithm. Due to this, Sypex Geo works much faster than competitors, consumes less memory, and also produces fewer disk accesses (due to which, on busy servers, the difference is even greater in favor of Sypex Geo).

Direct links to the database: 
  * Sypex Geo City DB (free) - http://sypexgeo.net/files/SxGeoCity_utf8.zip
  * Sypex Geo City Max DB - https://sypexgeo.net/ru/buy/


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kostikpenzin/yii2-geoip "*"
```

or add

```
"kostikpenzin/yii2-geoip": "*"
```

to the require section of your `composer.json` file.  


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php
    $geo = new \kostikpenzin\geoip\Geoip();

    // get by remote IP
    $geo->get();                // also returned geo data as array
    echo $geo->ip,'<br>';
    echo $geo->ipAsLong,'<br>';
    var_dump($geo->country); echo '<br>';
    var_dump($geo->region);  echo '<br>';
    var_dump($geo->city);    echo '<br>';

    // get by custom IP
    print_r($geo->get('88.200.214.22'));
?>
```
Information about country, region and city returned as array.
For example:
```php

array (
  'ip' => '135.181.47.216',
  'city' => 
  array (
    'id' => 658225,
    'lat' => 60.16952,
    'lon' => 24.93545,
    'name_ru' => 'Хельсинки',
    'name_en' => 'Helsinki',
    'name_de' => 'Helsinki',
    'name_fr' => 'Helsinki',
    'name_it' => 'Helsinki',
    'name_es' => 'Helsinki',
    'name_pt' => 'Helsínquia',
    'okato' => '',
    'vk' => 0,
    'population' => 558457,
    'tel' => '',
    'post' => '',
  ),
  'region' => 
  array (
    'id' => 828987,
    'lat' => 60.83,
    'lon' => 26,
    'name_ru' => 'Южная Финляндия',
    'name_en' => 'Southern Finland Province',
    'name_de' => 'Südfinnland (Provinz)',
    'name_fr' => 'Finlande méridionale',
    'name_it' => 'Finlandia meridionale',
    'name_es' => 'Finlandia Meridional',
    'name_pt' => 'Finlândia Meridional',
    'iso' => 'FI-ES',
    'timezone' => 'Europe/Helsinki',
    'okato' => '',
    'auto' => '',
    'vk' => 0,
    'utc' => 2,
  ),
  'country' => 
  array (
    'id' => 69,
    'iso' => 'FI',
    'continent' => 'EU',
    'lat' => 64,
    'lon' => 26,
    'name_ru' => 'Финляндия',
    'name_en' => 'Finland',
    'name_de' => 'Finnland',
    'name_fr' => 'Finlande',
    'name_it' => 'Finlandia',
    'name_es' => 'Finlandia',
    'name_pt' => 'Finlândia',
    'timezone' => 'Europe/Helsinki',
    'area' => 337030,
    'population' => 5244000,
    'capital_id' => 658225,
    'capital_ru' => 'Хельсинки',
    'capital_en' => 'Helsinki',
    'cur_code' => 'EUR',
    'phone' => '358',
    'neighbours' => 'NO,RU,SE',
    'vk' => 207,
    'utc' => 2,
  ),
  'error' => '',
  'request' => -1,
  'created' => '2021.03.18',
  'timestamp' => 1616099629,
)

```

