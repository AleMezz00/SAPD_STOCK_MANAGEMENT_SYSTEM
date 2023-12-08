<?php

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$location = $_POST['location'];
$type = $_POST['type'];
$value = $_POST['value'];
$avg_value = $_POST['avg_value'];
$std_deviation = $_POST['std_deviation'];
$pid = $_POST['pid'];

try{
    $sql = "UPDATE products 
                SET 
                product_id =?, product_name = ?, location = ?, type = ?, value = ?, avg_value = ?, std_deviation = ?
                WHERE id=?";

    include('connection.php');

    $stmt = $conn->prepare($sql);
    $stmt->execute([$product_id, $product_name, $location, $type, $value, $avg_value, $std_deviation, $pid ]);

    $response = [
    'success' => true,
    'message' => "<strong>$product_name</strong> with <strong>$product_id</strong> Successfully updated to the system."
    ];  
    } catch(Exception $e) {
        $response = [
            'success' => false,
            'message' => "Error processing your request"
        ];  
    }

echo json_encode($response);
