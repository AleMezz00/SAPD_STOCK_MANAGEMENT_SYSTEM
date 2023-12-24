<?php
include('connection.php');
 
$table_name = $_SESSION['table'];
 
$stmt = $conn->prepare("SELECT * FROM $table_name WHERE location IN ('magazzino1', 'magazzino2', 'magazzino3')");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
 
$products = $stmt->fetchAll();
 
return $products;
?>