<html>
<head><title>Dynamic client registration for the OpenID Connect PHP client demo</title></head>
<body>

<?php
require 'vendor/autoload.php';
require 'config.php';

// Avoid unintended or malicious re-registration
// For intended registration, CLIENT_ID must be empty in config.php
if (!empty(CLIENT_ID)) {
        print('<h2>Dynamic client registration was completed earlier. CLIENT_ID allready known!</h2>');
        die();
}

// Initialize client object, set OP URL, redirect URL and name of the client app.
$oidc = new OpenIDConnectClient(OP);
$oidc->setRedirectURL(REDIRECT_URL);
$oidc->setClientName(CLIENT_NAME);

// Do the actual registration
$oidc->register();

// Get client ID and client secret
$client_id = $oidc->getClientID();
$client_secret = $oidc->getClientSecret();

// Print the values (don't do this in a production environment!)
print('<h2>Dynamic client registration completed.</h2>');

print('<h3>In this simple demo, you have to copy the values of the following constants to config.php on the server now:</h3>');
print('<dl>');
print('<dt>CLIENT_ID</dt><dd>' . $client_id . '</dd>');
print('<dt>CLIENT_SECRET</dt><dd>' . $client_secret . '</dd>');
print('</dl>');

print('<h3>Please also contact the OP server admin to make sure the following scopes are enabled for this client:</h3>');
print('<ul>');
foreach (SCOPES as $scope) {
        print('<li>' . $scope . '</li>');
}
print('</ul>');

?>
</body>
<html>
