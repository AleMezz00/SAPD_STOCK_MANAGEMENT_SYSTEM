
<div class="dashboard_sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo" id="dashboard_logo">SMS</h3>
    <div class="dashboard_sidebar_user">
        <img src="images/user.png" alt="User image." id="userImage"/>
        <span><?= $user['first_name'] . ' ' . $user['last_name'] ?> </span>
    </div>
    <div class="dashboard_sidebar_menus">
        <ul class="dashboard_menu_lists">
            <!-- class="menuActive" -->
            <li>
                <a href="./dashboard.php"> <i class="fa fa-dashboard"></i> <span class="menuText"> Dashboard </span> </a>
            </li>
            <li>
                <a href="./product.php"> <i class="fa fa-clipboard"></i> <span class="menuText"> Product Management </span> </a>
            </li>
        </ul>
    </div>
</div>