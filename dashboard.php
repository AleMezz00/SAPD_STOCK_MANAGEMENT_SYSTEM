<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $user = $_SESSION['user'];

    $_SESSION['table'] = 'products';
    $products = include('database/show.php');
    
    include('database/location_pie_graph.php')
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
                        <h2 class="chartMainTitle">Products Location</h2>
                        <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            This is a pie chart which represents the actual status of the products stocked, based on their location.
                        </p>
                        </figure>
                    </div>   
                </div>
            </div>
        </div>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            var graphData = <?= json_encode($results) ?>;
            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormatter: function(){
                        var point = this,
                        series = point.series;

                        return `<b>${point.name}</b>: <b>${point.y}</b>`
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.percentage:.1f}%',
                            style: {
                                fontSize: '1.9em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [
                    {
                        name: 'Location',
                        colorByPoint: true,
                        data: graphData
                    }
                ]
            });
        </script>
        <?php include('partials/app-scripts.php'); ?>
    </body>
</html>

