<?php
include('connection.php');

$table_name = $_SESSION['table'];

// LA PARTE COMMENTATA E' IL TENTATIVO FATTO CON CHAT GPT

/*
if ($table_name === 'products') {

    if (file_exists('../JSON/edge.json')) {
        $jsonData = json_decode(file_get_contents('../JSON/edge.json'), true);
        $stmt = $conn->prepare("INSERT INTO $table_name (product_id, product_name, location, data_type, value, avg_value, std_deviation) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($jsonData as $item) {
            $stmt->execute([
                $item['product_id'],
                $item['product_name'],
                $item['location'],
                $item['data_type'],
                $item['value'],
                $item['avg_value'],
                $item['std_deviation']
            ]);
        }
    }
}
*/

$stmt = $conn->prepare("SELECT * FROM $table_name");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();