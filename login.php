<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <meta name="description" content="Login page">

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .bg {
            width: 100%;
            height: 100vh;
           
        }

        .container {
            max-width: 400px;
            height: fit-content;
            padding-bottom: 60px;
            position: relative;
            top: 100px;
            margin: auto;
            background: rgba(205, 205, 205, 0.55);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(11.5px);
            -webkit-backdrop-filter: blur(11.5px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);
            align-items: center;
            text-align: center;
        }

        .tex {
            font-size: 30px;
            font-weight: 900;
            position: relative;
            top: 30px;
        }

        .content {
            color: black;
        }

        input[type=submit],
        input[type=text],
        input[type=password] {
            margin-top: 40px;
            height: 45px;
            border-radius: 10px;
            border: none;
            width: 80%;
            background-color: white;
            box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);

        }

        ::placeholder {
            font-weight: 300;
            font-size: 16px;
            margin-left: 30px;
            position: relative;
            left: 20px;
        }

        input[type=submit] {
            background-color: #065F46;

            color: white;
            font-size: 25px;
            cursor: pointer;

        }

        input[type=submit]:hover {
            background-color: #065F36;
            font-size: 25px;
            cursor: pointer;

        }

        .reg span {
            color: black;
            font-size: 20px;
            position: relative;
            top: 20px;
        }

        .reg a {
            margin-left: 10px;
        }

        input {
            font-size: 25px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    require('db.php');
    session_start();
    if (isset($_POST['username']) or isset($_POST['email'])) 
    {
        $email = stripslashes($_REQUEST['email']);
        $email=mysqli_real_escape_string($con,$email);

        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query = "SELECT * FROM `users` WHERE username='$username'  or email='$email'
                     AND password='" . $password . "'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['email']=$email;
            header("Location: home.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
        ?>
        <div class="bg">
            <form action="" method="post">
                <div class="container">
                    <div class="content">
                        <div class="first">
                            <span class="tex">LOGIN</span>
                        </div>
                        <div class="first">
                            <input type="text" placeholder="User Name" id="username" name="username" name="email">
                        </div>
                        <div class="second">
                            <input type="password" placeholder="Enter Password" name="password">
                        </div>
                        <div class="second">
                            <input type="submit" value="Sing in" name="submit">
                        </div>
                        <div class="reg">
                            <span>Don't have account?<a href="register.php">Register here</a></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</body>

</html>