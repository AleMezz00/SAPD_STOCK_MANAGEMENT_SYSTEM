<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - Stock Management System</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="http://use.fontawesome.com/0c7a3095b5.js"></script>
    </head>
    <body>
        <div id="dashboardMainContainer">
            <div class="dashboard_sidebar" id="dashboard_sidebar">
                <h3 class="dashboard_logo" id="dashboard_logo">SMS</h3>
                <div class="dashboard_sidebar_user">
                    <img src="images/user.png" alt="User image." id="userImage"/>
                    <span><?= $user['first_name'] . ' ' . $user['last_name'] ?> </span>
                </div>
                <div class="dashboard_sidebar_menus">
                    <ul class="dashboard_menu_lists">
                        <li class="menuActive">
                            <a href=""> <i class="fa fa-dashboard"></i> <span class="menuText"> Dashboard </span> </a>
                        </li>
                        <li>
                            <a href=""> <i class="fa fa-dashboard"></i> <span class="menuText"> Dashboard </span> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <div class="dashboard_topNav">
                    <a href="" id="toggleBtn"> <i class="fa fa-navicon"></i></a>
                    <a href="database/logout.php" id="logoutBtn"> <i class="fa fa-power-off"></i>Log-out</a>
                </div>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">

                    </div>   
                </div>
            </div>
        </div>

        <script>

            var sidebarIsOpen = true;

            toggleBtn.addEventListener( 'click', (event)  => {
                event.preventDefault();

                if (sidebarIsOpen){
                dashboard_sidebar.style.width = '12%';
                dashboard_sidebar.style.transition = '0.4s all';
                dashboard_content_container.style.width = '90%';
                dashboard_logo.style.fontSize = '60px';
                userImage.style.width = '60px'
                menuIcons = document.getElementsByClassName('menuText');
                for(var i=0; i<menuIcons.length ; i++){
                    menuIcons[i].style.display = 'none';
                }
                
                document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'center';
                sidebarIsOpen = false;   

            } else {
                dashboard_sidebar.style.width = '20%';
                dashboard_content_container.style.width = '80%';
                dashboard_logo.style.fontSize = '80px';
                userImage.style.width = '80px'
                menuIcons = document.getElementsByClassName('menuText');
                for(var i=0; i<menuIcons.length ; i++){
                    menuIcons[i].style.display = 'inline-block';
                }
                
                document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'left';
               sidebarIsOpen = true;   
            }
                  
            });
        </script>
    </body>
</html>