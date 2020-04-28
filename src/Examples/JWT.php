<?php
require 'vendor/autoload.php';
use Plivo\Util\AccessToken;

// using validFrom and lifetime
$acctkn = new AccessToken("{authId}", "{authToken}", "{endpointUsername}", gmdate('U'), 3600, null, "{uid}");
$acctkn->addVoiceGrants(false, true);
echo $acctkn->toJwt() . "\n";

// using validFrom and validTill
$acctkn = new AccessToken("{authId}", "{authToken}", "{endpointUsername}", gmdate('U'), null, gmdate('U', mktime(23, 59, 59, 4, 29, 2020)), "{uid}");
$acctkn->addVoiceGrants(false, true);
echo $acctkn->toJwt() . "\n";
