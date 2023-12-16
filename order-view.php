<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $_SESSION['table'] = 'orders';
    $orders = include('database/show.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Orders - Stock Management System</title>
        <?php include('partials/app-header-scripts.php'); ?>
    </head>

<body>
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="row">
                        <div class="column column-12">
                            <h1 class="section_header"><i class="fa fa-list"></i> List of Ordered Products</h1> 
                            <div class="section_content">
                                <div class="users">
                                    <h3>ORDINE 1</h3>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Id</th>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Location</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($orders as $index => $order){ ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td class="order_id"><?= $order['order_id'] ?></td>
                                                    <td class="product_id"><?= $order['product_id'] ?></td>
                                                    <td class="product_name"><?= $order['product_name'] ?></td>
                                                    <td class="location"><?= $order['location'] ?></td>
                                                    <td class="quantity"><?= $order['quantity'] ?></td>
                                                </tr>
                                            <?php } ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>

    <?php include('partials/app-scripts.php'); ?>
</body>
</html>