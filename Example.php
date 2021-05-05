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
