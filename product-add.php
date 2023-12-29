<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'products';
    $_SESSION['redirect_to'] = 'product-add.php';

    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Product - Stock Management System</title>

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
                            <h1 class="section_header"><i class="fa fa-plus"></i> Create Product</h1>    
                            <div id="productAddFormContainer">
                                <form action="database/add.php" method="POST" class="appForm" enctype="multipart/form-data">
                                    <div class="appFormInputContainer">
                                        <label for="product_id">Product ID</label>
                                        <input type="text" class="appFormInput" id="product_id" placeholder="Enter product id..." name="product_id"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="appFormInput" id="product_name" placeholder="Enter product name..." name="product_name"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="location">Location</label>
                                        <select class="appFormInputLocation" id="location" name="location">
                                        <option value="stock1">Stock 1</option>
                                        <option value="stock2">Stock 2</option>
                                        <option value="stock3">Stock 3</option>
                                        </select>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="data_type">Data Type</label>
                                        <input type="text" class="appFormInput" id="data_type" placeholder="Enter product type..." name="data_type"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="value">Value</label>
                                        <input type="number" class="appFormInput" id="value" placeholder="Enter product value..." name="value"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="avg_value">Average Value</label>
                                        <input type="number" class="appFormInput" id="avg_value" placeholder="Enter product average value..." name="avg_value"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="appFormInput" id="quantity" placeholder="Enter product quantity..." name="quantity"/>
                                    </div>
                                    <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add Product</button>
                                </form>

                                <?php 
                                    if(isset($_SESSION['response'])){
                                        $response_message = $_SESSION['response']['message'];
                                        $is_success = $_SESSION['response']['success'];
                                ?>
                                    <div class="responseMessage">
                                        <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                            <?= $response_message ?>
                                        </p>
                                    </div>
                                <?php unset($_SESSION['response']); } ?>
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