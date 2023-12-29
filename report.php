<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');  
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reports - Stock Management System</title>
        <?php include('partials/app-header-scripts.php'); ?>
    </head>
    <body>
        <div id="dashboardMainContainer">
            <?php include('partials/app-sidebar.php') ?>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div id="reportsContainer">
                        <div class="reportTypeContainer">
                            <div class="reportType1">
                                <p>Export Products List</p>
                                <div class="alignRight">
                                    <a href="database/report_csv.php?report=product" class="reportExportBtn">Excel</a>
                                    <a href="database/report_products_pdf.php?report=product" target="_blank" class="reportExportBtn">PDF</a>
                                </div>
                            </div>
                            <div class="reportType">
                                <p>Export Users List</p>
                                <div class="alignRight">
                                    <a href="database/report_csv.php?report=user" class="reportExportBtn">Excel</a>
                                    <a href="database/report_users_pdf.php?report=user" target="_blank" class="reportExportBtn">PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="reportTypeContainer">
                            <div class="reportType2">
                                <p>Export Orders List</p>
                                <div class="alignRight">
                                    <a href="database/report_csv.php?report=order" class="reportExportBtn">Excel</a>
                                    <a href="database/report_orders_pdf.php?report=order" target="_blank" class="reportExportBtn">PDF</a>
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

