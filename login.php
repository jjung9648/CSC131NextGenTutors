<?php
require_once 'vendor/autoload.php';
$config = require 'hybridauth.php';
$hybridauth = new Hybridauth\Hybridauth($config);

try {
    $adapter = $hybridauth->authenticate('Google');
    $userProfile = $adapter->getUserProfile();
    echo 'Hi ' . $userProfile->displayName;
} catch (\Exception $e) {
    echo 'Oops, we ran into an issue! ' . $e->getMessage();
}

