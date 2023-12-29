<?php
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$location = $_POST['location'];
$data_type = $_POST['data_type'];
$value = $_POST['value'];
$avg_value = $_POST['avg_value'];
$quantity = $_POST['quantity'];
$pid = $_POST['pid'];
 
$allowed_locations = ['magazzino1', 'magazzino2', 'magazzino3'];
 
if (!in_array($location, $allowed_locations)) {
    $response = [
        'success' => false,
        'message' => 'Location should be either magazzino1, magazzino2, or magazzino3'
    ];
} else {
    try {
        $sql = "UPDATE products
                SET product_id = ?, product_name = ?, location = ?, data_type = ?, value = ?, avg_value = ?, quantity = ?
                WHERE id = ?";
 
        include('connection.php');
 
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product_id, $product_name, $location, $data_type, $value, $avg_value, $quantity, $pid]);
 
        $response = [
            'success' => true,
            'message' => "Product details updated successfully for Product ID: $product_id"
        ];
    } catch (Exception $e) {
        $response = [
            'success' => false,
            'message' => "Error processing your request"
        ];
    }
}
 
echo json_encode($response);?>