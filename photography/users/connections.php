<?php


function friendlyError($e) {
    return "<div class=\"error-message center\">" .
        "<b>Error</b><br>" .
        "Please contact system administrator. " .
        "<pre>Error message: <br>" . $e . "</pre>" .
        "</div>";
}

$db_host = "localhost";
$db_username = "fit2104_user";
$db_passwd = "l5Mm0!RPI3rTh2gN";
$db_name = "fit2104A2_db";




$dsn = "mysql:localhost=$db_host;dbname=$db_name";

try {
    $dbh = new PDO($dsn, $db_username, $db_passwd);
    echo " connection done";
} catch (PDOException $e) {
    die(friendlyError($e->getMessage()));
}