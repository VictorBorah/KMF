<?php $servername = "127.0.0.1";

#Production Conn


$username = "lila_das";
$password = "BYrWnKzNncxx3UfK";
$database="Lila_Zantra_Kunja";


#TestDomain Conn
/*
$username = "aryan_bnc";
$password = "Mc8qm3~5";
$database="bcollege_test";
*/

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