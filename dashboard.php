<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - Stock Management System</title>

        <?php include('partials/app-header-scripts.php'); ?>
    </head>
    <body>
        <div id="dashboardMainContainer">

            <?php include('partials/app-sidebar.php') ?>

            <div class="dashboard_content_container" id="dashboard_content_container">

            <?php include('partials/app-topnav.php') ?>

                <div class="dashboard_content">
                    <div class="dashboard_content_main">

                    </div>   
                </div>
            </div>
        </div>

        <script src="js/script.js"></script>
        <?php include('partials/app-scripts.php'); ?>
    </body>
</html>