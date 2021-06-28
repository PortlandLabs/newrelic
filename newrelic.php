<?php

# This file loads automatically thanks to composer

if (extension_loaded('newrelic')) {
    newrelic_name_transaction($_SERVER['REQUEST_URI'] ?: '/');

    foreach ($_SERVER as $key => $value) {
        newrelic_add_custom_parameter('SERVER.' . $key, $value);
    }
}
