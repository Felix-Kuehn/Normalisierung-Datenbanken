<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli("localhost", "root", "", "online_shop");
if ($mysqli -> connect_errno) {
    exit('Failed to connect to MySQL: ' . $mysqli -> connect_error);
}
$table = $_GET['tabelle'];
if (!in_array($table, ['bestellpositionen','bestellungen','hersteller','kunden','produkte'])) {
    exit('Error: Wrong Table');
}

$query = $mysqli -> query('SELECT * FROM ' . $table);
    if (!$query) {
        exit('Query failed: ' . $mysqli->error);
    }

    $return = [];

while ($row = $query-> fetch_assoc()) {
 /*    echo '<pre>';
    print_r($row);
    echo '<pre>';
     */
   /*  printf('Produktnummer: %d, Produktbezeichnung: %s, Standardpreis: %d €, HerstellerID: %d<br><br>' ,
    $row['Produktnummer'],
    $row['Produktbezeichnung'],
    $row['Standardpreis'] / 100,
    $row['HerstellerID'],
    ); */

    array_push($return, $row);
}
$result = json_encode($return, JSON_NUMERIC_CHECK); // Numeric Check so Numbers are seen as int instead of converted to String
header('Content-Type: application/json; charset=utf-8');
echo($result);
exit();
?>