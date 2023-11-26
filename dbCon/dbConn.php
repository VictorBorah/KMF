<?php $servername = "127.0.0.1";

#Production Conn


$username = "'<redacted>'; //ASK for ENV
$password = '<redacted>'; //ASK for ENV
$database= '<redacted>'; //ASK for ENV




try {
    $coreConn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);    
    $coreConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     #echo "Connected successfully";
    }
catch(PDOException $e)
    {
     #echo "Connection failed: " . $e->getMessage();
    }
?>
