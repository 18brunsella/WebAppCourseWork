<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('brunsell@cse.msu.edu');
    $site->setRoot('/~brunsell/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=brunsell',
        'brunsell',       // Database user
        '18Brunsella?',     // Database password
        'test8_');            // Table prefix
};
