<?php 

    session_start();
    if(isset($_SESSION['user'])) header('location: dashboard.php');

    $error_message = '';

    if($_POST){
        include('database/connection.php');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. $password .'" ';
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll()[0];
            $_SESSION['user'] = $user;

            header('Location: dashboard.php');
        }else $error_message = 'Please make sure that username and password are correct!';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login - Stock Management System</title>

        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body id="loginBody" class="login_background">
        <?php 
        if(!empty($error_message)) { ?>

        <div style="background: aliceblue; text-align: center; font-size: 25px; color: red;">
            <strong style="font-size: 30px">ERROR:</strong> </p> <?= $error_message ?> </p>
        </div>
        <?php } ?>

        <div class="container" >
            <div class="loginHeader">
                    <h1>SMS</h1>
                    <h3>Stock Management System</h3>
            </div>
            <div class="loginBody">
                <form action="login.php" method="POST">
                    <div class="loginInputsContainer">
                        <label for="">Username</label>
                        <input placeholder="Username" name="username" type="text" />
                    </div>

                    <div class="loginInputsContainer">
                        <label for="">Password</label>
                        <input placeholder="Password" name="password" type="password" />
                    </div>
                    <div class="loginButtonContainer">
                        <button>Login</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>