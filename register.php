<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Register page">
    <title>Register</title>

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .bg {
            width: 100%;
            height: auto;
            /* background-image: linear-gradient(55deg,
                    hsl(240deg 84% 85%) 0%,
                    hsl(274deg 65% 84%) 11%,
                    hsl(312deg 62% 84%) 22%,
                    hsl(335deg 96% 88%) 33%,
                    hsl(351deg 100% 90%) 44%,
                    hsl(7deg 100% 91%) 56%,
                    hsl(19deg 100% 91%) 67%,
                    hsl(29deg 100% 92%) 78%,
                    hsl(38deg 96% 94%) 89%,
                    hsl(56deg 88% 97%) 100%); */
            background-size: cover;
            min-height: 100vh;

        }

        .container {
            max-width: 400px;
            height: fit-content;
            padding-bottom: 60px;
            position: relative;
            top: 10px;
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

        input[type=email],
        input[type=submit],
        input[type=text],
        input[type=password] {
            margin-top: 40px;
            height: 45px;
            border-radius: 10px;
            border: none;
            box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);
            width: 80%;
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
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query = "INSERT into `users` (username, password, email)
                     VALUES ('$username', '" . $password . "', '$email')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
        ?>
        <div class="bg">
            <form action="" method="post">
                <div class="container">
                    <div class="content">
                        <div class="first">
                            <span class="tex">REGISTER</span>
                        </div>
                        <div class="first">
                            <input type="text" placeholder="User Name" name="username" id="user_name">
                        </div>
                        <div class="second">
                            <input type="email" placeholder="Example@gmail.com" name="email" id="password">
                        </div>
                        <div class="second">
                            <input type="password" placeholder="Enter Password" name="password" id="password">
                        </div>
                        <div class="second">
                            <input type="password" placeholder="Confirm Password" name="password" id="password">
                        </div>
                        <div class="second">
                            <input type="submit" value="Sing Up" id="submit" name="submit">
                        </div>
                        <div class="sec">
                        <a href="http://localhost/oauth"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRu1PJmT_THldF0n5APcmt9p10utgu6KSw4cH2fQ5Xhpw&s"/> Sign in with Google</a>
                        </div>
                        <div class="reg">
                            <span> Have account?<a href="login.php">Login</a></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
    ?>

    <style>
        .sec img{
            width:25px ;
            position: relative;
            top: 7px;
            height:auto;
        }
        .sec{
            margin-top: 50px;
            margin: auto;
            position: relative;
            top: 20px;

        
        }
        .sec a{
            font-size: 18px;
            background-color: white;
            padding: 5px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
        }
        .reg{
            margin-top: 10px;
        }
    </style>
</body>


</html>
