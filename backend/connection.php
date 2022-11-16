<?php
    $Host = "http://gungjoni-database-do-user-12443961-0.b.db.ondigitalocean.com/";
    $User = "doadmin";
    $Port = 25060
    $Password = "AVNS_yKLFF50goNPu3SHVOC5";
    $Database = "web_searching";
    $db = mysqli_init();
    mysqli_options ($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
    $db->ssl_set(NULL, NULL, "./ssl.crt", NULL, NULL);

    $Connection = mysqli_real_connect($db, $Host, $User, $Password, $Database, 25060, NULL, MYSQLI_CLIENT_SSL);

    if(!$Connection){
        die("Connection Failed: " .mysqli_connect_error());
    }
    