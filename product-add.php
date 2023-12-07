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
                                <form action="database/add.php" method="POST" class="appForm">
                                    <div class="appFormInputContainer">
                                        <label for="id">ID</label>
                                        <input type="number" class="appFormInput" id="id" name="id"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="appFormInput" id="product_name" name="product_name"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="location">Loction</label>
                                        <input type="text" class="appFormInput" id="location" name="location"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="type">Type</label>
                                        <input type="text" class="appFormInput" id="type" name="type"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="value">Value</label>
                                        <input type="number" class="appFormInput" id="value" name="value"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="avg_value">Average Value</label>
                                        <input type="number" class="appFormInput" id="avg_value" name="avg_value"/>
                                    </div>
                                    <div class="appFormInputContainer">
                                        <label for="std_deviation">Standard Deviation</label>
                                        <input type="number" class="appFormInput" id="std_deviation" name="std_deviation"/>
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