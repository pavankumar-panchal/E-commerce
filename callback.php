<?php
session_start();

$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'Customer_details';

$client_id = '909219603358-97sjus92fb11aumsig3557t7jo4ptkgo.apps.googleusercontent.com';
$client_secret = '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';
$redirect_uri = 'http://localhost/mywork/oauth/callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token_url = 'https://accounts.google.com/o/oauth2/token';
    $post_fields = 'code=' . urlencode($code) .
        '&client_id=' . urlencode($client_id) .
        '&client_secret=' . urlencode($client_secret) .
        '&redirect_uri=' . urlencode($redirect_uri) .
        '&grant_type=authorization_code';

    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        $userinfo_url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . urlencode($access_token);

        $userinfo_json = file_get_contents($userinfo_url);
        $userinfo = json_decode($userinfo_json, true);

        $conn = mysqli_connect($host, $db_user, $db_password, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $email = $userinfo['email'];
        $name = $userinfo['name'];

        echo "Email: " . $email;
        echo "<br>";

        echo "Name: " . $name;
        echo "<br>";


        $sql = "INSERT IGNORE INTO google (email, name ) VALUES ('$email', '$name')";
        if (mysqli_query($conn, $sql)) {
            echo "User details saved successfully.";

            header("Location:http://localhost/mywork/Final/home.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Failed to retrieve access token.";
    }
} else {
    echo "Error: Authorization code not found.";
}
?>