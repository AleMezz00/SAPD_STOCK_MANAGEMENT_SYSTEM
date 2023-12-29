<?php

$type = $_GET['report'];
$file_name = '.xls';

$mapping_filenames = [
    'product' => 'Product Report',
    'user' => 'User Report',
    'order' => 'Order Report',
];

$file_name = $mapping_filenames[$type] . '.xls';

header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

// PULL DATA FROM DATABASE

include ('connection.php');


//PRODUCT EXPORT
if($type === 'product'){  
    $stmt = $conn->prepare("SELECT product_id, product_name, location, data_type, value, avg_value, quantity FROM products WHERE location IN ('magazzino1', 'magazzino2', 'magazzino3')");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $products = $stmt->fetchAll();

    $is_header = true;
    foreach($products as $product){
        if($is_header){
            $row = array_keys($product);
            $is_header = false;
            echo implode("\t", $row) . "\n";
        }

        array_walk($product, function(&$str){
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        });

        echo implode("\t", $product) . "\n"; 
    }
}

//USER EXPORT
if($type === 'user'){  
    $stmt = $conn->prepare("SELECT first_name, last_name, email, created_at, updated_at FROM users ORDER BY created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $users = $stmt->fetchAll();

    $is_header = true;
    foreach($users as $user){
        if($is_header){
            $row = array_keys($user);
            $is_header = false;
            echo implode("\t", $row) . "\n";
        }

        array_walk($user, function(&$str){
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        });

        echo implode("\t", $user) . "\n"; 
    }
}

//ORDER EXPORT
if($type === 'order'){  
    $stmt = $conn->prepare("SELECT order_id, product_id, product_name, location, quantity FROM orders ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $orders = $stmt->fetchAll();

    $is_header = true;
    foreach($orders as $order){
        if($is_header){
            $row = array_keys($order);
            $is_header = false;
            echo implode("\t", $row) . "\n";
        }

        array_walk($order, function(&$str){
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        });

        echo implode("\t", $order) . "\n"; 
    }
}

