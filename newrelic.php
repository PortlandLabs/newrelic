<?php
namespace Portlandlabs\Newrelic;

function addCustomParameter($key, $value) {
    // Never pass these to newrelic
    static $skip = ['SERVER.HTTP_AUTHORIZATION', 'SERVER.HTTP_COOKIE', 'SERVER.PHP_AUTH_DIGEST', 'SERVER.PHP_AUTH_PW'];

    if (!in_array($key, $skip)) {
        newrelic_add_custom_parameter($key, is_array($value) ? json_encode($value) : $value);
    }
}

if (extension_loaded('newrelic')) {
    newrelic_name_transaction(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');

    foreach ($_SERVER as $key => $value) {
        addCustomParameter('SERVER.' . $key, $value);
    }
}
