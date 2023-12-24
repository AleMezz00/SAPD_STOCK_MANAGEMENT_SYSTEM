<?php
include('connection.php');
$locations = ['magazzino1', 'magazzino2', 'magazzino3'];

$results = [];

foreach($locations as $location){
    $stmt = $conn->prepare("SELECT COUNT(*) as location_count FROM products WHERE products.location='" . $location . "'");
    $stmt->execute();
    $row = $stmt->fetch();

    $count = $row['location_count'];

    $results[] =[
        'name' => strtoupper($location),
        'y' => (int) $count
    ];
}

?>