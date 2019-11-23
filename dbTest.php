<?php

include 'model/db.php';

$db = dbConnect();

print_r($db);

/*
function dbConnect()
{
    $dbhost = '213.171.200.92';
    $dbname = 'jos_huge_online_db';
    $dsn = 'mysql:host={$dbhost};dbname={$dbname}';

    $db = 'Working so far...';

    #$db = new pdo($dsn, $uname, $passwd);
    #$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    #$db->setAttribue(PDO::ATTR_TIMEOUT, "0");

    return $db;
}

*/

?>
