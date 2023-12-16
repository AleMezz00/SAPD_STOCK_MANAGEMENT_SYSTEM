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
                            <h1 class="section_header"><i class="fa fa-list"></i> List of Orders</h1> 
                            <div class="section_content">
                                <div class="users">
                                    <?php 
                                        $previousOrderID = null;
                                        foreach ($orders as $order): 
                                            $currentOrderID = $order['order_id'];
                                            // Se l'ID dell'ordine è diverso, inizia una nuova tabella
                                            if ($currentOrderID !== $previousOrderID):
                                        ?>
                                            <?php if ($previousOrderID !== null): ?>
                                                </tbody>
                                                </table>
                                            <?php endif; ?>
                                            <h3>Order ID: <?php echo $currentOrderID; ?></h3>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Product ID</th>
                                                        <th>Product Name</th>
                                                        <th>Location</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php endif; ?>
                                            <tr>
                                                <td><?php echo $order['product_id']; ?></td>
                                                <td><?php echo $order['product_name']; ?></td>
                                                <td><?php echo $order['location']; ?></td>
                                                <td><?php echo $order['quantity']; ?></td>
                                            </tr>
                                            <?php 
                                            $previousOrderID = $currentOrderID;
                                        endforeach; 
                                        ?>
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