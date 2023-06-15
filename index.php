<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'con.php';
$responce = array();

if (!isset($_GET['code'])) {
    $client_id = '909219603358-97sjus92fb11aumsig3557t7jo4ptkgo.apps.googleusercontent.com';
    $redirect_uri = 'http://localhost/mywork/oauth/callback.php';
    $auth_url = 'https://accounts.google.com/o/oauth2/auth?' .
        'client_id=' . $client_id .
        '&redirect_uri=' . urlencode($redirect_uri) .
        '&response_type=code' .
        '&scope=email profile';

    header('Location: ' . $auth_url);
    exit;
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token_url = 'https://accounts.google.com/o/oauth2/token';
    $client_id = '909219603358-97sjus92fb11aumsig3557t7jo4ptkgo.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = 'http://localhost/mywork/oauth/callback.php';
    $post_fields = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        $userinfo_url = 'https://www.googleapis.com/oauth2/v2/userinfo';
        $headers = [
            'Authorization: Bearer ' . $access_token
        ];

        $curl = curl_init($userinfo_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $userinfo = curl_exec($curl);
        curl_close($curl);

        $userinfo_data = json_decode($userinfo, true);

    } else {
        echo "Failed to retrieve access token.";
    }
} else {
    echo "Error: Authorization code not found.";
}
?>