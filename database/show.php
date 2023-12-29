<?php
include('connection.php');
 
$table_name = $_SESSION['table'];
 
$stmt = $conn->prepare("SELECT * FROM $table_name WHERE location IN ('stock1', 'stock2', 'stock3')");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
 
$products = $stmt->fetchAll();
 
return $products;
?>