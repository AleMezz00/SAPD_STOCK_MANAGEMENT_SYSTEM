<?php
session_start();
 
// CAPTURE THE TABLE MAPPING
include('table_columns.php');
 
$table_name = $_SESSION['table'];
$columns = $table_columns_mapping[$table_name];
 
// DEFINED LOCATIONS
$allowed_locations = ['magazzino1', 'magazzino2', 'magazzino3'];
 
// LOOP THROUGH THE COLUMNS
$db_arr = [];
$user = $_SESSION['user'];
 
foreach ($columns as $column) {
    if ($column === 'created_at' || $column === 'updated_at') {
        $value = date('Y-m-d H:i:s');
    } elseif ($column === 'password') {
        $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
    } elseif ($column === 'location') {
        // Check if the submitted location is within allowed locations
        $value = isset($_POST[$column]) && in_array($_POST[$column], $allowed_locations) ? $_POST[$column] : '';
    } else {
        $value = isset($_POST[$column]) ? $_POST[$column] : '';
    }
 
    $db_arr[$column] = $value;
}
 
$table_properties = implode(", ", array_keys($db_arr));
$table_placeholders = ':' . implode(", :", array_keys($db_arr));
 
try {
    $sql = "INSERT INTO $table_name($table_properties) VALUES ($table_placeholders)";
 
    include('connection.php');
 
    $stmt = $conn->prepare($sql);
    $stmt->execute($db_arr);
 
    $response = [
        'success' => true,
        'message' => 'Successfully added to the system.'
    ];
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}
 
$_SESSION['response'] = $response;
 
header('location:../' . $_SESSION['redirect_to']);