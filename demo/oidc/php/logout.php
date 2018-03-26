<?php
require 'vendor/autoload.php';
require 'config.php';

$accessToken =$_REQUEST['accessToken'];
$oidc = new OpenIDConnectClient(OP, CLIENT_ID, CLIENT_SECRET);
$oidc->signOut($accessToken, LOGOUT_REDIRECT_URL);
?>
