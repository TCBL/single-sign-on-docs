<?php

/**
 * Simple OpenID Connect PHP demo using library
 * https://github.com/jumbojett/OpenID-Connect-PHP
 */

require 'vendor/autoload.php';
require 'config.php';

$oidc = new OpenIDConnectClient(OP, CLIENT_ID, CLIENT_SECRET);
$oidc->setRedirectURL(REDIRECT_URL);

// Prepare authentication
$prompt = array('display' => 'page');
$oidc->addAuthParam($prompt);

// Scopes to be authorized by the end-user
foreach (SCOPES as $scope) {
	$oidc->addScope($scope);
}

// Authentication + authorization
$oidc->authenticate();

// Get all user info at once in one object
$userinfo = $oidc->requestUserInfo();

?>

<html>
<head>
    <title>OpenID Connect PHP client demo</title>
    <script type="text/javascript">
        window.onload = function() {
          var a = document.getElementById("logoutlink");
          a.onclick = function() {
            document.getElementById("logoutform").submit();
            return false;
          }
        }
    </script>
</head>
<body>
<h2>OpenID Connect PHP client demo</h2>
<h3>This is the authorized user information:</h3>
<p>
<?php
print('<dl>');
foreach (get_object_vars($userinfo) as $key => $value) {
	print('<dt>' . $key . '</dt><dd>' . $value . '</dd>');
}
print('</dl>');
?>
</p>
<p>
[<a href="index.html">Back</a>]
[<a href="#" id="logoutlink">Logout</a>]
</p>
<form style="display:none" name="logoutform" id="logoutform" action="logout.php" method="POST">
    <input type="hidden" name="accessToken" value="<?php echo $oidc->getAccessToken(); ?>" />
</form>
</body>
</html>

