<?php

namespace canvas;

// Auto load classes based on namespace, don't change.
spl_autoload_register(function ($class) {
    if (strpos($class, __NAMESPACE__) > -1) {
        require_once 'libs/' . str_replace(['\\'], ['/'], $class) . '.php';
    }
});